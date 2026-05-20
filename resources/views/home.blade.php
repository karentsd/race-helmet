@extends('components.layout.template')

@section('title', 'Inicio')

@push('styles')
    @vite(['resources/css/home.css'])
@endpush

@section('main')

{{-- ======================== HERO ======================== --}}
<section class="hero" aria-label="Bienvenida">
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>
    <div class="hero-content">
        <span class="hero-badge">🏍️ AGV · MT · Shark · HJC · Shaft</span>
        <h1 class="hero-title">
            Protección Premium<br>para Cada Rodada
        </h1>
        <div class="hero-logo-lockup">
            <span class="hero-logo-word">RACE</span>
            <div class="hero-logo-cup">
                <svg fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <title>helmet</title>
                    <path d="M28.268 16.128c1.527-1.641 2.416-3.607 2.416-5.721-0-2.771-1.586-5.278-4.072-7.142 0.881 1.189 1.441 2.524 1.441 3.96 0 1.48-0.527 2.872-1.456 4.085l-0.599-1.726-2.873 0.899c-1.269-1.714-2.943-2.739-5.091-3.112-0.542-2.757-1.316-5.938-1.982-5.938s-1.44 3.181-1.982 5.938c-2.148 0.373-3.822 1.398-5.090 3.112l-2.872-0.899-0.598 1.726c-0.929-1.214-1.456-2.606-1.456-4.086 0-1.436 0.56-2.771 1.441-3.96-2.487 1.865-4.073 4.372-4.073 7.143 0 2.114 0.89 4.080 2.417 5.721l-0.625 1.803 2.877 1.328c-0.308 2.418-0.449 5.214-0.449 8.405 3.221 1.87 6.791 2.8 10.413 2.777 3.622 0.023 7.191-0.907 10.413-2.777 0-3.191-0.141-5.986-0.449-8.404l2.878-1.329-0.626-1.804zM17.44 21.359c-0.307 2.517-0.722 6.365-0.722 8.75h-1.331c0-2.388-0.416-6.241-0.723-8.758-4.542-0.291-6.496-1.882-6.496-1.882s0.144-1.054 0.285-1.881c0-0.001 0-0.003 0.001-0.004 0.011-0.064 0.022-0.126 0.033-0.187 0.001-0.005 0.002-0.009 0.002-0.014 0.004-0.025 0.009-0.049 0.013-0.073 0.001-0.006 0.002-0.011 0.003-0.017 0.010-0.055 0.020-0.109 0.030-0.159 0.001-0.006 0.002-0.013 0.004-0.019 0.004-0.019 0.007-0.038 0.011-0.056 0.001-0.006 0.003-0.013 0.004-0.019 0.005-0.023 0.010-0.046 0.014-0.068 2.401 0.809 4.929 1.216 7.486 1.201 2.556 0.014 5.084-0.393 7.485-1.201 0.005 0.021 0.009 0.044 0.014 0.066 0.002 0.008 0.003 0.016 0.005 0.024 0.003 0.016 0.006 0.032 0.010 0.048 0.002 0.009 0.003 0.018 0.005 0.027 0.004 0.021 0.008 0.042 0.012 0.064 0.002 0.009 0.003 0.018 0.005 0.026 0.004 0.019 0.007 0.039 0.011 0.059 0.002 0.012 0.004 0.023 0.006 0.035 0.003 0.015 0.006 0.031 0.008 0.046 0.002 0.012 0.004 0.025 0.007 0.037 0.003 0.019 0.007 0.038 0.010 0.058s0.007 0.037 0.010 0.056c0.003 0.016 0.006 0.032 0.008 0.049 0.003 0.015 0.005 0.030 0.008 0.045 0.002 0.014 0.005 0.028 0.007 0.042 0.003 0.016 0.005 0.032 0.008 0.049 0.002 0.014 0.005 0.029 0.007 0.043 0.004 0.027 0.009 0.053 0.013 0.080 0.002 0.015 0.005 0.030 0.007 0.044 0.003 0.017 0.005 0.033 0.008 0.050 0.002 0.014 0.005 0.028 0.007 0.042 0.003 0.016 0.005 0.032 0.008 0.047 0.004 0.023 0.007 0.045 0.011 0.068 0.003 0.017 0.006 0.035 0.008 0.052s0.006 0.037 0.009 0.055c0.002 0.014 0.004 0.028 0.006 0.042 0.003 0.017 0.005 0.035 0.008 0.052 0.002 0.013 0.004 0.027 0.006 0.040 0.004 0.028 0.009 0.056 0.013 0.084 0.001 0.009 0.003 0.017 0.004 0.026 0.003 0.023 0.007 0.046 0.010 0.068 0.001 0.008 0.003 0.017 0.004 0.025 0.004 0.026 0.008 0.051 0.011 0.076 0.001 0.004 0.001 0.008 0.002 0.012 0.072 0.481 0.123 0.859 0.123 0.859s-1.886 1.62-6.498 1.889z"></path>
                </svg>
            </div>
            <span class="hero-logo-word">Helmets</span>
        </div>
        <div class="hero-actions">
            <a href="{{ route('catalog') }}" class="btn-primary-ch">Ver Catálogo →</a>
            <a href="{{ route('us') }}" class="btn-outline-ch" style="color:#FFF;border-color:rgba(255,255,255,0.4);">Conócenos</a>
        </div>
    </div>
    <div class="hero-scroll-hint" aria-hidden="true"><span></span></div>
