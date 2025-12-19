# Landing Page - Interface Section Mockups Guide

## Overview

The landing page now includes an "Interface" section that showcases app mockups in beautiful phone frames. This guide explains how to add your actual app mockup images.

## Current Setup

The Interface section is located between the "About" and "Contact" sections and includes:

-   3 mockup placeholders with realistic phone frames
-   Horizontal scrolling on mobile devices
-   Hover animations and scale effects
-   Gradient backgrounds as placeholders
-   Swipe indicator for mobile users

## How to Add Your Mockup Images

### Option 1: Using External URLs (Recommended for Quick Setup)

Replace the placeholder `<div>` content with an `<img>` tag:

```html
<!-- Before (Placeholder) -->
<div
    class="w-full h-full bg-gradient-to-br from-green-50 to-orange-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center"
>
    <div class="text-center p-6">
        <span class="material-symbols-outlined text-6xl text-primary mb-4"
            >dashboard</span
        >
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Farmer Dashboard Mockup
        </p>
    </div>
</div>

<!-- After (With Image) -->
<img
    src="https://your-image-url.com/farmer-dashboard.png"
    alt="Farmer Dashboard"
    class="w-full h-full object-cover"
/>
```

### Option 2: Using Local Images (Recommended for Production)

1. **Create a mockups directory:**

    ```bash
    mkdir -p public/images/mockups
    ```

2. **Add your mockup images:**

    - Place your PNG/JPG images in `public/images/mockups/`
    - Recommended naming:
        - `farmer-dashboard.png`
        - `marketplace.png`
        - `weather-tools.png`

3. **Update the HTML:**
    ```html
    <img
        src="{{ asset('images/mockups/farmer-dashboard.png') }}"
        alt="Farmer Dashboard"
        class="w-full h-full object-cover"
    />
    ```

## Mockup Specifications

### Image Dimensions

-   **Recommended Size:** 1080 x 2340 pixels (9:19.5 aspect ratio)
-   **Format:** PNG with transparency or JPG
-   **File Size:** Keep under 500KB for optimal loading

### Phone Frame Dimensions

-   **Width:** 280px (mobile) / 300px (desktop)
-   **Height:** 580px
-   **Border Radius:** 2rem (32px)

## Current Mockup Placeholders

### 1. Farmer Dashboard (Left)

-   **Purpose:** Show farmer's main dashboard
-   **Suggested Content:**
    -   Active listings
    -   Weather widget
    -   Recent bids
    -   Quick actions

### 2. Marketplace (Center)

-   **Purpose:** Show browse/marketplace view
-   **Suggested Content:**
    -   List of yields or requirements
    -   Search/filter options
    -   Product cards

### 3. Weather & Tools (Right)

-   **Purpose:** Show utility features
-   **Suggested Content:**
    -   Weather forecast
    -   News feed
    -   Market prices

## Adding More Mockups

To add additional mockup frames, copy this template:

```html
<div
    class="snap-center shrink-0 w-[280px] md:w-[300px] bg-gray-900 rounded-[2.5rem] p-3 border-4 border-gray-200 dark:border-gray-700 shadow-2xl relative hover:scale-105 transition-transform duration-300"
>
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 h-6 w-32 bg-gray-900 rounded-b-xl z-20"
    ></div>
    <div
        class="bg-white dark:bg-gray-800 w-full h-[580px] rounded-[2rem] overflow-hidden relative"
    >
        <!-- Your mockup image here -->
        <img
            src="{{ asset('images/mockups/your-screen.png') }}"
            alt="Your Screen"
            class="w-full h-full object-cover"
        />

        <!-- Overlay with title -->
        <div
            class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-6"
        >
            <div class="text-white">
                <p class="text-xs font-bold uppercase text-primary mb-1">
                    Category
                </p>
                <h4 class="font-bold text-lg">Screen Title</h4>
            </div>
        </div>
    </div>
</div>
```

## Tips for Best Results

1. **Use High-Quality Screenshots:**

    - Take screenshots from actual app or high-fidelity designs
    - Ensure text is readable
    - Use consistent UI theme

2. **Optimize Images:**

    - Compress images using tools like TinyPNG
    - Use WebP format for better compression
    - Lazy load images for performance

3. **Maintain Consistency:**

    - Use same device frame style
    - Keep similar lighting/shadows
    - Match color schemes

4. **Test Responsiveness:**
    - Check on mobile devices (swipe functionality)
    - Verify on tablets
    - Test on desktop (hover effects)

## Example Implementation

Here's a complete example with an actual image:

```html
<!-- Mockup 1 - Farmer Dashboard -->
<div
    class="snap-center shrink-0 w-[280px] md:w-[300px] bg-gray-900 rounded-[2.5rem] p-3 border-4 border-gray-200 dark:border-gray-700 shadow-2xl relative hover:scale-105 transition-transform duration-300"
>
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 h-6 w-32 bg-gray-900 rounded-b-xl z-20"
    ></div>
    <div
        class="bg-white dark:bg-gray-800 w-full h-[580px] rounded-[2rem] overflow-hidden relative"
    >
        <img
            src="{{ asset('images/mockups/farmer-dashboard.png') }}"
            alt="Farmer Dashboard showing active listings and weather"
            class="w-full h-full object-cover"
            loading="lazy"
        />
        <div
            class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-6"
        >
            <div class="text-white">
                <p class="text-xs font-bold uppercase text-primary mb-1">
                    Farmer Dashboard
                </p>
                <h4 class="font-bold text-lg">Manage Your Yields</h4>
            </div>
        </div>
    </div>
</div>
```

## Location in Code

The Interface section is located in `resources/views/landing.blade.php` at approximately line 400-500, between:

-   `<!-- About Section -->` (above)
-   `<!-- Contact Section -->` (below)

Search for `<!-- Interface Section -->` to find it quickly.

## Need Help?

If you need assistance:

1. Check that images are in the correct directory
2. Verify file permissions (images should be readable)
3. Clear Laravel cache: `php artisan cache:clear`
4. Check browser console for 404 errors

---

**Last Updated:** December 2024
