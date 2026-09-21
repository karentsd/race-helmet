@extends('components.layout.template')

@section('title', 'Catálogo')

@push('styles')
    @vite(['resources/css/catalog.css'])
@endpush

@section('main')

@php
$products = [
    [
        'name'        => 'AGV K6 S',
        'tag'         => 'Premium',
        'desc'        => 'Integral ultraligero de fibra de carbono con aerodinámica desarrollada para MotoGP. Peso 1.190g. Visera Pinlock 70 incluida y preparado para intercomunicador.',
        'ingredientes'=> ['Carcasa fibra carbono/kevlar', 'Homologación ECE 22.06', 'Ventilación integral 12 conductos', 'Visera Pinlock 70 incluida'],
        'precio'      => '1.890.000',
        'imagen'      => 'agv-k6.png',
        'bgGradient'  => 'linear-gradient(135deg, #1A1A2E 0%, #16213E 55%, #0F3460 100%)',
        'circleColor' => 'rgba(201,168,76,0.20)',
        'textDark'    => false,
    ],
    [
        'name'        => 'MT Thunder 4 SV',
        'tag'         => 'Modular',
        'desc'        => 'Sistema modular con doble homologación P/J. Mentón abatible, visor solar integrado y amplia ventilación deportiva para largas jornadas.',
        'ingredientes'=> ['Carcasa termoplástica ABS', 'Doble homologación P/J', 'Visor solar integrado', 'Interior extraíble y lavable'],
        'precio'      => '780.000',
        'imagen'      => 'mt-thunder.png',
        'bgGradient'  => 'linear-gradient(135deg, #1C3158 0%, #2A4A7A 55%, #1A56DB 100%)',
        'circleColor' => 'rgba(26,86,219,0.25)',
        'textDark'    => false,
    ],
    [
        'name'        => 'Shark Spartan RS',
        'tag'         => 'Carbono',
        'desc'        => 'Integral de fibra de carbono para pista y calle. Deflector de mentón intercambiable, certificado FIM y aerodinámica de competición.',
        'ingredientes'=> ['Carcasa fibra de carbono', 'Certificación FIM Racing', 'Spoiler de cola regulable', 'Sistema de desenganche rápido'],
        'precio'      => '2.150.000',
        'imagen'      => 'shark-spartan.png',
        'bgGradient'  => 'linear-gradient(135deg, #1A0A0A 0%, #3D1010 55%, #6B1515 100%)',
        'circleColor' => 'rgba(201,168,76,0.18)',
        'textDark'    => false,
    ],
    [
        'name'        => 'HJC RPHA 11',
        'tag'         => 'Sport',
        'desc'        => 'Integral de alto rendimiento con exterior P.I.M.+ patentado. Testado en túnel de viento real. Interior premium Multi-Cool antibacterial.',
        'ingredientes'=> ['Exterior P.I.M.+ premium', 'Interior Multi-Cool', 'Sistema de cierre RPHA', 'Visera anti-UV preparada Pinlock'],
        'precio'      => '1.220.000',
        'imagen'      => 'hjc-rpha11.png',
        'bgGradient'  => 'linear-gradient(135deg, #0A2040 0%, #103060 55%, #1A56DB 100%)',
        'circleColor' => 'rgba(26,86,219,0.22)',
        'textDark'    => false,
    ],
    [
        'name'        => 'Shaft SC-25',
        'tag'         => 'Urbano',
        'desc'        => 'Casco modular urbano de diseño contemporáneo. Carcasa termoplástica, amplio campo visual y práctico sistema de cierre de doble anilla.',
        'ingredientes'=> ['Carcasa termoplástica', 'Homologación ECE 22.05', 'Doble visor solar', 'Amplio campo visual 180°'],
        'precio'      => '420.000',
        'imagen'      => 'shaft-sc25.png',
        'bgGradient'  => 'linear-gradient(135deg, #1A1A1A 0%, #333333 55%, #555555 100%)',
        'circleColor' => 'rgba(201,168,76,0.22)',
        'textDark'    => false,
    ],
    [
        'name'        => 'AGV Pista GP RR',
        'tag'         => 'Pista',
        'desc'        => 'El casco de los campeones. Valentino Rossi, Marc Márquez y Jorge Lorenzo lo eligieron. Carbono ultra-resistente y peso de apenas 1.050g.',
        'ingredientes'=> ['Carbono trilaminado', 'Homologación FIM & ECE', 'Esponja Shalimar ajustable', 'Peso 1.050g (talla M)'],
        'precio'      => '4.800.000',
        'imagen'      => 'agv-pista.png',
        'bgGradient'  => 'linear-gradient(135deg, #C9A84C 0%, #A07830 55%, #6B4E18 100%)',
        'circleColor' => 'rgba(201,168,76,0.30)',
        'textDark'    => false,
    ],
    [
        'name'        => 'MT Atom SV',
        'tag'         => 'Abatible',
        'desc'        => 'Crossover exclusivo con pantalla abatible. Diseño streetfighter agresivo con ventilación MOTO GP READY y preparado para Bluetooth.',
        'ingredientes'=> ['Carcasa ABS Polycarbonate', 'Pantalla abatible P/J', 'Sistema Bluetooth ready', 'Interior Coolmax antiolor'],
        'precio'      => '650.000',
        'imagen'      => 'mt-atom.png',
        'bgGradient'  => 'linear-gradient(135deg, #0A1628 0%, #1C3158 55%, #2A4A7A 100%)',
        'circleColor' => 'rgba(201,168,76,0.18)',
        'textDark'    => false,
    ],
];
@endphp

