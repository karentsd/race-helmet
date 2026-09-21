<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | RACE-Helmets</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/template.css', 'resources/js/template.js'])

    <style>
    /* ── Header auth ── */
    .hdr-auth { display:flex; align-items:center; gap:.6rem; }
    .hdr-username { font-size:.8rem; font-weight:600; color:#fff; opacity:.85; max-width:100px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    .hdr-logout-btn { background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); border-radius:8px; padding:.35rem .5rem; cursor:pointer; color:#fff; display:flex; align-items:center; transition:background .2s; }
    .hdr-logout-btn:hover { background:rgba(255,255,255,.22); }
    .hdr-login-btn { display:flex; align-items:center; gap:.4rem; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.25); border-radius:8px; padding:.38rem .75rem; color:#fff; font-size:.82rem; font-weight:600; text-decoration:none; transition:background .2s; }
    .hdr-login-btn:hover { background:rgba(255,255,255,.22); color:#fff; }
    </style>
    @stack('styles')

    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>

    {{-- ===================== HEADER ===================== --}}
    <header id="header">
        <div class="hdr-left">
            <div class="menu-container" id="menu" aria-label="Abrir menú" role="button" tabindex="0">
                <div class="menu" id="menu-icon">
                    <div></div><div></div><div></div>
                </div>
            </div>
            <a href="{{ route('home') }}" class="brand">
                <div class="brand-icon">
                    {{-- Logo SVG casco --}}
                    <svg fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <title>helmet</title>
                        <path d="M28.268 16.128c1.527-1.641 2.416-3.607 2.416-5.721-0-2.771-1.586-5.278-4.072-7.142 0.881 1.189 1.441 2.524 1.441 3.96 0 1.48-0.527 2.872-1.456 4.085l-0.599-1.726-2.873 0.899c-1.269-1.714-2.943-2.739-5.091-3.112-0.542-2.757-1.316-5.938-1.982-5.938s-1.44 3.181-1.982 5.938c-2.148 0.373-3.822 1.398-5.090 3.112l-2.872-0.899-0.598 1.726c-0.929-1.214-1.456-2.606-1.456-4.086 0-1.436 0.56-2.771 1.441-3.96-2.487 1.865-4.073 4.372-4.073 7.143 0 2.114 0.89 4.080 2.417 5.721l-0.625 1.803 2.877 1.328c-0.308 2.418-0.449 5.214-0.449 8.405 3.221 1.87 6.791 2.8 10.413 2.777 3.622 0.023 7.191-0.907 10.413-2.777 0-3.191-0.141-5.986-0.449-8.404l2.878-1.329-0.626-1.804zM17.44 21.359c-0.307 2.517-0.722 6.365-0.722 8.75h-1.331c0-2.388-0.416-6.241-0.723-8.758-4.542-0.291-6.496-1.882-6.496-1.882s0.144-1.054 0.285-1.881c0-0.001 0-0.003 0.001-0.004 0.011-0.064 0.022-0.126 0.033-0.187 0.001-0.005 0.002-0.009 0.002-0.014 0.004-0.025 0.009-0.049 0.013-0.073 0.001-0.006 0.002-0.011 0.003-0.017 0.010-0.055 0.020-0.109 0.030-0.159 0.001-0.006 0.002-0.013 0.004-0.019 0.004-0.019 0.007-0.038 0.011-0.056 0.001-0.006 0.003-0.013 0.004-0.019 0.005-0.023 0.010-0.046 0.014-0.068 2.401 0.809 4.929 1.216 7.486 1.201 2.556 0.014 5.084-0.393 7.485-1.201 0.005 0.021 0.009 0.044 0.014 0.066 0.002 0.008 0.003 0.016 0.005 0.024 0.003 0.016 0.006 0.032 0.010 0.048 0.002 0.009 0.003 0.018 0.005 0.027 0.004 0.021 0.008 0.042 0.012 0.064 0.002 0.009 0.003 0.018 0.005 0.026 0.004 0.019 0.007 0.039 0.011 0.059 0.002 0.012 0.004 0.023 0.006 0.035 0.003 0.015 0.006 0.031 0.008 0.046 0.002 0.012 0.004 0.025 0.007 0.037 0.003 0.019 0.007 0.038 0.010 0.058s0.007 0.037 0.010 0.056c0.003 0.016 0.006 0.032 0.008 0.049 0.003 0.015 0.005 0.030 0.008 0.045 0.002 0.014 0.005 0.028 0.007 0.042 0.003 0.016 0.005 0.032 0.008 0.049 0.002 0.014 0.005 0.029 0.007 0.043 0.004 0.027 0.009 0.053 0.013 0.080 0.002 0.015 0.005 0.030 0.007 0.044 0.003 0.017 0.005 0.033 0.008 0.050 0.002 0.014 0.005 0.028 0.007 0.042 0.003 0.016 0.005 0.032 0.008 0.047 0.004 0.023 0.007 0.045 0.011 0.068 0.003 0.017 0.006 0.035 0.008 0.052s0.006 0.037 0.009 0.055c0.002 0.014 0.004 0.028 0.006 0.042 0.003 0.017 0.005 0.035 0.008 0.052 0.002 0.013 0.004 0.027 0.006 0.040 0.004 0.028 0.009 0.056 0.013 0.084 0.001 0.009 0.003 0.017 0.004 0.026 0.003 0.023 0.007 0.046 0.010 0.068 0.001 0.008 0.003 0.017 0.004 0.025 0.004 0.026 0.008 0.051 0.011 0.076 0.001 0.004 0.001 0.008 0.002 0.012 0.072 0.481 0.123 0.859 0.123 0.859s-1.886 1.62-6.498 1.889z"></path>
                    </svg>
                </div>
                <span class="brand-name">RACE<span class="brand-dot">-</span>Helmets</span>
            </a>
        </div>
        <div class="hdr-right">
            <a href="{{ route('cart') }}" class="cart-hdr-btn" title="Mi carrito">
                <svg viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:22px;height:22px">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                <span class="cart-nav-badge" style="display:none">0</span>
            </a>
            @auth
                <div class="hdr-auth">
                    <span class="hdr-username">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="hdr-logout-btn" title="Cerrar sesión">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="hdr-login-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:17px;height:17px"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10,17 15,12 10,7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Admin
                </a>
            @endauth
        </div>
    </header>

    {{-- ===================== SIDEBAR ===================== --}}
    <div class="sidebar" id="sidebar">
        <nav>
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline points="9,22 9,12 15,12 15,22"/>
                        </svg>
                        <span class="nav-label">Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="7" height="7"/><rect x="15" y="3" width="7" height="7"/>
                            <rect x="15" y="14" width="7" height="7"/><rect x="2" y="14" width="7" height="7"/>
                        </svg>
                        <span class="nav-label">Catálogo</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('us') }}" class="{{ request()->routeIs('us') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                        <span class="nav-label">Nosotros</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('support') }}" class="{{ request()->routeIs('support') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0118 0v6"/>
                            <path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3z"/>
                            <path d="M3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/>
                        </svg>
                        <span class="nav-label">Soporte</span>
                    </a>
                </li>
                @auth
                <li>
                    <a href="{{ route('messages') }}" class="{{ request()->routeIs('messages') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <span class="nav-label">PQRS</span>
                    </a>
                </li>
                @endauth
                <li>
                    <a href="{{ route('cart') }}" class="{{ request()->routeIs('cart') ? 'active' : '' }}" style="position:relative">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <path d="M16 10a4 4 0 01-8 0"/>
                        </svg>
                        <span class="nav-label">
                            Carrito
                            <span class="cart-nav-badge" style="display:none">0</span>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="sidebar-footer-brand">
            <span class="sb-brand-text">RACE</span>
        </div>
    </div>

    {{-- ===================== MAIN ===================== --}}
    <main id="main">
        @yield('main')

        {{-- ===================== FOOTER ===================== --}}
        <footer class="site-footer">
            <div class="footer-inner">
                <div class="footer-grid">

                    <div class="footer-col footer-brand-col">
                        <div class="footer-logo">
                            <div class="footer-logo-icon">
                                <svg fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <title>helmet</title>
                                    <path d="M28.268 16.128c1.527-1.641 2.416-3.607 2.416-5.721-0-2.771-1.586-5.278-4.072-7.142 0.881 1.189 1.441 2.524 1.441 3.96 0 1.48-0.527 2.872-1.456 4.085l-0.599-1.726-2.873 0.899c-1.269-1.714-2.943-2.739-5.091-3.112-0.542-2.757-1.316-5.938-1.982-5.938s-1.44 3.181-1.982 5.938c-2.148 0.373-3.822 1.398-5.090 3.112l-2.872-0.899-0.598 1.726c-0.929-1.214-1.456-2.606-1.456-4.086 0-1.436 0.56-2.771 1.441-3.96-2.487 1.865-4.073 4.372-4.073 7.143 0 2.114 0.89 4.080 2.417 5.721l-0.625 1.803 2.877 1.328c-0.308 2.418-0.449 5.214-0.449 8.405 3.221 1.87 6.791 2.8 10.413 2.777 3.622 0.023 7.191-0.907 10.413-2.777 0-3.191-0.141-5.986-0.449-8.404l2.878-1.329-0.626-1.804zM17.44 21.359c-0.307 2.517-0.722 6.365-0.722 8.75h-1.331c0-2.388-0.416-6.241-0.723-8.758-4.542-0.291-6.496-1.882-6.496-1.882s0.144-1.054 0.285-1.881c0-0.001 0-0.003 0.001-0.004 0.011-0.064 0.022-0.126 0.033-0.187 0.001-0.005 0.002-0.009 0.002-0.014 0.004-0.025 0.009-0.049 0.013-0.073 0.001-0.006 0.002-0.011 0.003-0.017 0.010-0.055 0.020-0.109 0.030-0.159 0.001-0.006 0.002-0.013 0.004-0.019 0.004-0.019 0.007-0.038 0.011-0.056 0.001-0.006 0.003-0.013 0.004-0.019 0.005-0.023 0.010-0.046 0.014-0.068 2.401 0.809 4.929 1.216 7.486 1.201 2.556 0.014 5.084-0.393 7.485-1.201 0.005 0.021 0.009 0.044 0.014 0.066 0.002 0.008 0.003 0.016 0.005 0.024 0.003 0.016 0.006 0.032 0.010 0.048 0.002 0.009 0.003 0.018 0.005 0.027 0.004 0.021 0.008 0.042 0.012 0.064 0.002 0.009 0.003 0.018 0.005 0.026 0.004 0.019 0.007 0.039 0.011 0.059 0.002 0.012 0.004 0.023 0.006 0.035 0.003 0.015 0.006 0.031 0.008 0.046 0.002 0.012 0.004 0.025 0.007 0.037 0.003 0.019 0.007 0.038 0.010 0.058s0.007 0.037 0.010 0.056c0.003 0.016 0.006 0.032 0.008 0.049 0.003 0.015 0.005 0.030 0.008 0.045 0.002 0.014 0.005 0.028 0.007 0.042 0.003 0.016 0.005 0.032 0.008 0.049 0.002 0.014 0.005 0.029 0.007 0.043 0.004 0.027 0.009 0.053 0.013 0.080 0.002 0.015 0.005 0.030 0.007 0.044 0.003 0.017 0.005 0.033 0.008 0.050 0.002 0.014 0.005 0.028 0.007 0.042 0.003 0.016 0.005 0.032 0.008 0.047 0.004 0.023 0.007 0.045 0.011 0.068 0.003 0.017 0.006 0.035 0.008 0.052s0.006 0.037 0.009 0.055c0.002 0.014 0.004 0.028 0.006 0.042 0.003 0.017 0.005 0.035 0.008 0.052 0.002 0.013 0.004 0.027 0.006 0.040 0.004 0.028 0.009 0.056 0.013 0.084 0.001 0.009 0.003 0.017 0.004 0.026 0.003 0.023 0.007 0.046 0.010 0.068 0.001 0.008 0.003 0.017 0.004 0.025 0.004 0.026 0.008 0.051 0.011 0.076 0.001 0.004 0.001 0.008 0.002 0.012 0.072 0.481 0.123 0.859 0.123 0.859s-1.886 1.62-6.498 1.889z"></path>
                                </svg>
                            </div>
                            <span class="footer-logo-name">RACE<span>-</span>Helmets</span>
                        </div>
                        <p class="footer-slogan">
                            Protección premium para cada rodada.<br>
                            Las mejores marcas de cascos en un solo lugar.
                        </p>
                        <div class="footer-badge">Cascos de Competición</div>
                    </div>

                    <div class="footer-col">
                        <h4 class="footer-heading">Navegación</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}">Inicio</a></li>
                            <li><a href="{{ route('catalog') }}">Catálogo</a></li>
                            <li><a href="{{ route('us') }}">Nosotros</a></li>
                            <li><a href="{{ route('support') }}">Soporte</a></li>
                        </ul>
                    </div>

                    <div class="footer-col">
                        <h4 class="footer-heading">Encuéntranos</h4>
                        <div class="footer-socials">
                            <a href="#" class="social-btn" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                Instagram
                            </a>
                            <a href="#" class="social-btn" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </a>
                        </div>
                        <div class="footer-location">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>Colombia · Envíos a todo el país</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="footer-bottom">
                <span>© 2026 RACE-Helmets. Diseñado por <strong>Karent & Julieth</strong></span>
            </div>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>

    @stack('scripts')

</body>
</html>