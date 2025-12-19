# Eloquent Models Documentation

**Project:** One Place Agro PWA  
**Date:** 2024-01-01  
**Status:** ✅ ALL MODELS COMPLETED

---

## Overview

All 8 Eloquent Models have been created with comprehensive relationships, mass assignment protection, type casting, soft deletes, and useful query scopes. The models follow Laravel best practices and are production-ready.

---

## Models Summary

| Model        | Table          | Soft Deletes | Key Features                                   |
| ------------ | -------------- | ------------ | ---------------------------------------------- |
| User         | users          | ❌           | Multi-role auth, relationships to all entities |
| CropVariety  | crop_varieties | ❌           | Master data for crop types                     |
| FarmerYield  | yields         | ✅           | Farmer listings with JSON images               |
| Requirement  | requirements   | ✅           | Trader purchase requirements                   |
| Bid          | bids           | ✅           | Bidding system with status tracking            |
| MarketPrice  | market_prices  | ❌           | Daily market price tracking                    |
| Notification | notifications  | ❌           | User notification system                       |
| News         | news           | ❌           | Agricultural news feed                         |

---

## Detailed Model Information

### 1. User Model

**File:** `app/Models/User.php`  
**Table:** `users`  
**Extends:** `Authenticatable`

#### Mass Assignable Fields:

```php
'name', 'email', 'mobile', 'password', 'role',
'location', 'avatar', 'company_name', 'is_verified'
```

#### Casts:

```php
'email_verified_at' => 'datetime',
'password' => 'hashed',
'is_verified' => 'boolean'
```

#### Relationships:

-   `yields()` - HasMany FarmerYield
-   `requirements()` - HasMany Requirement
-   `bids()` - HasMany Bid (as trader)
-   `notifications()` - HasMany Notification

#### Helper Methods:

-   `isFarmer()` - Check if user is a farmer
-   `isTrader()` - Check if user is a trader
-   `isAdmin()` - Check if user is an admin

#### Usage Example:

```php
// Get all yields for a farmer
$farmer = User::find(1);
$yields = $farmer->yields()->active()->get();

// Check user role
if ($user->isFarmer()) {
    // Farmer-specific logic
}

// Get trader's bids
$bids = $user->bids()->pending()->get();
```

---

### 2. CropVariety Model

**File:** `app/Models/CropVariety.php`  
**Table:** `crop_varieties`

#### Mass Assignable Fields:

```php
'name', 'image_url'
```

#### Relationships:

-   `yields()` - HasMany FarmerYield
-   `requirements()` - HasMany Requirement
-   `marketPrices()` - HasMany MarketPrice

#### Usage Example:

```php
// Get all yields for Nagpur Mandarin
$variety = CropVariety::where('name', 'Nagpur Mandarin')->first();
$yields = $variety->yields()->active()->get();

// Get recent market prices
$prices = $variety->marketPrices()->recent(7)->get();
```

---

### 3. FarmerYield Model

**File:** `app/Models/Yield.php` (Class: `FarmerYield`)  
**Table:** `yields`  
**Soft Deletes:** ✅ Yes

**Note:** Named `FarmerYield` because `Yield` is a reserved keyword in PHP.

#### Mass Assignable Fields:

```php
'user_id', 'variety_id', 'quantity', 'price_per_ton',
'description', 'images', 'status', 'harvest_date', 'location'
```

#### Casts:

```php
'images' => 'array',
'harvest_date' => 'date',
'quantity' => 'decimal:2',
'price_per_ton' => 'decimal:2'
```

#### Relationships:

-   `user()` / `farmer()` - BelongsTo User
-   `variety()` - BelongsTo CropVariety
-   `bids()` - HasMany Bid

#### Query Scopes:

-   `active()` - Only active yields
-   `sold()` - Only sold yields
-   `byLocation($location)` - Filter by location

#### Usage Example:

```php
// Get active yields in Katol
$yields = FarmerYield::active()
    ->byLocation('Katol')
    ->with(['farmer', 'variety', 'bids'])
    ->get();

// Create new yield
$yield = FarmerYield::create([
    'user_id' => $farmer->id,
    'variety_id' => 1,
    'quantity' => 15.50,
    'price_per_ton' => 4000,
    'description' => 'Premium quality oranges',
    'images' => ['image1.jpg', 'image2.jpg'],
    'status' => 'active',
    'harvest_date' => now()->addDays(7),
    'location' => 'Katol, Nagpur'
]);

// Access JSON images
$images = $yield->images; // Returns array
```

---

### 4. Requirement Model

**File:** `app/Models/Requirement.php`  
**Table:** `requirements`  
**Soft Deletes:** ✅ Yes

