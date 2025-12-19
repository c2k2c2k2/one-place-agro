<?php

namespace App\Http\Controllers;

use App\Models\CropVariety;
use App\Models\MarketPrice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MarketPriceController extends Controller
{
    /**
     * Display market prices with filters.
     */
    public function index(Request $request): View
    {
        $query = MarketPrice::with('variety');

        // Filter by variety
        if ($request->filled('variety_id')) {
            $query->where('variety_id', $request->variety_id);
        }

        // Filter by market name
        if ($request->filled('market_name')) {
            $query->where('market_name', 'like', '%'.$request->market_name.'%');
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        // Default to last 30 days if no date filter
        if (! $request->filled('start_date') && ! $request->filled('end_date')) {
            $query->where('date', '>=', now()->subDays(30));
        }

        $prices = $query->latest('date')->paginate(20)->withQueryString();

        // Get all varieties for filter dropdown
        $varieties = CropVariety::orderBy('name')->get();

        // Get unique market names for filter
        $markets = MarketPrice::select('market_name')
            ->distinct()
            ->orderBy('market_name')
            ->pluck('market_name');

        return view('market-prices.index', compact('prices', 'varieties', 'markets'));
    }

    /**
     * Get chart data for a specific variety.
     * Returns JSON data for Chart.js
     */
    public function chart(Request $request): JsonResponse
    {
        $varietyId = $request->get('variety_id');
        $days = $request->get('days', 30); // Default to 30 days

        // Validate inputs
        if (! $varietyId) {
            return response()->json(['error' => 'Variety ID is required'], 400);
        }

        // Cache the chart data for 1 hour
        $cacheKey = "market_price_chart_{$varietyId}_{$days}";

        $chartData = Cache::remember($cacheKey, 3600, function () use ($varietyId, $days) {
            $prices = MarketPrice::where('variety_id', $varietyId)
                ->where('date', '>=', now()->subDays($days))
                ->orderBy('date', 'asc')
                ->get();

            // Group by date and calculate average prices
            $groupedPrices = $prices->groupBy('date')->map(function ($dayPrices) {
                return [
                    'min_price' => $dayPrices->avg('min_price'),
                    'max_price' => $dayPrices->avg('max_price'),
                    'modal_price' => $dayPrices->avg('modal_price'),
                ];
            });

            return [
                'labels' => $groupedPrices->keys()->map(function ($date) {
                    return \Carbon\Carbon::parse($date)->format('M d');
                })->values(),
                'datasets' => [
                    [
                        'label' => 'Minimum Price',
                        'data' => $groupedPrices->pluck('min_price')->values(),
                        'borderColor' => 'rgb(255, 99, 132)',
                        'backgroundColor' => 'rgba(255, 99, 132, 0.1)',
                        'tension' => 0.4,
                    ],
                    [
                        'label' => 'Modal Price',
                        'data' => $groupedPrices->pluck('modal_price')->values(),
                        'borderColor' => 'rgb(54, 162, 235)',
                        'backgroundColor' => 'rgba(54, 162, 235, 0.1)',
                        'tension' => 0.4,
                    ],
                    [
                        'label' => 'Maximum Price',
                        'data' => $groupedPrices->pluck('max_price')->values(),
                        'borderColor' => 'rgb(75, 192, 192)',
                        'backgroundColor' => 'rgba(75, 192, 192, 0.1)',
                        'tension' => 0.4,
                    ],
                ],
            ];
        });

        return response()->json($chartData);
    }

    /**
     * Get latest prices for all varieties (for dashboard ticker).
     */
    public function latest(): JsonResponse
    {
        // Cache for 30 minutes
        $latestPrices = Cache::remember('latest_market_prices', 1800, function () {
            return MarketPrice::with('variety')
                ->whereIn('id', function ($query) {
                    $query->selectRaw('MAX(id)')
                        ->from('market_prices')
                        ->groupBy('variety_id');
                })
                ->get()
                ->map(function ($price) {
                    return [
                        'variety' => $price->variety->name,
                        'modal_price' => $price->modal_price,
                        'date' => $price->date->format('M d, Y'),
                    ];
                });
        });

        return response()->json($latestPrices);
    }

    /**
     * Compare prices across different markets for a variety.
     */
    public function compare(Request $request): View
    {
        $varietyId = $request->get('variety_id');
        $date = $request->get('date', now()->format('Y-m-d'));

        if (! $varietyId) {
            return redirect()->route('market-prices.index')
                ->with('error', 'Please select a variety to compare.');
        }

        $variety = CropVariety::findOrFail($varietyId);

        $prices = MarketPrice::where('variety_id', $varietyId)
            ->where('date', $date)
            ->orderBy('modal_price', 'desc')
            ->get();

        $varieties = CropVariety::orderBy('name')->get();

        return view('market-prices.compare', compact('variety', 'prices', 'varieties', 'date'));
    }
}
