# Contributing to One Place Agro

First off, thank you for considering contributing to One Place Agro! It's people like you that make One Place Agro such a great tool for the agricultural community.

## 🌾 Code of Conduct

This project and everyone participating in it is governed by our commitment to creating a welcoming and inclusive environment. By participating, you are expected to uphold this code.

## 🤔 How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the existing issues to avoid duplicates. When you create a bug report, include as many details as possible:

**Bug Report Template:**

```markdown
**Describe the bug**
A clear and concise description of what the bug is.

**To Reproduce**
Steps to reproduce the behavior:

1. Go to '...'
2. Click on '....'
3. Scroll down to '....'
4. See error

**Expected behavior**
A clear and concise description of what you expected to happen.

**Screenshots**
If applicable, add screenshots to help explain your problem.

**Environment:**

-   OS: [e.g. Windows 11, Ubuntu 22.04]
-   PHP Version: [e.g. 8.2.0]
-   Laravel Version: [e.g. 12.0]
-   Browser: [e.g. Chrome 120, Safari 17]

**Additional context**
Add any other context about the problem here.
```

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, include:

-   **Use a clear and descriptive title**
-   **Provide a detailed description** of the suggested enhancement
-   **Explain why this enhancement would be useful** to most users
-   **List any alternative solutions** you've considered

### Pull Requests

1. **Fork the repository** and create your branch from `main`
2. **Follow the coding standards** (see below)
3. **Test your changes** thoroughly
4. **Update documentation** if needed
5. **Write clear commit messages**
6. **Submit a pull request**

## 💻 Development Process

### Setting Up Development Environment

1. Fork and clone the repository:

```bash
git clone https://github.com/yourusername/one-place-agro.git
cd one-place-agro
```

2. Install dependencies:

```bash
composer install
npm install
```

3. Set up environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database and run migrations:

```bash
php artisan migrate
php artisan db:seed
```

5. Start development server:

```bash
php artisan serve
npm run dev
```

### Branch Naming Convention

Use descriptive branch names:

-   `feature/add-payment-gateway` - New features
-   `bugfix/fix-login-error` - Bug fixes
-   `hotfix/security-patch` - Urgent fixes
-   `docs/update-readme` - Documentation updates
-   `refactor/optimize-queries` - Code refactoring

### Commit Message Guidelines

Write clear, concise commit messages:

**Format:**

```
<type>(<scope>): <subject>

<body>

<footer>
```

**Types:**

-   `feat`: New feature
-   `fix`: Bug fix
-   `docs`: Documentation changes
-   `style`: Code style changes (formatting, etc.)
-   `refactor`: Code refactoring
-   `test`: Adding or updating tests
-   `chore`: Maintenance tasks

**Examples:**

```
feat(auth): add two-factor authentication

Implement 2FA using SMS verification for enhanced security.
Users can enable/disable 2FA in their profile settings.

Closes #123
```

```
fix(bidding): resolve duplicate bid submission issue

Prevent users from submitting multiple bids simultaneously
by adding request throttling and database constraints.

Fixes #456
```

## 📝 Coding Standards

### PHP/Laravel Standards

Follow **PSR-12** coding standards:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = Item::latest()->paginate(15);

        return view('items.index', compact('items'));
    }
}
```

**Key Points:**

-   Use type hints for parameters and return types
-   Add PHPDoc comments for complex methods
-   Follow Laravel naming conventions
-   Use dependency injection
-   Keep controllers thin, use services for business logic

### Blade Templates

```blade
{{-- Use Blade directives --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Always escape output --}}
        <h1>{{ $title }}</h1>

        {{-- Use @auth, @guest directives --}}
        @auth
            <p>Welcome, {{ auth()->user()->name }}</p>
        @endauth

        {{-- Use components --}}
        <x-alert type="success" message="Operation successful!" />
    </div>
@endsection
```

### JavaScript

```javascript
// Use modern ES6+ syntax
const fetchData = async () => {
    try {
        const response = await fetch("/api/data");
        const data = await response.json();
        return data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

// Use descriptive variable names
const userNotifications = [];
const isAuthenticated = true;
```

### CSS/Tailwind

```html
<!-- Use Tailwind utility classes -->
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Title</h1>
    <p class="text-gray-600 leading-relaxed">Content</p>
</div>
```

## 🧪 Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/AuthTest.php

# Run with coverage
php artisan test --coverage
```

### Writing Tests

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }
}
```

## 📚 Documentation

### Code Comments

```php
/**
 * Calculate the total price including tax.
 *
 * @param float $price The base price
 * @param float $taxRate The tax rate (e.g., 0.18 for 18%)
 * @return float The total price with tax
 */
public function calculateTotalPrice(float $price, float $taxRate): float
{
    return $price * (1 + $taxRate);
}
```

### README Updates

If your changes affect:

-   Installation process
-   Configuration
-   Usage instructions
-   API endpoints

Please update the README.md accordingly.

## 🔍 Code Review Process

### What We Look For

1. **Functionality**: Does it work as intended?
2. **Code Quality**: Is it clean, readable, and maintainable?
3. **Performance**: Are there any performance concerns?
4. **Security**: Are there any security vulnerabilities?
5. **Tests**: Are there adequate tests?
6. **Documentation**: Is it properly documented?

### Review Timeline

-   Small PRs (< 100 lines): 1-2 days
-   Medium PRs (100-500 lines): 3-5 days
-   Large PRs (> 500 lines): 5-7 days

## 🎯 Priority Areas

We especially welcome contributions in these areas:

1. **Bug Fixes**: Always appreciated!
2. **Performance Improvements**: Optimize queries, caching, etc.
3. **UI/UX Enhancements**: Improve user experience
4. **Documentation**: Help others understand the code
5. **Tests**: Increase test coverage
6. **Accessibility**: Make the app more accessible
7. **Internationalization**: Add language support

## 📋 Pull Request Checklist

Before submitting your PR, ensure:

-   [ ] Code follows PSR-12 standards
-   [ ] All tests pass (`php artisan test`)
-   [ ] New features have tests
-   [ ] Documentation is updated
-   [ ] Commit messages are clear
-   [ ] No merge conflicts
-   [ ] Branch is up to date with main
-   [ ] Code is properly commented
-   [ ] No debugging code left (console.log, dd(), etc.)

## 🚀 Release Process

1. Version bump in `composer.json`
2. Update `CHANGELOG.md`
3. Create release tag
4. Deploy to production

## 💬 Communication

-   **GitHub Issues**: Bug reports and feature requests
-   **Pull Requests**: Code contributions
-   **Discussions**: General questions and ideas

## 🙏 Recognition

Contributors will be:

-   Listed in the README.md
-   Mentioned in release notes
-   Given credit in commit history

## 📄 License

By contributing, you agree that your contributions will be licensed under the MIT License.

---

Thank you for contributing to One Place Agro! 🌾

Together, we're building a better platform for the agricultural community.
