#!/bin/bash

# One Place Agro - Deployment Script
# This script helps deploy the application to a production server

echo "=========================================="
echo "One Place Agro - Deployment Script"
echo "=========================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if .env exists
if [ ! -f .env ]; then
    echo -e "${RED}Error: .env file not found!${NC}"
    echo "Please copy .env.example to .env and configure it first."
    exit 1
fi

echo -e "${GREEN}Step 1: Installing Composer dependencies...${NC}"
composer install --optimize-autoloader --no-dev

echo ""
echo -e "${GREEN}Step 2: Installing NPM dependencies...${NC}"
npm install

echo ""
echo -e "${GREEN}Step 3: Building assets...${NC}"
npm run build

echo ""
echo -e "${GREEN}Step 4: Setting up Laravel...${NC}"

# Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    php artisan key:generate
fi

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

echo ""
echo -e "${GREEN}Step 5: Clearing and caching...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo -e "${GREEN}Step 6: Setting permissions...${NC}"
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Try to set ownership (may require sudo)
if [ "$EUID" -eq 0 ]; then
    chown -R www-data:www-data storage bootstrap/cache
    echo "Ownership set to www-data"
else
    echo -e "${YELLOW}Note: Run 'sudo chown -R www-data:www-data storage bootstrap/cache' manually${NC}"
fi

echo ""
echo -e "${GREEN}Step 7: Creating symbolic link for storage...${NC}"
php artisan storage:link

echo ""
echo "=========================================="
echo -e "${GREEN}Deployment completed successfully!${NC}"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Ensure .htaccess is in the root directory"
echo "2. Verify mod_rewrite is enabled (Apache)"
echo "3. Test the application at your domain"
echo "4. Check browser console for any CSP violations"
echo ""
echo "For detailed server setup instructions, see:"
echo "  - SERVER_SETUP_GUIDE.md"
echo ""
echo "To fix CSP violations, follow:"
echo "  - TODO.md"
echo ""