</section>

{{-- ======================== MARCAS ======================== --}}
<section class="brands-strip" data-reveal>
    <div class="brands-inner">
        <span class="brands-label">Marcas oficiales</span>
        <div class="brands-list">
            @php $marcas = ['AGV', 'MT Helmets', 'Shark', 'HJC', 'Shaft', 'Bell', 'Shoei']; @endphp
            @foreach($marcas as $m)
                <span class="brand-chip">{{ $m }}</span>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================== QUIÉNES SOMOS ======================== --}}
<section class="ch-section" data-reveal>
    <div class="ch-section-inner">
        <div class="section-header">
            <p class="section-eyebrow">Nuestra Historia</p>
            <h2 class="section-title">¿Quiénes Somos?</h2>
            <div class="section-line"></div>
            <p class="section-subtitle">
                Somos especialistas en cascos de motocicleta con distribución oficial de las mejores marcas del mundo. Tu seguridad es nuestra prioridad.
            </p>
        </div>
        <div class="about-grid">
            <div class="about-card" data-reveal>
                <div class="about-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0112 2a8 8 0 018 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h3>Seguridad Certificada</h3>
                <p>Todos nuestros cascos cuentan con certificaciones DOT, ECE 22.06 y homologaciones internacionales que garantizan tu protección.</p>
            </div>
            <div class="about-card" data-reveal>
                <div class="about-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <h3>Marcas Premium</h3>
                <p>Distribuidores oficiales de AGV, MT Helmets, Shark, HJC y Shaft. Garantía de fábrica y repuestos originales disponibles.</p>
            </div>
            <div class="about-card" data-reveal>
                <div class="about-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <h3>Asesoría Experta</h3>
                <p>Nuestro equipo de motociclistas expertos te guía en la elección del casco ideal según tu tipo de rodada y necesidades.</p>
            </div>
        </div>
    </div>
</section>

