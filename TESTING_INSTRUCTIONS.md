# Testing Instructions - One Place Agro PWA

**Date:** 2024-01-01  
**Server Status:** Running on http://127.0.0.1:8000

---

## What Has Been Completed

### ✅ Phase 1: Foundation (COMPLETE)

-   Database schema, migrations, models, seeders
-   All tested and working

### ✅ Phase 2: Authentication (COMPLETE)

-   Controllers, middleware, routes, basic views
-   Multi-role authentication system

### ✅ Phase 3: Core Features (COMPLETE)

-   9 Controllers with 35+ methods
-   3 Form Request validators
-   50+ routes defined
-   Full CRUD operations

### 🚧 Phase 3-4: UI Components & Views (IN PROGRESS - 15% Complete)

#### Components Created (10/18):

1. ✅ `header.blade.php` - Top navigation with logo, notifications, mobile menu
2. ✅ `bottom-nav.blade.php` - Mobile bottom navigation (role-based)
3. ✅ `weather-widget.blade.php` - Weather display card
4. ✅ `quick-action-button.blade.php` - Dashboard quick action buttons
5. ✅ `update-card.blade.php` - Dashboard update notifications
6. ✅ `yield-card.blade.php` - Yield listing card with actions
7. ✅ `bid-card.blade.php` - Bid display card with actions
8. ✅ `requirement-card.blade.php` - Requirement card
9. ✅ `news-card.blade.php` - News article card
10. ✅ `stat-card.blade.php` - Dashboard statistics card

#### Views Created (1/20+):

1. ✅ `resources/views/farmer/dashboard.blade.php` - Complete farmer dashboard using all components

---

## Manual Testing Instructions

### Prerequisites:

1. ✅ Server is running on http://127.0.0.1:8000
2. Database should be migrated and seeded with test data

### Step 1: Verify Database Setup

```bash
# Check if migrations are run
php artisan migrate:status

# If not migrated, run:
php artisan migrate:fresh --seed
```

### Step 2: Test Authentication Flow

1. **Open Browser:** Navigate to http://127.0.0.1:8000
2. **Register as Farmer:**
    - Go to http://127.0.0.1:8000/register
    - Select "Farmer" role
    - Fill in registration form:
        - Name: Test Farmer
        - Mobile: 9876543210
        - Password: password123
        - Location: Nagpur
    - Submit form
3. **Login:**
    - Should redirect to http://127.0.0.1:8000/login
    - Enter mobile: 9876543210
    - Enter password: password123
    - Submit

### Step 3: Test Farmer Dashboard (PRIMARY TEST)

**URL:** http://127.0.0.1:8000/farmer/dashboard

**Expected Elements:**

#### 1. Header Component

-   [ ] Orange header bar with "One Place" logo
-   [ ] Agriculture icon on the left
-   [ ] Notification bell icon (with red dot if notifications exist)
-   [ ] Menu hamburger icon
-   [ ] Click menu icon → Side menu should slide in from right
-   [ ] Menu should show:
    -   Dashboard
    -   My Yields
    -   Bids
    -   Market Prices
    -   Agri News
    -   Notifications
    -   Profile
    -   Logout button (red)

#### 2. Weather Widget

-   [ ] Card showing weather information
-   [ ] Temperature: 32°C
-   [ ] Condition: Sunny with sun icon
-   [ ] Location: Nagpur, India
-   [ ] Three metrics: Humidity (45%), Wind (12 km/h), Precipitation (0%)
-   [ ] Background image with overlay

#### 3. Quick Actions Section

-   [ ] Section title: "Quick Actions"
-   [ ] Three buttons in a row:
    1. **Add New Yield** (orange icon)
        - Icon: inventory_2
        - Should link to /farmer/yields/create
    2. **Active Listings** (blue icon)
        - Icon: list_alt
        - Should link to /farmer/yields
    3. **Market Prices** (green icon)
        - Icon: trending_up
        - Should link to /market-prices
-   [ ] Buttons should have hover effect (shadow increases)
-   [ ] Buttons should scale down slightly on click

#### 4. Statistics Section

-   [ ] Section title: "Your Statistics"
-   [ ] Three stat cards in a row:
    1. **Active Yields** (orange)
        - Shows count of active yields
    2. **Pending Bids** (blue)
        - Shows count of pending bids
    3. **Sold** (green)
        - Shows count of sold yields

#### 5. Recent Updates Section

-   [ ] Section title: "Recent Updates"
-   [ ] "View All" link on the right
-   [ ] If bids exist: Shows up to 3 recent bid cards
    -   Orange left border
    -   Person search icon
    -   Title: "New Bid Received"
    -   Message with trader name, bid amount, variety
    -   Timestamp (e.g., "2 hours ago")
-   [ ] If no bids: Shows welcome message
    -   Gray left border
    -   Verified icon
    -   Welcome message

#### 6. Recent Yields Section (if yields exist)

