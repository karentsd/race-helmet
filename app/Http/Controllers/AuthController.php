<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ── Registro ──────────────────────────────────────────────
    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name'                  => ['required', 'string', 'min:2', 'max:100'],
            'email'                 => ['required', 'email:rfc', 'max:180', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'terms'                 => ['accepted'],
        ], [
            'name.required'         => 'El nombre es obligatorio.',
            'name.min'              => 'El nombre debe tener al menos 2 caracteres.',
            'email.required'        => 'El correo es obligatorio.',
            'email.email'           => 'Ingresa un correo válido.',
            'email.unique'          => 'Este correo ya está registrado.',
            'password.required'     => 'La contraseña es obligatoria.',
            'password.min'          => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed'    => 'Las contraseñas no coinciden.',
            'terms.accepted'        => 'Debes aceptar los términos para continuar.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('messages')
            ->with('success', '¡Bienvenido, ' . $user->name . '! Tu cuenta fue creada exitosamente.');
    }

    // ── Login ─────────────────────────────────────────────────
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'El correo es obligatorio.',
            'email.email'       => 'Ingresa un correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('messages'))
                ->with('success', '¡Bienvenido de nuevo, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Correo o contraseña incorrectos.']);
    }

    // ── Logout ────────────────────────────────────────────────
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}
