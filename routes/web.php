<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\BidManagementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\MarketPriceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\TraderController;
use App\Http\Controllers\YieldController;
use Illuminate\Support\Facades\Route;

// Home/Landing page
Route::get('/', function () {
    return view('landing');
})->name('home');

// Contact form submission (publicly accessible)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Legal/Policy pages (publicly accessible)
Route::get('/terms-of-service', function () {
    return view('legal.terms-of-service');
})->name('terms-of-service');

Route::get('/privacy-policy', function () {
    return view('legal.privacy-policy');
})->name('privacy-policy');

Route::get('/content-policy', function () {
    return view('legal.content-policy');
})->name('content-policy');

// Guest routes (Authentication)
Route::middleware('guest')->group(function () {
    // Role selection
    Route::get('/role-selection', [AuthController::class, 'showRoleSelection'])->name('role.selection');

    // Registration
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Shared routes (accessible by all authenticated users)
    // Market Prices
    Route::get('/market-prices', [MarketPriceController::class, 'index'])->name('market-prices.index');
    Route::get('/market-prices/chart', [MarketPriceController::class, 'chart'])->name('market-prices.chart');
    Route::get('/market-prices/latest', [MarketPriceController::class, 'latest'])->name('market-prices.latest');
    Route::get('/market-prices/compare', [MarketPriceController::class, 'compare'])->name('market-prices.compare');

    // News
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/news/latest/feed', [NewsController::class, 'latest'])->name('news.latest');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'recent'])->name('notifications.recent');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::post('/notifications/clear-read', [NotificationController::class, 'clearRead'])->name('notifications.clear-read');

    // Farmer routes
    Route::middleware('farmer')->prefix('farmer')->name('farmer.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [FarmerController::class, 'dashboard'])->name('dashboard');

        // Profile
        Route::get('/profile', [FarmerController::class, 'profile'])->name('profile');
        Route::put('/profile', [FarmerController::class, 'updateProfile'])->name('profile.update');

        // Yields (CRUD)
        Route::resource('yields', YieldController::class);

        // Bid Management
        Route::get('/bids', [BidManagementController::class, 'index'])->name('bids.index');
        Route::post('/bids/{bid}/accept', [BidManagementController::class, 'accept'])->name('bids.accept');
        Route::post('/bids/{bid}/reject', [BidManagementController::class, 'reject'])->name('bids.reject');

        // Browse Requirements (what traders are looking for)
        Route::get('/requirements', [FarmerController::class, 'browseRequirements'])->name('requirements.browse');
        Route::get('/requirements/{requirement}', [FarmerController::class, 'showRequirement'])->name('requirements.show');
    });

    // Trader routes
    Route::middleware('trader')->prefix('trader')->name('trader.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [TraderController::class, 'dashboard'])->name('dashboard');

        // Profile
        Route::get('/profile', [TraderController::class, 'profile'])->name('profile');
        Route::put('/profile', [TraderController::class, 'updateProfile'])->name('profile.update');

        // Browse Yields
        Route::get('/yields', [TraderController::class, 'browseYields'])->name('yields.browse');
        Route::get('/yields/{yield}', [TraderController::class, 'showYield'])->name('yields.show');

        // Requirements (CRUD)
        Route::resource('requirements', RequirementController::class);
        Route::post('/requirements/{requirement}/toggle', [RequirementController::class, 'toggleStatus'])->name('requirements.toggle');

        // Bids
        Route::get('/bids', [BidController::class, 'index'])->name('bids.index');
        Route::post('/bids', [BidController::class, 'store'])->name('bids.store');
        Route::get('/bids/{bid}', [BidController::class, 'show'])->name('bids.show');
        Route::put('/bids/{bid}', [BidController::class, 'update'])->name('bids.update');
        Route::post('/bids/{bid}/cancel', [BidController::class, 'cancel'])->name('bids.cancel');
    });

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Additional admin routes will be added later
    });
});