<script id="products-data" type="application/json">@json($products)</script>

<div class="catalog-page" id="catalog-page">
    <div class="catalog-bg" id="catalog-bg"></div>
    <div class="prod-circle" id="prod-circle"></div>

    <div class="catalog-layout">
        {{-- IZQUIERDA --}}
        <div class="cat-left">
            <span class="prod-tag" id="prod-tag">Premium</span>
            <h1 class="prod-title" id="prod-title">AGV K6 S</h1>
            <p class="prod-price-big">
                <span class="price-symbol">$</span>
                <span id="prod-price">1.890.000</span>
            </p>
            <p class="prod-desc" id="prod-desc">Integral ultraligero de fibra de carbono con aerodinámica desarrollada para MotoGP.</p>
            <ul class="prod-ing-list" id="prod-ing-list">
                <li>Carcasa fibra carbono/kevlar</li>
                <li>Homologación ECE 22.06</li>
                <li>Ventilación integral 12 conductos</li>
                <li>Visera Pinlock 70 incluida</li>
            </ul>
            <button class="prod-cta-btn" id="prod-cta" onclick="catalogAddToCart()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                Agregar al carrito
            </button>
            <div class="catalog-controls">
                <button class="ctrl-btn" id="btn-prev" aria-label="Anterior">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15,18 9,12 15,6"/></svg>
                </button>
                <div class="ctrl-dots" id="ctrl-dots">
                    @foreach($products as $i => $p)
                        <button class="dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}" aria-label="{{ $p['name'] }}"></button>
                    @endforeach
                </div>
                <button class="ctrl-btn" id="btn-next" aria-label="Siguiente">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9,18 15,12 9,6"/></svg>
                </button>
            </div>
            <p class="catalog-counter">
                <span id="cur-num">1</span> / <span>{{ count($products) }}</span>
            </p>
        </div>

        {{-- DERECHA --}}
        <div class="cat-right">
            <div class="prod-img-wrap">
                <img src="{{ asset('imgs/catalog/agv-k6.png') }}"
                     alt="AGV K6 S" class="prod-img" id="prod-img"
                     onerror="this.style.display='none';document.getElementById('prod-emoji').style.display='flex';">
                <div class="prod-emoji-fallback" id="prod-emoji">🪖</div>
            </div>
            <div class="prod-thumbs" id="prod-thumbs">
                @foreach($products as $i => $p)
                    <div class="prod-thumb {{ $i === 0 ? 'active' : '' }}"
                         data-index="{{ $i }}" onclick="goTo({{ $i }})" title="{{ $p['name'] }}">
                        <img src="{{ asset('imgs/catalog/'.$p['imagen']) }}"
                             alt="{{ $p['name'] }}"
                             onerror="this.parentElement.querySelector('.thumb-emoji').style.display='flex';this.style.display='none';">
                        <span class="thumb-emoji" style="display:none">🪖</span>
                        <span class="thumb-name">{{ Str::words($p['name'], 1, '') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    @vite(['resources/js/catalog.js', 'resources/js/cart.js'])
@endpush