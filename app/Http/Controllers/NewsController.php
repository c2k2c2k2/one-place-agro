<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles.
     */
    public function index(Request $request): View
    {
        $query = News::query();

        // Search by title or content
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by source
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->where('published_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('published_at', '<=', $request->end_date);
        }

        $news = $query->latest('published_at')->paginate(12)->withQueryString();

        // Get unique sources for filter
        $sources = News::select('source')
            ->distinct()
            ->whereNotNull('source')
            ->orderBy('source')
            ->pluck('source');

        return view('news.index', compact('news', 'sources'));
    }

    /**
     * Display the specified news article.
     */
    public function show(News $news): View
    {
        // Get related news (same source or recent)
        $relatedNews = News::where('id', '!=', $news->id)
            ->where(function ($query) use ($news) {
                $query->where('source', $news->source)
                    ->orWhere('published_at', '>=', now()->subDays(7));
            })
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    /**
     * Get latest news for dashboard (cached).
     */
    public function latest()
    {
        // Cache for 30 minutes
        $latestNews = Cache::remember('latest_news', 1800, function () {
            return News::latest('published_at')
                ->take(5)
                ->get()
                ->map(function ($news) {
                    return [
                        'id' => $news->id,
                        'title' => $news->title,
                        'excerpt' => \Str::limit($news->content, 100),
                        'thumbnail' => $news->thumbnail,
                        'source' => $news->source,
                        'published_at' => $news->published_at->diffForHumans(),
                    ];
                });
        });

        return response()->json($latestNews);
    }
}
