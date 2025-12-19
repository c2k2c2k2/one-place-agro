# CSP Compliance & Server Configuration TODO

## Phase 1: Create Centralized JavaScript Module

-   [ ] Create `resources/js/csp-safe.js` with all event handlers
-   [ ] Update `resources/js/app.js` to import new module
-   [ ] Compile assets using Vite

## Phase 2: Remove Inline Event Handlers (23 files)

-   [ ] `resources/views/components/header.blade.php` - toggleMenu
-   [ ] `resources/views/components/form/image-upload.blade.php` - image handlers
-   [ ] `resources/views/farmer/yields/show.blade.php` - changeImage, delete confirm
-   [ ] `resources/views/trader/yields/show.blade.php` - changeImage
-   [ ] `resources/views/trader/yields/browse.blade.php` - toggleFilters
-   [ ] `resources/views/farmer/requirements/browse.blade.php` - toggleFilters
-   [ ] `resources/views/trader/requirements/show.blade.php` - delete confirm
-   [ ] `resources/views/trader/bids/show.blade.php` - cancel confirm
-   [ ] `resources/views/notifications/index.blade.php` - clear confirm
-   [ ] `resources/views/legal/terms-of-service.blade.php` - back button
-   [ ] `resources/views/legal/privacy-policy.blade.php` - back button
-   [ ] `resources/views/legal/content-policy.blade.php` - back button
-   [ ] `resources/views/components/notification-card.blade.php` - stopPropagation

## Phase 3: Move Inline Scripts to External Files

-   [ ] Move all @push('scripts') content to centralized JS
-   [ ] Remove inline flash message scripts from layouts/app.blade.php
-   [ ] Add CSP nonce support for Tailwind config

## Phase 4: Configure CSP Headers

-   [ ] Add CSP middleware in bootstrap/app.php
-   [ ] Generate nonces for inline scripts
-   [ ] Test CSP compliance

## Phase 5: Server Configuration (Remove /public from URL)

-   [x] Create .htaccess for document root
-   [x] Create SERVER_SETUP_GUIDE.md with detailed instructions
-   [ ] Deploy to server and test all routes

## Testing Checklist

-   [ ] Menu toggle works
-   [ ] Image gallery navigation works
-   [ ] Form confirmations work
-   [ ] File upload previews work
-   [ ] Back buttons work
-   [ ] All routes accessible without /public
-   [ ] CSP violations resolved in browser console
