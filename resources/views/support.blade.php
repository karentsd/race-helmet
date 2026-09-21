@extends('components.layout.template')

@section('title', 'Soporte')

@push('styles')
    @vite(['resources/css/support.css'])
@endpush

@section('main')

<section class="support-hero">
    <div class="support-hero-bg"></div>
    <div class="support-hero-content">
        <span class="section-eyebrow">PQRS</span>
        <h1 class="support-hero-title">Centro de Soporte</h1>
        <p class="support-hero-desc">
            ¿Tienes una consulta, queja o felicitación?<br>
            Te respondemos en menos de 24 horas.
        </p>
    </div>
</section>

<section class="support-form-section">
    <div class="support-form-wrap">

        @if(session('success'))
            <div class="alert-banner alert-success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert-banner alert-error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Por favor corrige los errores antes de continuar.
            </div>
        @endif

        <form action="{{ route('support.store') }}" method="POST" id="pqrs-form" novalidate>
            @csrf

            <fieldset class="form-fieldset">
                <legend class="form-legend"><span class="legend-num">01</span> Información Personal</legend>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nombres">Nombres <span class="req">*</span></label>
                        <input type="text" id="nombres" name="nombres" class="form-input @error('nombres') is-invalid @enderror" placeholder="Tu nombre" value="{{ old('nombres') }}" required>
                        @error('nombres')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="apellidos">Apellidos <span class="req">*</span></label>
                        <input type="text" id="apellidos" name="apellidos" class="form-input @error('apellidos') is-invalid @enderror" placeholder="Tus apellidos" value="{{ old('apellidos') }}" required>
                        @error('apellidos')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="correo">Correo Electrónico <span class="req">*</span></label>
                    <input type="email" id="correo" name="correo" class="form-input @error('correo') is-invalid @enderror" placeholder="correo@ejemplo.com" value="{{ old('correo') }}" required>
                    @error('correo')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <legend class="form-legend"><span class="legend-num">02</span> Tu Rol</legend>
                <div class="pill-group" id="rol-group">
                    @foreach(['Cliente','Socio','Empleado'] as $rol)
                        <label class="pill-label {{ old('rol','Cliente')===$rol?'selected':'' }}">
                            <input type="radio" name="rol" value="{{ $rol }}" {{ old('rol','Cliente')===$rol?'checked':'' }} class="pill-input">
                            {{ $rol }}
                        </label>
                    @endforeach
                </div>
                @error('rol')<span class="form-error">{{ $message }}</span>@enderror
            </fieldset>

            <fieldset class="form-fieldset">
                <legend class="form-legend"><span class="legend-num">03</span> Tipo de PQRS</legend>
                <div class="pill-group" id="pqrs-group">
                    @php $tipos = [['val'=>'Queja','icon'=>'😠'],['val'=>'Felicitacion','icon'=>'🎉'],['val'=>'Recomendacion','icon'=>'💡']]; @endphp
                    @foreach($tipos as $t)
                        <label class="pill-label {{ old('tipo_pqrs','Queja')===$t['val']?'selected':'' }}">
                            <input type="radio" name="tipo_pqrs" value="{{ $t['val'] }}" {{ old('tipo_pqrs','Queja')===$t['val']?'checked':'' }} class="pill-input">
                            <span class="pill-icon">{{ $t['icon'] }}</span> {{ $t['val'] }}
                        </label>
                    @endforeach
                </div>
                @error('tipo_pqrs')<span class="form-error">{{ $message }}</span>@enderror
            </fieldset>

            <fieldset class="form-fieldset">
                <legend class="form-legend"><span class="legend-num">04</span> Tu Mensaje</legend>
                <div class="form-group">
                    <label class="form-label" for="comentario">Comentario General <span class="req">*</span></label>
                    <textarea id="comentario" name="comentario" class="form-textarea @error('comentario') is-invalid @enderror" placeholder="Cuéntanos tu experiencia con RACE-Helmets. ¿Tienes alguna sugerencia o consulta sobre nuestros cascos?" rows="5" required>{{ old('comentario') }}</textarea>
                    <span class="char-counter" id="char-counter">0 / 1000 caracteres</span>
                    @error('comentario')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </fieldset>

            <div class="form-submit-wrap">
                <button type="submit" class="submit-btn" id="submit-btn">
                    <span class="submit-text">Enviar PQRS</span>
                    <svg class="submit-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12,5 19,12 12,19"/></svg>
                </button>
                <p class="form-privacy">Tu información se maneja con total confidencialidad.</p>
            </div>
        </form>
    </div>
</section>

@endsection

@push('scripts')
    @vite(['resources/js/support.js'])
@endpush