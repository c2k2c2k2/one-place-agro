<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the role selection page.
     */
    public function showRoleSelection(): View
    {
        return view('auth.role-selection');
    }

    /**
     * Display the registration form.
     */
    public function showRegistrationForm(Request $request): View
    {
        $role = $request->query('role', 'farmer');

        // Validate role parameter
        if (! in_array($role, ['farmer', 'trader'])) {
            $role = 'farmer';
        }

        return view('auth.register', compact('role'));
    }

    /**
     * Handle user registration.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        // Create new user
        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email ?? null, // Optional email field
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'location' => $request->location,
            'company_name' => $request->company_name,
            'is_verified' => false, // Default to unverified
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect based on role
        return $this->redirectBasedOnRole($user);
    }

    /**
     * Display the login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = [
            'mobile' => $request->mobile,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on role
            return $this->redirectBasedOnRole($user);
        }

        return back()->withErrors([
            'mobile' => 'The provided credentials do not match our records.',
        ])->onlyInput('mobile');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Redirect user based on their role.
     */
    private function redirectBasedOnRole(User $user): RedirectResponse
    {
        return match ($user->role) {
            'farmer' => redirect()->route('farmer.dashboard')->with('success', 'Welcome back, '.$user->name.'!'),
            'trader' => redirect()->route('trader.dashboard')->with('success', 'Welcome back, '.$user->name.'!'),
            'admin' => redirect()->route('admin.dashboard')->with('success', 'Welcome back, Administrator!'),
            default => redirect()->route('home')->with('error', 'Invalid user role.'),
        };
    }
}