-   [ ] Section title: "Your Recent Yields"
-   [ ] "View All" link on the right
-   [ ] Shows up to 3 yield cards:
    -   Image (or placeholder if no image)
    -   Status badge (Active/Sold/Expired)
    -   Variety name
    -   Quantity and price
    -   Location and harvest date
    -   Description (truncated)
    -   "View Details" and "Edit" buttons

#### 7. Bottom Navigation

-   [ ] Fixed at bottom of screen
-   [ ] Five navigation items:
    1. **Home** (active - orange color)
        - Icon: dashboard (filled)
        - Text: "Home"
    2. **Market**
        - Icon: storefront
        - Text: "Market"
    3. **Add Button** (center, elevated)
        - Large circular orange button
        - Plus icon
        - Floats above other items
    4. **Bids**
        - Icon: gavel
        - Text: "Bids"
    5. **Profile**
        - Icon: person
        - Text: "Profile"
-   [ ] Active item should be orange and bold
-   [ ] Inactive items should be gray
-   [ ] Hover should change color to orange

### Step 4: Test Responsive Design

#### Mobile View (375px width):

-   [ ] All components stack vertically
-   [ ] Bottom navigation is visible and functional
-   [ ] Header is sticky at top
-   [ ] Quick action buttons are in 3 columns
-   [ ] Stat cards are in 3 columns
-   [ ] Yield cards are full width

#### Tablet View (768px width):

-   [ ] Layout adjusts appropriately
-   [ ] Components maintain proper spacing

#### Desktop View (1024px+ width):

-   [ ] Content is centered with max-width
-   [ ] Bottom navigation still visible (mobile-first approach)

### Step 5: Test Dark Mode

1. **Enable Dark Mode:**
    - Open browser DevTools (F12)
    - Go to Console
    - Run: `document.documentElement.classList.add('dark')`
2. **Verify Dark Mode:**
    - [ ] Background changes to dark
    - [ ] Text changes to light
    - [ ] Cards have dark background
    - [ ] All components are readable
    - [ ] Icons are visible

### Step 6: Test Interactions

#### Header Menu:

-   [ ] Click hamburger icon → Menu slides in
-   [ ] Click outside menu → Menu closes
-   [ ] Click close button → Menu closes
-   [ ] Click menu items → Navigate to correct pages

#### Quick Action Buttons:

-   [ ] Hover → Shadow increases
-   [ ] Click → Navigates to correct page
-   [ ] Icon color changes on hover

#### Bottom Navigation:

-   [ ] Click items → Navigate to correct pages
-   [ ] Active state updates correctly
-   [ ] Center "Add" button → Navigates to create yield page

---

## Expected Issues & Solutions

### Issue 1: Components Not Found

**Error:** `View [components.header] not found`

**Solution:**

```bash
# Clear view cache
php artisan view:clear

# Clear config cache
php artisan config:clear

# Restart server
```

### Issue 2: Undefined Variable $stats

**Error:** `Undefined variable $stats`

**Solution:** Check FarmerController@dashboard method passes all required variables:

-   `$stats` (array with active_yields, pending_bids, sold_yields)
-   `$recentYields` (collection)
-   `$recentBids` (collection)

### Issue 3: Tailwind Classes Not Working

**Error:** Styles not applying

**Solution:**

-   Tailwind is loaded via CDN in layout
-   Check if `<script src="https://cdn.tailwindcss.com">` is present
-   Check browser console for errors

### Issue 4: Material Icons Not Showing

**Error:** Icons appear as text

**Solution:**

-   Check if Material Symbols font is loaded
-   Verify `<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">` is present

---

## Testing Checklist Summary

### Critical Path Testing:

-   [ ] Server is running
-   [ ] Database is migrated and seeded
-   [ ] Can access farmer dashboard
-   [ ] All components render without errors
-   [ ] Header shows correctly
-   [ ] Weather widget displays
-   [ ] Quick actions are clickable
-   [ ] Statistics show correct data
-   [ ] Bottom navigation is functional

### Thorough Testing (if time permits):

-   [ ] Test all navigation links
-   [ ] Test mobile menu functionality
-   [ ] Test responsive design at different widths
-   [ ] Test dark mode
-   [ ] Test with real data (create yields, receive bids)
-   [ ] Test error states
-   [ ] Test empty states
-   [ ] Test loading states
-   [ ] Cross-browser testing (Chrome, Firefox, Safari, Edge)

---

## Next Steps After Testing

### If Testing Passes:

1. Continue creating remaining components (8 more)
2. Create remaining views (19 more)
3. Implement PWA features
4. Add JavaScript enhancements

### If Testing Fails:

1. Document all errors found
2. Fix critical issues first
3. Re-test after fixes
4. Continue with remaining work

---

## Quick Test Command

```bash
# Open in default browser (Windows)
start http://127.0.0.1:8000/farmer/dashboard

# Open in default browser (Mac)
open http://127.0.0.1:8000/farmer/dashboard

# Open in default browser (Linux)
xdg-open http://127.0.0.1:8000/farmer/dashboard
```

---

**Status:** Ready for manual testing  
**Priority:** HIGH  
**Estimated Testing Time:** 15-20 minutes for critical path, 45-60 minutes for thorough testing
