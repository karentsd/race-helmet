@extends('components.layout.template')

@section('title', 'Nosotros')

@push('styles')
    @vite(['resources/css/us.css'])
@endpush

@section('main')

<section class="us-hero">
    <div class="us-hero-bg"></div>
    <div class="us-hero-content">
        <span class="section-eyebrow">Conócenos</span>
        <h1 class="us-hero-title">Nosotros</h1>
        <p class="us-hero-desc">La historia, los valores y las personas detrás de RACE-Helmets.</p>
    </div>
</section>

<section class="ch-section">
    <div class="ch-section-inner">
        <div class="mv-grid">
            <div class="mv-card" data-reveal>
                <div class="mv-card-accent" style="background:var(--gold)"></div>
                <span class="mv-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                    Misión
                </span>
                <h2 class="mv-card-title">Nuestra Misión</h2>
                <p class="mv-card-text">Ofrecer los mejores cascos de motocicleta con distribución oficial de marcas premium, garantizando la seguridad de cada motociclista colombiano a través de productos certificados y asesoría experta.</p>
            </div>
            <div class="mv-card" data-reveal>
                <div class="mv-card-accent" style="background:var(--blue-accent)"></div>
                <span class="mv-badge" style="color:var(--blue-accent);background:rgba(26,86,219,0.10)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Visión
                </span>
                <h2 class="mv-card-title">Nuestra Visión</h2>
                <p class="mv-card-text">Ser el principal distribuidor de cascos de competición y urbanos en Colombia para 2028, con puntos de atención en las principales ciudades del país y un marketplace digital líder en el sector moto.</p>
            </div>
            <div class="mv-card" data-reveal>
                <div class="mv-card-accent" style="background:var(--navy)"></div>
                <span class="mv-badge" style="color:var(--navy);background:rgba(10,22,40,0.08)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Valores
                </span>
                <h2 class="mv-card-title">Nuestros Valores</h2>
                <p class="mv-card-text">Seguridad ante todo, autenticidad garantizada, servicio postventa comprometido, innovación constante en el sector moto y respeto absoluto por cada motociclista que confía en nosotros.</p>
            </div>
        </div>
    </div>
</section>

<section class="stats-section" data-reveal>
    <div class="ch-section-inner">
        <div class="stats-grid">
            @php
                $stats = [
                    ['num'=>'5+',  'label'=>'Años en el mercado'],
                    ['num'=>'7',   'label'=>'Marcas oficiales'],
                    ['num'=>'2000+','label'=>'Clientes satisfechos'],
                    ['num'=>'100%','label'=>'Originales certificados'],
                ];
            @endphp
            @foreach($stats as $s)
                <div class="stat-item">
                    <span class="stat-num">{{ $s['num'] }}</span>
                    <span class="stat-label">{{ $s['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="ch-section" data-reveal>
    <div class="ch-section-inner">
        <div class="section-header">
            <p class="section-eyebrow">Encuéntranos</p>
            <h2 class="section-title">Contacto & Redes</h2>
            <div class="section-line"></div>
        </div>
        <div class="contact-grid">
            <div class="contact-card"><div class="contact-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div><h3>Ubicación</h3><p>Colombia · Envíos a todo el país</p></div>
            <div class="contact-card"><div class="contact-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg></div><h3>Correo</h3><p>info@race-helmets.co<br>ventas@race-helmets.co</p></div>
            <div class="contact-card"><div class="contact-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014 12 19.79 19.79 0 011.08 3.41 2 2 0 013.06 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg></div><h3>Horario</h3><p>Lun–Sáb: 8am – 7pm<br>Dom: 10am – 4pm</p></div>
            <div class="contact-card"><div class="contact-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></div><h3>Redes Sociales</h3><div class="social-pills"><a href="#" class="social-pill">Instagram</a><a href="#" class="social-pill">Facebook</a><a href="#" class="social-pill">YouTube</a></div></div>
        </div>
    </div>
</section>

<section class="creator-section" data-reveal>
    <div class="ch-section-inner">
        <div class="creator-card">
            <div style="display:flex;gap:1.5rem;flex-wrap:wrap;justify-content:center">

                <div class="creator-avatar-wrap">
                    <div class="creator-avatar">KD</div>
                    <div class="creator-badge">Co-Fundadora</div>
                </div>
                <div class="creator-info" style="flex:1;min-width:260px">
                    <p class="creator-eyebrow">Equipo fundador</p>
                    <h2 class="creator-name">Karent & Julieth</h2>
                    <p class="creator-bio">
                        Apasionadas por el mundo de las motocicletas y la tecnología, fundaron RACE-Helmets con la visión de llevar seguridad premium a cada motociclista colombiano. El proyecto fue construido con Laravel 13, PostgreSQL y mucha pasión por la velocidad.
                    </p>
                    <div class="creator-links">
                        <a href="mailto:info@race-helmets.co" class="creator-link">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
                            info@race-helmets.co
                        </a>
                        <a href="#" class="creator-link">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/></svg>
                            GitHub
                        </a>
                    </div>
                </div>

                <div class="creator-avatar-wrap">
                    <div class="creator-avatar" style="background:var(--blue-accent);color:#FFF">JL</div>
                    <div class="creator-badge">Co-Fundadora</div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    @vite(['resources/js/us.js'])
@endpush