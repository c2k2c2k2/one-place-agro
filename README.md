# 🌾 One Place Agro

<p align="center">
  <img src="public/favicon.svg" alt="One Place Agro Logo" width="120" height="120">
</p>

<p align="center">
  <strong>A Progressive Web App (PWA) connecting farmers and traders for seamless agricultural produce trading</strong>
</p>

<p align="center">
  <a href="#features">Features</a> •
  <a href="#tech-stack">Tech Stack</a> •
  <a href="#installation">Installation</a> •
  <a href="#usage">Usage</a> •
  <a href="#project-structure">Structure</a> •
  <a href="#contributing">Contributing</a>
</p>

---

## 📖 About

**One Place Agro** is a modern agricultural trading platform that bridges the gap between farmers and traders. Built as a Progressive Web App, it enables farmers to list their produce, traders to post requirements and place bids, and provides real-time market prices and agricultural news to all users.

### 🎯 Key Objectives

-   **Empower Farmers**: Direct access to traders without intermediaries
-   **Streamline Trading**: Transparent bidding system with real-time notifications
-   **Market Intelligence**: Live market prices and agricultural news
-   **Mobile-First**: PWA for seamless mobile experience with offline capabilities

---

## ✨ Features

### 👨‍🌾 For Farmers

-   ✅ **Yield Management**: Add, edit, and manage crop listings with images
-   ✅ **Bid Management**: Receive, review, accept, or reject trader bids
-   ✅ **Market Insights**: View real-time market prices for informed pricing
-   ✅ **Dashboard**: Track active listings, pending bids, and earnings

### 🏢 For Traders

-   ✅ **Browse Yields**: Search and filter available farmer produce
-   ✅ **Post Requirements**: Specify crop needs and budget
-   ✅ **Bidding System**: Place competitive bids on farmer yields
-   ✅ **Bid Tracking**: Monitor bid status (pending, accepted, rejected)

### 🌐 Shared Features

-   ✅ **Real-time Notifications**: Instant updates on bids and transactions
-   ✅ **Market Prices**: Live price tracking with historical charts
-   ✅ **Agricultural News**: Curated news feed for farming community
-   ✅ **Multi-role Authentication**: Secure login with mobile number
-   ✅ **Responsive Design**: Optimized for mobile, tablet, and desktop
-   ✅ **PWA Support**: Install as native app with offline capabilities

### 🔐 Admin Features

-   ✅ **User Management**: Manage farmers and traders
-   ✅ **Content Moderation**: Review and moderate listings
-   ✅ **Analytics Dashboard**: Platform statistics and insights

---

## 🛠️ Tech Stack

### Backend

-   **Framework**: Laravel 12.x
-   **PHP**: 8.2+
-   **Database**: MySQL 8.0+
-   **Authentication**: Laravel Sanctum
-   **Validation**: Form Requests

### Frontend

-   **Template Engine**: Blade
-   **CSS Framework**: Tailwind CSS 3.x
-   **JavaScript**: Vanilla JS + Alpine.js
-   **Build Tool**: Vite

### Additional Tools

-   **Image Processing**: Intervention Image
-   **Notifications**: Laravel Notifications
-   **Caching**: Redis (optional)
-   **Queue**: Database/Redis

---

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

-   **PHP** >= 8.2
-   **Composer** >= 2.5
-   **Node.js** >= 18.x
-   **NPM** >= 9.x
-   **MySQL** >= 8.0 or **MariaDB** >= 10.3
-   **Git**

### Optional

-   **Redis** (for caching and queues)
-   **Supervisor** (for queue workers in production)

---

## 🚀 Installation

Follow these steps to set up the project locally:

### 1. Clone the Repository

```bash
git clone https://github.com/c2k2c2k2/one-place-agro.git
cd one-place-agro
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the example environment file and configure it:

```bash
# Windows
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

Edit `.env` file and configure the following:

```env
APP_NAME="One Place Agro"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=one_place_agro
DB_USERNAME=root
DB_PASSWORD=your_password

# Optional: Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password

# Optional: Redis Configuration
CACHE_DRIVER=file
QUEUE_CONNECTION=database
SESSION_DRIVER=file
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Create Database

Create a new MySQL database:

```sql
CREATE DATABASE one_place_agro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Seed Database (Optional)

Populate the database with sample data:

```bash
php artisan db:seed
```

This will create:

-   3 Admin users
-   20 Farmers
-   15 Traders
-   50+ Crop varieties
-   100+ Yields
-   200+ Bids
-   Market prices
-   News articles
-   Notifications

**Default Test Accounts:**

| Role   | Mobile     | Password |
| ------ | ---------- | -------- |
| Admin  | 9999999999 | password |
| Farmer | 9876543210 | password |
| Trader | 9876543211 | password |

### 9. Create Storage Link

```bash
php artisan storage:link
```

### 10. Build Frontend Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 11. Start Development Server

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

### 12. Start Queue Worker (Optional)

For processing notifications and background jobs:

```bash
php artisan queue:work
```

---

## 🎮 Usage

### Accessing the Application

1. **Landing Page**: Visit `http://localhost:8000`
2. **Role Selection**: Choose between Farmer or Trader
3. **Register**: Create a new account with mobile number
4. **Login**: Use mobile number and password