{{-- ======================== PRODUCTOS DESTACADOS ======================== --}}
<section class="ch-section ch-section--dark" data-reveal>
    <div class="ch-section-inner">
        <div class="section-header" style="color:#FFF">
            <p class="section-eyebrow">Lo Mejor de Nuestro Stock</p>
            <h2 class="section-title" style="color:#FFF">Cascos Destacados</h2>
            <div class="section-line"></div>
        </div>
        <div class="products-grid">
            @php
                $productos = [
                    ['emoji'=>'🪖','name'=>'AGV K6 S','desc'=>'Casco integral ultraligero con aerodinámica de MotoGP. Visera Pinlock incluida.','price'=>'$ 1.890.000','tag'=>'Premium'],
                    ['emoji'=>'🏍️','name'=>'MT Thunder 4 SV','desc'=>'Modular con doble homologación P/J. Visor solar integrado y ventilación deportiva.','price'=>'$ 780.000','tag'=>'Favorito'],
                    ['emoji'=>'⚡','name'=>'Shark Spartan RS','desc'=>'Integral de fibra de carbono con deflector de mentón intercambiable. Certificado FIM.','price'=>'$ 2.150.000','tag'=>'Carbono'],
                    ['emoji'=>'🔵','name'=>'HJC RPHA 11','desc'=>'Exterior en policarbonato P.I.M.+. Aerodinámica testada en túnel de viento.','price'=>'$ 1.220.000','tag'=>'Nuevo'],
                ];
            @endphp
            @foreach($productos as $p)
                <div class="product-card" data-reveal>
                    <div class="product-emoji" aria-hidden="true">{{ $p['emoji'] }}</div>
                    <span class="product-tag">{{ $p['tag'] }}</span>
                    <h3 class="product-name">{{ $p['name'] }}</h3>
                    <p class="product-desc">{{ $p['desc'] }}</p>
                    <div class="product-footer">
                        <span class="product-price">{{ $p['price'] }}</span>
                        <a href="{{ route('catalog') }}" class="product-link">Ver →</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:2.5rem">
            <a href="{{ route('catalog') }}" class="btn-primary-ch" style="background:var(--gold);color:var(--navy);">
                Ver Catálogo Completo →
            </a>
        </div>
    </div>
</section>

{{-- ======================== TESTIMONIOS ======================== --}}
<section class="ch-section" data-reveal>
    <div class="ch-section-inner">
        <div class="section-header">
            <p class="section-eyebrow">Lo que dicen nuestros clientes</p>
            <h2 class="section-title">Opiniones & Reseñas</h2>
            <div class="section-line"></div>
        </div>
        <div class="testimonials-grid">
            @php
                $testimonios = [
                    ['stars'=>5,'texto'=>'El AGV K6 llegó en perfectas condiciones con garantía oficial. El asesoramiento fue excelente, me ayudaron a elegir la talla correcta.','autor'=>'Carlos M.','rol'=>'Motociclista de ruta'],
                    ['stars'=>5,'texto'=>'Compré el MT Thunder y quedé encantado. La calidad supera al precio. Envío rápido y bien empacado. Ya pedí uno para mi esposa.','autor'=>'Andrés F.','rol'=>'Cliente frecuente'],
                    ['stars'=>4,'texto'=>'Gran variedad de marcas, excelente atención al cliente. El Shark Spartan RS es espectacular. Definitivamente mi tienda de confianza.','autor'=>'Laura R.','rol'=>'Piloto amateur'],
                    ['stars'=>5,'texto'=>'El HJC RPHA 11 es increíble. Race-Helmets es seria, responsable y vende productos 100% originales. Los recomiendo totalmente.','autor'=>'Santiago V.','rol'=>'Cliente'],
                ];
            @endphp
            @foreach($testimonios as $t)
                <div class="testi-card" data-reveal>
                    <div class="testi-stars">
                        @for($i=1;$i<=5;$i++)
                            <span style="color:{{ $i<=$t['stars']?'var(--gold)':'rgba(201,168,76,0.25)' }}">★</span>
                        @endfor
                    </div>
                    <p class="testi-text">"{{ $t['texto'] }}"</p>
                    <div class="testi-author">
                        <div class="testi-avatar">{{ mb_substr($t['autor'],0,1) }}</div>
                        <div>
                            <strong>{{ $t['autor'] }}</strong>
                            <span>{{ $t['rol'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
    @vite(['resources/js/home.js'])
@endpush
