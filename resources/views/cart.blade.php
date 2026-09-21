@extends('components.layout.template')

@section('title', 'Mi Carrito')

@push('styles')
    @vite(['resources/css/cart.css'])
@endpush

@section('main')

<div class="cart-page">

    {{-- ── Header ── --}}
    <div class="cart-header">
        <div>
            <p class="section-eyebrow">Mi pedido</p>
            <h1 class="cart-title">
                Carrito
                @if($cantidad_total > 0)
                    <span class="cart-count-badge">{{ $cantidad_total }}</span>
                @endif
            </h1>
        </div>
        <a href="{{ route('catalog') }}" class="btn-outline-ch">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15,18 9,12 15,6"/></svg>
            Seguir comprando
        </a>
    </div>

    @if(session('success'))
        <div class="cart-alert cart-alert--success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($items->isEmpty())

        {{-- ── Carrito vacío ── --}}
        <div class="cart-empty">
            <div class="cart-empty-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            </div>
            <h2>Tu carrito está vacío</h2>
            <p>Explora nuestro catálogo y agrega tus cafés favoritos.</p>
            <a href="{{ route('catalog') }}" class="btn-primary-ch" style="margin-top:1.5rem">
                Ver Catálogo →
            </a>
        </div>

    @else

        <div class="cart-layout">

            {{-- ── Columna izquierda: items ── --}}
            <div class="cart-items-col">

                <div class="cart-items-header">
                    <span>{{ $items->count() }} producto{{ $items->count() !== 1 ? 's' : '' }}</span>
                    <form action="{{ route('cart.clear') }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-vaciar"
                                onclick="return confirm('¿Vaciar el carrito?')">
                            Vaciar carrito
                        </button>
                    </form>
                </div>

                <div class="cart-items-list" id="cart-items-list">
                    @foreach($items as $item)
                        <div class="cart-item" id="item-{{ $item->id }}" data-id="{{ $item->id }}">

                            {{-- Imagen del producto --}}
                            <div class="cart-item-img" style="background: {{ $item->producto_bg ?? 'linear-gradient(135deg,#FDF1E0,#D4A373)' }}">
                                <img src="{{ asset('imgs/catalog/'.$item->producto_imagen) }}"
                                     alt="{{ $item->producto_nombre }}"
                                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                <span class="cart-item-emoji" style="display:none">{{ $item->producto_emoji }}</span>
                            </div>

                            {{-- Info del producto --}}
                            <div class="cart-item-info">
                                <h3 class="cart-item-name">{{ $item->producto_nombre }}</h3>
                                <span class="cart-item-unit">COP $ {{ number_format($item->precio, 0, ',', '.') }} / unidad</span>
                            </div>

                            {{-- Controles de cantidad --}}
                            <div class="cart-item-qty" id="qty-{{ $item->id }}">
                                <button class="qty-btn qty-btn--minus"
                                        onclick="updateQty({{ $item->id }}, -1)"
                                        {{ $item->cantidad <= 1 ? 'disabled' : '' }}>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                </button>
                                <span class="qty-num" id="qty-num-{{ $item->id }}">{{ $item->cantidad }}</span>
                                <button class="qty-btn qty-btn--plus"
                                        onclick="updateQty({{ $item->id }}, 1)">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                </button>
                            </div>

                            {{-- Subtotal --}}
                            <div class="cart-item-subtotal" id="sub-{{ $item->id }}">
                                COP $ {{ number_format($item->precio * $item->cantidad, 0, ',', '.') }}
                            </div>

                            {{-- Eliminar --}}
                            <button class="cart-item-remove"
                                    onclick="removeItem({{ $item->id }})"
                                    aria-label="Eliminar {{ $item->producto_nombre }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19,6l-1,14H6L5,6"/><path d="M10,11v6"/><path d="M14,11v6"/><path d="M9,6V4h6v2"/></svg>
                            </button>

                        </div>
                    @endforeach
                </div>

            </div>

            {{-- ── Columna derecha: resumen ── --}}
            <div class="cart-summary-col">
                <div class="cart-summary">
                    <h2 class="summary-title">Resumen del pedido</h2>

                    <div class="summary-lines">
                        <div class="summary-line">
                            <span>Subtotal ({{ $cantidad_total }} ítem{{ $cantidad_total !== 1 ? 's' : '' }})</span>
                            <span id="summary-subtotal">COP $ {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-line">
                            <span>Envío</span>
                            <span class="summary-free">Gratis</span>
                        </div>
                        <div class="summary-line summary-line--total">
                            <span>Total</span>
                            <span id="summary-total">COP $ {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button class="btn-checkout" onclick="alert('¡Función de pago próximamente!')">
                        Proceder al pago →
                    </button>

                    <a href="{{ route('catalog') }}" class="btn-continue">
                        ← Continuar comprando
                    </a>

                    <div class="summary-badges">
                        <span class="summary-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0112 2a8 8 0 018 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>
                            Retiro en tienda
                        </span>
                        <span class="summary-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
                            Confirmación por email
                        </span>
                    </div>
                </div>

                {{-- Mini preview de productos --}}
                <div class="cart-mini-preview">
                    <h4 class="mini-preview-title">En tu pedido</h4>
                    <div class="mini-preview-items">
                        @foreach($items as $item)
                            <div class="mini-item">
                                <div class="mini-item-img" style="background:{{ $item->producto_bg ?? 'linear-gradient(135deg,#FDF1E0,#D4A373)' }}">
                                    <img src="{{ asset('imgs/catalog/'.$item->producto_imagen) }}"
                                         alt="{{ $item->producto_nombre }}"
                                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                    <span class="mini-emoji" style="display:none">{{ $item->producto_emoji }}</span>
                                </div>
                                <span class="mini-item-name">{{ Str::words($item->producto_nombre, 2) }}</span>
                                <span class="mini-item-qty">×{{ $item->cantidad }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

    @endif

</div>

@endsection

@push('scripts')
    @vite(['resources/js/cart.js'])
@endpush