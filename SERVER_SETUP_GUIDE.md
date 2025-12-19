# Server Setup Guide - Remove /public from URL

## Option 1: Using .htaccess (Recommended for Shared Hosting)

The `.htaccess` file has been created in the root directory. This will automatically redirect all requests to the `/public` folder.

### Steps:

1. Upload all files to your server's document root (e.g., `/home/username/public_html` or `/var/www/html`)
2. Ensure the `.htaccess` file is in the root directory (same level as `artisan`)
3. Make sure `mod_rewrite` is enabled on Apache
4. Set proper permissions:
    ```bash
    chmod -R 755 storage bootstrap/cache
    chown -R www-data:www-data storage bootstrap/cache
    ```
5. Clear Laravel cache:
    ```bash
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear
    ```

### Verify .htaccess is working:

-   Visit: `http://yourdomain.com` (should work)
-   Visit: `http://yourdomain.com/public` (should also work)

---

## Option 2: Change Document Root (Recommended for VPS/Dedicated Server)

### For Apache:

Edit your virtual host configuration (usually in `/etc/apache2/sites-available/`):

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com

    DocumentRoot /var/www/html/one-place-agro/public

    <Directory /var/www/html/one-place-agro/public>
        AllowOverride All
        Require all granted
        Options -Indexes +FollowSymLinks
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/one-place-agro-error.log
    CustomLog ${APACHE_LOG_DIR}/one-place-agro-access.log combined
</VirtualHost>
```

Then restart Apache:

```bash
sudo systemctl restart apache2
```

### For Nginx:

Edit your server block configuration:

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/html/one-place-agro/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Then restart Nginx:

```bash
sudo systemctl restart nginx
```

---

## Option 3: Symlink Method (Alternative)

If you can't change document root or use .htaccess:

1. Move the contents of `/public` to your document root
2. Update `index.php` to point to the correct paths:

```php
// Update these lines in index.php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

Change to:

```php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

**Note:** This method is less secure and not recommended.

---

## Security Considerations

### 1. Protect Sensitive Files

Ensure these files/folders are NOT accessible via web:

-   `.env`
-   `storage/`
-   `bootstrap/cache/`
-   `vendor/`
-   `composer.json`
-   `artisan`

### 2. Set Proper Permissions

```bash
# Set directory permissions
find . -type d -exec chmod 755 {} \;

# Set file permissions
find . -type f -exec chmod 644 {} \;

# Make storage and cache writable
chmod -R 775 storage bootstrap/cache

# Set ownership (replace www-data with your web server user)
chown -R www-data:www-data storage bootstrap/cache
```

### 3. Environment Configuration

Update your `.env` file:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

---

## Troubleshooting

### Issue: 404 errors on all routes except homepage

**Solution:** Enable `mod_rewrite` for Apache

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### Issue: 500 Internal Server Error

**Solution:** Check permissions and clear cache

```bash
chmod -R 775 storage bootstrap/cache
php artisan config:clear
php artisan cache:clear
```

### Issue: Assets not loading (CSS/JS)

**Solution:** Run asset compilation

```bash
npm install
npm run build
```

### Issue: .htaccess not working

**Solution:** Check if `AllowOverride All` is set in Apache config

```apache
<Directory /var/www/html>
    AllowOverride All
</Directory>
```

---

## Post-Deployment Checklist

-   [ ] `.htaccess` file is in root directory
-   [ ] `mod_rewrite` is enabled (Apache)
-   [ ] Storage and cache directories are writable
-   [ ] `.env` file is configured for production
-   [ ] Database credentials are correct
-   [ ] All caches are cleared
-   [ ] Assets are compiled (`npm run build`)
-   [ ] Test all major routes
-   [ ] Check browser console for errors
-   [ ] Verify CSP compliance (after implementing CSP fixes)

---

## Next Steps: Fix CSP Violations

After setting up the server, you should address the Content Security Policy violations by following the TODO.md file to:

1. Remove inline event handlers
2. Move inline scripts to external files
3. Configure CSP headers
4. Test all functionality

This will make your application more secure and compliant with modern web security standards.
