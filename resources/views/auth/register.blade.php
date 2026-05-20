@extends('components.layout.template')

@section('title', 'Crear Cuenta')

@push('styles')
<style>
.auth-page {
    min-height: 85vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem 1rem;
}
.auth-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 40px rgba(0,0,0,.10);
    padding: 2.8rem 2.5rem 2.5rem;
    width: 100%;
    max-width: 480px;
}
.auth-logo { text-align: center; margin-bottom: 1.8rem; }
.auth-logo-icon {
    width: 56px; height: 56px; background: #111; border-radius: 14px;
    display: inline-flex; align-items: center; justify-content: center; margin-bottom: .6rem;
}
.auth-logo-icon svg { width:32px; height:32px; fill:#fff; }
.auth-logo-title { font-family: 'Rajdhani', sans-serif; font-size: 1.5rem; font-weight: 700; letter-spacing: 2px; color: #111; }
.auth-logo-sub { font-size: .82rem; color: #888; margin-top: .15rem; }
.auth-heading { font-family: 'Rajdhani', sans-serif; font-size: 1.6rem; font-weight: 700; color: #111; margin-bottom: 1.6rem; text-align: center; }
.auth-alert { border-radius: 10px; padding: .8rem 1rem; font-size: .875rem; margin-bottom: 1.2rem; }
.auth-alert--error { background: #fff0f0; color: #c0392b; border: 1px solid #f5c6cb; }
.auth-label { display: block; font-size: .82rem; font-weight: 600; color: #444; margin-bottom: .4rem; letter-spacing: .4px; }
.auth-input {
    width: 100%; padding: .72rem 1rem; border: 1.5px solid #ddd;
    border-radius: 10px; font-size: .95rem; color: #111;
    transition: border-color .2s, box-shadow .2s; background: #fafafa; outline: none;
}
.auth-input:focus { border-color: #111; box-shadow: 0 0 0 3px rgba(0,0,0,.07); background: #fff; }
.auth-input.is-invalid { border-color: #e74c3c; }
.auth-error { color: #e74c3c; font-size: .78rem; margin-top: .3rem; display: block; }
.auth-group { margin-bottom: 1.1rem; }
.auth-hint { font-size: .76rem; color: #999; margin-top: .25rem; }
.auth-check-wrap { display: flex; align-items: flex-start; gap: .5rem; margin-bottom: 1.4rem; }
.auth-check-wrap input[type="checkbox"] { margin-top: 2px; width:16px; height:16px; accent-color:#111; cursor:pointer; }
.auth-check-text { font-size: .84rem; color: #555; line-height: 1.5; }
.auth-btn {
    width: 100%; padding: .85rem; background: #111; color: #fff; border: none;
    border-radius: 10px; font-family: 'Rajdhani', sans-serif; font-size: 1.05rem;
    font-weight: 700; letter-spacing: 1px; cursor: pointer; transition: background .2s, transform .15s;
}
.auth-btn:hover { background: #333; transform: translateY(-1px); }
.auth-divider { text-align: center; color: #bbb; font-size: .82rem; margin: 1.3rem 0; position: relative; }
.auth-divider::before, .auth-divider::after { content: ''; position: absolute; top: 50%; width: 42%; height: 1px; background: #eee; }
.auth-divider::before { left: 0; } .auth-divider::after { right: 0; }
.auth-footer-link { text-align: center; font-size: .875rem; color: #666; }
.auth-footer-link a { color: #111; font-weight: 700; text-decoration: none; }
.auth-footer-link a:hover { text-decoration: underline; }
</style>
@endpush

@section('main')
<div class="auth-page">
    <div class="auth-card">

        <div class="auth-logo">
            <div class="auth-logo-icon">
                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <path d="M28.268 16.128c1.527-1.641 2.416-3.607 2.416-5.721-0-2.771-1.586-5.278-4.072-7.142 0.881 1.189 1.441 2.524 1.441 3.96 0 1.48-0.527 2.872-1.456 4.085l-0.599-1.726-2.873 0.899c-1.269-1.714-2.943-2.739-5.091-3.112-0.542-2.757-1.316-5.938-1.982-5.938s-1.44 3.181-1.982 5.938c-2.148 0.373-3.822 1.398-5.090 3.112l-2.872-0.899-0.598 1.726c-0.929-1.214-1.456-2.606-1.456-4.086 0-1.436 0.56-2.771 1.441-3.96-2.487 1.865-4.073 4.372-4.073 7.143 0 2.114 0.89 4.080 2.417 5.721l-0.625 1.803 2.877 1.328c-0.308 2.418-0.449 5.214-0.449 8.405 3.221 1.87 6.791 2.8 10.413 2.777 3.622 0.023 7.191-0.907 10.413-2.777 0-3.191-0.141-5.986-0.449-8.404l2.878-1.329-0.626-1.804z"/>
                </svg>
            </div>
            <div class="auth-logo-title">RACE<span style="color:#e74c3c">-</span>Helmets</div>
            <div class="auth-logo-sub">Crear cuenta de administrador</div>
        </div>

        <h1 class="auth-heading">Registro</h1>

        @if($errors->any())
            <div class="auth-alert auth-alert--error">
                ⚠ Por favor corrige los errores antes de continuar.
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" novalidate>
            @csrf

            <div class="auth-group">
                <label class="auth-label" for="name">Nombre completo</label>
                <input type="text" id="name" name="name"
                    class="auth-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    value="{{ old('name') }}" placeholder="Tu nombre" required>
                @error('name')<span class="auth-error">{{ $message }}</span>@enderror
            </div>

            <div class="auth-group">
                <label class="auth-label" for="email">Correo electrónico</label>
                <input type="email" id="email" name="email"
                    class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    value="{{ old('email') }}" placeholder="correo@ejemplo.com"
                    autocomplete="email" required>
                @error('email')<span class="auth-error">{{ $message }}</span>@enderror
            </div>

            <div class="auth-group">
                <label class="auth-label" for="password">Contraseña</label>
                <input type="password" id="password" name="password"
                    class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="Mínimo 8 caracteres"
                    autocomplete="new-password" required>
                <span class="auth-hint">Mínimo 8 caracteres.</span>
                @error('password')<span class="auth-error">{{ $message }}</span>@enderror
            </div>

            <div class="auth-group">
                <label class="auth-label" for="password_confirmation">Confirmar contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="auth-input"
                    placeholder="Repite tu contraseña"
                    autocomplete="new-password" required>
            </div>

            <div class="auth-check-wrap">
                <input type="checkbox" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
                <label for="terms" class="auth-check-text">
                    Acepto los <strong>términos y condiciones</strong> de uso de la plataforma.
                    @error('terms')<span class="auth-error" style="display:block">{{ $message }}</span>@enderror
                </label>
            </div>

            <button type="submit" class="auth-btn">CREAR CUENTA</button>
        </form>

        <div class="auth-divider">o</div>

        <p class="auth-footer-link">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </p>

    </div>
</div>
@endsection