### Farmer Workflow

1. **Login** as farmer
2. **Add Yield**: Navigate to "Add Yield" and fill in crop details
3. **Upload Images**: Add up to 5 images of your produce
4. **Manage Bids**: View and respond to trader bids
5. **Track Listings**: Monitor active yields and sales

### Trader Workflow

1. **Login** as trader
2. **Browse Yields**: Search available farmer produce
3. **Place Bid**: Submit competitive bids on yields
4. **Post Requirements**: Specify what you're looking for
5. **Track Bids**: Monitor bid status and responses

### Admin Workflow

1. **Login** as admin
2. **Dashboard**: View platform statistics
3. **Manage Users**: Review and moderate user accounts
4. **Content Moderation**: Monitor listings and bids

---

## 📁 Project Structure

```
one-place-agro/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Application controllers
│   │   ├── Middleware/       # Custom middleware
│   │   └── Requests/         # Form request validators
│   └── Models/               # Eloquent models
├── bootstrap/                # Application bootstrap
├── config/                   # Configuration files
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── public/                   # Public assets
│   ├── .htaccess            # Apache configuration
│   └── index.php            # Entry point
├── resources/
│   ├── css/                 # Stylesheets
│   ├── js/                  # JavaScript files
│   └── views/               # Blade templates
│       ├── auth/            # Authentication views
│       ├── farmer/          # Farmer views
│       ├── trader/          # Trader views
│       ├── admin/           # Admin views
│       └── layouts/         # Layout templates
├── routes/
│   └── web.php              # Web routes
├── storage/                 # Storage directory
├── tests/                   # Test files
├── .env.example             # Environment example
├── .gitignore              # Git ignore rules
├── .htaccess               # Root htaccess
├── composer.json           # PHP dependencies
├── package.json            # Node dependencies
└── vite.config.js          # Vite configuration
```

---

## 🔧 Configuration

### Apache Configuration

The project includes `.htaccess` files for Apache servers:

-   **Root `.htaccess`**: Redirects all requests to `public/` directory
-   **Public `.htaccess`**: Laravel routing configuration

### Nginx Configuration

If using Nginx, add this to your server block:

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/one-place-agro/public;

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

### File Permissions

Set proper permissions for storage and cache:

```bash
# Linux/Mac
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Or for development
chmod -R 777 storage bootstrap/cache
```

---

## 🧪 Testing

### Manual Testing

Test accounts are created during seeding:

```bash
php artisan db:seed
```

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=ExampleTest
```

---

## 📱 PWA Installation

### On Mobile Devices

1. Open the app in your mobile browser
2. Tap the browser menu (⋮)
3. Select "Add to Home Screen" or "Install App"
4. Follow the prompts

### Features When Installed

-   ✅ Native app-like experience
-   ✅ Offline functionality
-   ✅ Push notifications
-   ✅ Faster load times
-   ✅ Home screen icon

---

## 🚀 Deployment

### Production Checklist

Before deploying to production:

-   [ ] Set `APP_ENV=production` in `.env`
-   [ ] Set `APP_DEBUG=false` in `.env`
-   [ ] Configure proper database credentials
-   [ ] Set up SSL certificate (HTTPS)
-   [ ] Configure mail server
-   [ ] Set up queue worker with Supervisor
-   [ ] Enable caching:
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```
-   [ ] Optimize autoloader:
    ```bash
    composer install --optimize-autoloader --no-dev
    ```
-   [ ] Build production assets:
    ```bash
    npm run build
    ```
-   [ ] Set proper file permissions
-   [ ] Configure backup strategy
-   [ ] Set up monitoring and logging

### Deployment Platforms

The application can be deployed on:

-   **Shared Hosting**: cPanel with PHP 8.2+
-   **VPS**: DigitalOcean, Linode, AWS EC2
-   **PaaS**: Laravel Forge, Ploi, Heroku
-   **Serverless**: Laravel Vapor

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards

-   Follow PSR-12 coding standards
-   Write descriptive commit messages
-   Add comments for complex logic
-   Update documentation as needed

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👥 Authors

-   **Your Name** - _Initial work_ - [YourGitHub](https://github.com/yourusername)

---

## 🙏 Acknowledgments

-   Laravel Framework
-   Tailwind CSS
-   All contributors and testers
-   Agricultural community for feedback

---

## 📞 Support

For support, email support@oneplaceagro.com or open an issue on GitHub.

---

## 🗺️ Roadmap

### Phase 1: Foundation ✅

-   Database schema and migrations
-   Eloquent models and relationships
-   Database seeders

### Phase 2: Authentication ✅

-   Multi-role authentication system
-   Registration and login
-   Role-based middleware

### Phase 3: Core Features ✅

-   Farmer yield management
-   Trader bidding system
-   Market prices and news
-   Notification system

### Phase 4: UI Integration 🚧

-   Convert reference HTML to Blade
-   PWA implementation
-   Responsive design

### Phase 5: Advanced Features 📋

-   Real-time notifications
-   Advanced search and filters
-   Analytics dashboard
-   Weather integration

### Phase 6: Testing & Optimization 📋

-   Comprehensive testing
-   Performance optimization
-   Security hardening
-   Documentation

---

<p align="center">Made with ❤️ for the agricultural community</p>