#### Mass Assignable Fields:

```php
'user_id', 'variety_id', 'quantity_required', 'max_budget',
'location', 'description', 'is_active'
```

#### Casts:

```php
'quantity_required' => 'decimal:2',
'max_budget' => 'decimal:2',
'is_active' => 'boolean'
```

#### Relationships:

-   `user()` / `trader()` - BelongsTo User
-   `variety()` - BelongsTo CropVariety

#### Query Scopes:

-   `active()` - Only active requirements
-   `byLocation($location)` - Filter by location

#### Usage Example:

```php
// Get active requirements for Nagpur Mandarin
$requirements = Requirement::active()
    ->whereHas('variety', function($q) {
        $q->where('name', 'Nagpur Mandarin');
    })
    ->get();

// Create new requirement
$requirement = Requirement::create([
    'user_id' => $trader->id,
    'variety_id' => 1,
    'quantity_required' => 50,
    'max_budget' => 200000,
    'location' => 'Sitabuldi, Nagpur',
    'description' => 'Need premium quality for export',
    'is_active' => true
]);
```

---

### 5. Bid Model

**File:** `app/Models/Bid.php`  
**Table:** `bids`  
**Soft Deletes:** ✅ Yes

#### Mass Assignable Fields:

```php
'yield_id', 'trader_id', 'bid_amount', 'quantity',
'message', 'status'
```

#### Casts:

```php
'bid_amount' => 'decimal:2',
'quantity' => 'decimal:2'
```

#### Relationships:

-   `yield()` - BelongsTo FarmerYield
-   `trader()` - BelongsTo User

#### Query Scopes:

-   `pending()` - Only pending bids
-   `accepted()` - Only accepted bids
-   `rejected()` - Only rejected bids

#### Helper Methods:

-   `isPending()` - Check if bid is pending
-   `isAccepted()` - Check if bid is accepted
-   `isRejected()` - Check if bid is rejected

#### Usage Example:

```php
// Get pending bids for a yield
$bids = Bid::where('yield_id', $yieldId)
    ->pending()
    ->with('trader')
    ->get();

// Place a bid
$bid = Bid::create([
    'yield_id' => $yield->id,
    'trader_id' => $trader->id,
    'bid_amount' => 62000,
    'quantity' => 15.50,
    'message' => 'Interested in purchasing full quantity',
    'status' => 'pending'
]);

// Accept a bid
$bid->update(['status' => 'accepted']);

// Check bid status
if ($bid->isPending()) {
    // Show accept/reject buttons
}
```

---

### 6. MarketPrice Model

**File:** `app/Models/MarketPrice.php`  
**Table:** `market_prices`

#### Mass Assignable Fields:

```php
'market_name', 'variety_id', 'min_price', 'max_price',
'modal_price', 'date'
```

#### Casts:

```php
'min_price' => 'decimal:2',
'max_price' => 'decimal:2',
'modal_price' => 'decimal:2',
'date' => 'date'
```

#### Relationships:

-   `variety()` - BelongsTo CropVariety

#### Query Scopes:

-   `byMarket($marketName)` - Filter by market
-   `dateRange($start, $end)` - Filter by date range
-   `recent($days)` - Get recent prices (default 30 days)

#### Usage Example:

```php
// Get last 7 days prices for Nagpur APMC
$prices = MarketPrice::byMarket('Nagpur APMC')
    ->recent(7)
    ->with('variety')
    ->orderBy('date', 'desc')
    ->get();

// Get price trend for a variety
$trend = MarketPrice::where('variety_id', 1)
    ->dateRange(now()->subDays(30), now())
    ->orderBy('date')
    ->get();

// Create price entry
MarketPrice::create([
    'market_name' => 'Nagpur APMC',
    'variety_id' => 1,
    'min_price' => 3000,
    'max_price' => 5000,
    'modal_price' => 4000,
    'date' => today()
]);
```

---

### 7. Notification Model

**File:** `app/Models/Notification.php`  
**Table:** `notifications`

#### Mass Assignable Fields:

```php
'user_id', 'title', 'message', 'is_read', 'type'
```

#### Casts:

```php
'is_read' => 'boolean'
```

#### Relationships:

-   `user()` - BelongsTo User

#### Query Scopes:

-   `unread()` - Only unread notifications
-   `read()` - Only read notifications
-   `ofType($type)` - Filter by notification type

#### Helper Methods:

-   `markAsRead()` - Mark notification as read
-   `markAsUnread()` - Mark notification as unread

#### Notification Types:

