<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    // Show the login form.
    public function showLogin(): View
    {
        return view('auth.login');
    }

    // Handle a login attempt.
    public function login(Request $request): RedirectResponse
    {
        // Validate input. If it fails, the user is bounced back to the form automatically.
        $credentials = $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // This checks email + password against the DB on success: puts the user's ID into the session. 
        // Checks if remember is true or false. 
        // If statement only executes if false. 
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            // Redirects the user back to the page they came from.
            return back()
                ->withInput($request->only('email'))   // refill the email field
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }

        // Regenerate the session ID so an attacker who knew the old session ID can't hijack the logged-in session.
        $request->session()->regenerate();

        // Go to the page the user originally wanted, or the dashboard.
        return redirect()->intended(route('dashboard'));
    }

    // Show the registration form.
    public function showRegister(): View
    {
        return view('auth.register');
    }

    // Handle registration.
    public function register(Request $request): RedirectResponse
    {
        // Validate input. If it fails, the user is bounced back to the form automatically.
        // 'confirmed' rule = password_confirmation field must match.
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ]);

        // The 'hashed' cast on the model hashes the password for us.
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ]);

        // Auto-login the new user and regenerate the session (same as login).
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // Log the user out.
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Forget the whole session, then give the browser a fresh empty session with a new CSRF token.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out.');
    }
}