-   `bid_received` - New bid on farmer's yield
-   `bid_accepted` - Bid accepted by farmer
-   `bid_rejected` - Bid rejected by farmer
-   `market_alert` - Market price alert
-   `requirement_matched` - Matching yield found
-   `system` - System notifications

#### Usage Example:

```php
// Get unread notifications for user
$notifications = Notification::where('user_id', $userId)
    ->unread()
    ->latest()
    ->get();

// Create notification
Notification::create([
    'user_id' => $farmer->id,
    'title' => 'New Bid Received',
    'message' => "You received a bid of ₹62,000 on your Nagpur Mandarin listing",
    'is_read' => false,
    'type' => 'bid_received'
]);

// Mark as read
$notification->markAsRead();

// Get bid-related notifications
$bidNotifications = Notification::ofType('bid_received')
    ->where('user_id', $userId)
    ->get();
```

---

### 8. News Model

**File:** `app/Models/News.php`  
**Table:** `news`

#### Mass Assignable Fields:

```php
'title', 'content', 'thumbnail', 'source', 'published_at'
```

#### Casts:

```php
'published_at' => 'datetime'
```

#### Query Scopes:

-   `recent($days)` - Get recent news (default 30 days)
-   `latest()` - Order by latest first
-   `bySource($source)` - Filter by source

#### Usage Example:

```php
// Get latest news
$news = News::latest()->take(10)->get();

// Get recent news (last 7 days)
$recentNews = News::recent(7)->get();

// Create news article
News::create([
    'title' => 'Nagpur Orange Exports Reach Record High',
    'content' => 'Full article content here...',
    'thumbnail' => 'images/news/export-record.jpg',
    'source' => 'Agricultural Times',
    'published_at' => now()
]);

// Filter by source
$govNews = News::bySource('Government Portal')->get();
```

---

## Relationship Diagram

```
User (1) ──────< FarmerYield (M)
  │                 │
  │                 └──< Bid (M) ──> User (trader)
  │
  ├──────< Requirement (M)
  │
  └──────< Notification (M)

CropVariety (1) ──────< FarmerYield (M)
                │
                ├──────< Requirement (M)
                │
                └──────< MarketPrice (M)

News (independent)
```

---

## Common Query Patterns

### 1. Farmer Dashboard

```php
// Get farmer's active yields with bids
$yields = FarmerYield::where('user_id', $farmerId)
    ->active()
    ->with(['variety', 'bids' => function($q) {
        $q->pending()->with('trader');
    }])
    ->get();

// Get unread notifications
$notifications = Notification::where('user_id', $farmerId)
    ->unread()
    ->latest()
    ->take(5)
    ->get();
```

### 2. Trader Dashboard

```php
// Get recent active yields
$yields = FarmerYield::active()
    ->with(['farmer', 'variety'])
    ->latest()
    ->take(10)
    ->get();

// Get trader's bids
$myBids = Bid::where('trader_id', $traderId)
    ->with(['yield.variety', 'yield.farmer'])
    ->latest()
    ->get();
```

### 3. Browse Yields (Screen 12)

```php
// Search yields by location and variety
$yields = FarmerYield::active()
    ->byLocation('Katol')
    ->whereHas('variety', function($q) use ($varietyId) {
        $q->where('id', $varietyId);
    })
    ->with(['farmer', 'variety'])
    ->paginate(10);
```

### 4. Market Prices (Screen 7)

```php
// Get price trend for last 30 days
$prices = MarketPrice::where('variety_id', $varietyId)
    ->recent(30)
    ->orderBy('date')
    ->get()
    ->groupBy('market_name');
```

### 5. Bidding Flow

```php
// Place bid
$bid = Bid::create([
    'yield_id' => $yieldId,
    'trader_id' => $traderId,
    'bid_amount' => $amount,
    'quantity' => $quantity,
    'message' => $message,
    'status' => 'pending'
]);

// Notify farmer
Notification::create([
    'user_id' => $yield->user_id,
    'title' => 'New Bid Received',
    'message' => "You received a bid of ₹{$amount}",
    'type' => 'bid_received'
]);

// Accept bid
$bid->update(['status' => 'accepted']);
$yield->update(['status' => 'sold']);

// Notify trader
Notification::create([
    'user_id' => $bid->trader_id,
    'title' => 'Bid Accepted',
    'message' => 'Your bid has been accepted!',
    'type' => 'bid_accepted'
]);
```

---

## Mass Assignment Protection

All models use `$fillable` arrays to protect against mass assignment vulnerabilities. Only explicitly listed fields can be mass-assigned.

### Example:

```php
// ✅ Safe - only fillable fields are set
$yield = FarmerYield::create($request->validated());

// ❌ Dangerous - without fillable protection
// $yield = FarmerYield::create($request->all());
```

---

## Type Casting Benefits

### Automatic Type Conversion:

```php
// Decimal casting
$yield->quantity; // Returns float, not string

// Boolean casting
$user->is_verified; // Returns true/false, not 1/0

// Date casting
$yield->harvest_date; // Returns Carbon instance
$yield->harvest_date->format('Y-m-d');
$yield->harvest_date->diffForHumans(); // "7 days from now"

// Array casting (JSON)
$yield->images; // Returns array, not JSON string
$yield->images[] = 'new-image.jpg';
$yield->save(); // Automatically converts back to JSON
```

---

## Soft Deletes

Models with soft deletes: `FarmerYield`, `Requirement`, `Bid`

### Usage:

```php
// Soft delete
$yield->delete(); // Sets deleted_at timestamp

// Query without soft deleted
$yields = FarmerYield::all(); // Excludes soft deleted

// Include soft deleted
$yields = FarmerYield::withTrashed()->get();

// Only soft deleted
$yields = FarmerYield::onlyTrashed()->get();

// Restore soft deleted
$yield->restore();

// Permanently delete
$yield->forceDelete();
```

---

## Query Scopes Usage

### Chaining Scopes:

```php
// Multiple scopes
$yields = FarmerYield::active()
    ->byLocation('Nagpur')
    ->with('variety')
    ->latest()
    ->paginate(10);

// Custom + built-in scopes
$bids = Bid::pending()
    ->where('bid_amount', '>', 50000)
    ->with(['yield', 'trader'])
    ->get();
```

---

## Eager Loading (N+1 Prevention)

### Without Eager Loading (N+1 Problem):

```php
// ❌ Bad - Causes N+1 queries
$yields = FarmerYield::all();
foreach ($yields as $yield) {
    echo $yield->farmer->name; // Separate query for each yield
}
```

### With Eager Loading:

```php
// ✅ Good - Only 2 queries
$yields = FarmerYield::with('farmer')->get();
foreach ($yields as $yield) {
    echo $yield->farmer->name; // No additional queries
}

// Multiple relationships
$yields = FarmerYield::with(['farmer', 'variety', 'bids.trader'])->get();
```

---

## Model Events (Future Enhancement)

Models can use events for automatic actions:

```php
// In FarmerYield model
protected static function booted()
{
    static::created(function ($yield) {
        // Send notification when yield is created
        Notification::create([
            'user_id' => $yield->user_id,
            'title' => 'Yield Listed Successfully',
            'message' => 'Your yield has been listed',
            'type' => 'system'
        ]);
    });
}
```

---

## Testing Models

### Example Tests:

```php
// Test relationships
$user = User::factory()->create();
$yield = FarmerYield::factory()->create(['user_id' => $user->id]);
$this->assertTrue($user->yields->contains($yield));

// Test scopes
$activeYields = FarmerYield::active()->count();
$this->assertGreaterThan(0, $activeYields);

// Test helper methods
$farmer = User::factory()->create(['role' => 'farmer']);
$this->assertTrue($farmer->isFarmer());
```

---

## Best Practices

1. **Always use eager loading** to prevent N+1 queries
2. **Use query scopes** for reusable query logic
3. **Leverage type casting** for automatic data conversion
4. **Protect mass assignment** with $fillable arrays
5. **Use soft deletes** for important data (yields, bids, requirements)
6. **Add helper methods** for common checks (isPending, isFarmer, etc.)
7. **Document relationships** clearly in comments
8. **Use meaningful scope names** (active, recent, byLocation)

---

## Model Status Summary

| Model        | Status | Relationships | Scopes | Casts | Soft Deletes |
| ------------ | ------ | ------------- | ------ | ----- | ------------ |
| User         | ✅     | 4             | 0      | 3     | ❌           |
| CropVariety  | ✅     | 3             | 0      | 0     | ❌           |
| FarmerYield  | ✅     | 3             | 3      | 4     | ✅           |
| Requirement  | ✅     | 2             | 2      | 3     | ✅           |
| Bid          | ✅     | 2             | 3      | 2     | ✅           |
| MarketPrice  | ✅     | 1             | 3      | 4     | ❌           |
| Notification | ✅     | 1             | 3      | 1     | ❌           |
| News         | ✅     | 0             | 3      | 1     | ❌           |

**Total:** 8 models, 16 relationships, 17 scopes, 18 casts

---

**Models Status:** ✅ PRODUCTION READY  
**Last Updated:** 2024-01-01  
**All Relationships Defined:** ✅ YES  
**Mass Assignment Protected:** ✅ YES  
**Type Casting Implemented:** ✅ YES  
**Soft Deletes Where Needed:** ✅ YES
