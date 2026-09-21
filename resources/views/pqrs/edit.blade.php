@extends('components.layout.template')

@section('title', 'Editar PQRS #' . str_pad($pqrs->id, 3, '0', STR_PAD_LEFT))

@push('styles')
    @vite(['resources/css/support.css'])
@endpush

@section('main')

<section class="support-hero">
    <div class="support-hero-bg"></div>
    <div class="support-hero-content">
        <span class="section-eyebrow">Panel de administración</span>
        <h1 class="support-hero-title">Editar PQRS <span style="opacity:.6">#{{ str_pad($pqrs->id, 3, '0', STR_PAD_LEFT) }}</span></h1>
        <p class="support-hero-desc">Modifica los datos del registro y guarda los cambios.</p>
    </div>
</section>

<section class="support-form-section">
    <div class="support-form-wrap">

        @if($errors->any())
            <div class="alert-banner alert-error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Por favor corrige los errores antes de continuar.
            </div>
        @endif

        <form action="{{ route('pqrs.update', $pqrs) }}" method="POST" id="pqrs-form" novalidate>
            @csrf
            @method('PUT')

            <fieldset class="form-fieldset">
                <legend class="form-legend"><span class="legend-num">01</span> Información Personal</legend>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nombres">Nombres <span class="req">*</span></label>
                        <input type="text" id="nombres" name="nombres"
                               class="form-input @error('nombres') is-invalid @enderror"
                               placeholder="Nombre" value="{{ old('nombres', $pqrs->nombres) }}" required>
                        @error('nombres')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="apellidos">Apellidos <span class="req">*</span></label>
                        <input type="text" id="apellidos" name="apellidos"
                               class="form-input @error('apellidos') is-invalid @enderror"
                               placeholder="Apellidos" value="{{ old('apellidos', $pqrs->apellidos) }}" required>
                        @error('apellidos')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="correo">Correo Electrónico <span class="req">*</span></label>
                    <input type="email" id="correo" name="correo"
                           class="form-input @error('correo') is-invalid @enderror"
                           placeholder="correo@ejemplo.com" value="{{ old('correo', $pqrs->correo) }}" required>
                    @error('correo')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <legend class="form-legend"><span class="legend-num">02</span> Rol</legend>
                <div class="pill-group" id="rol-group">
                    @foreach(['Cliente','Socio','Empleado'] as $rol)
                        @php $selected = old('rol', $pqrs->rol) === $rol; @endphp
                        <label class="pill-label {{ $selected ? 'selected' : '' }}">
                            <input type="radio" name="rol" value="{{ $rol }}" {{ $selected ? 'checked' : '' }} class="pill-input">
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
                        @php $selected = old('tipo_pqrs', $pqrs->tipo_pqrs) === $t['val']; @endphp
                        <label class="pill-label {{ $selected ? 'selected' : '' }}">
                            <input type="radio" name="tipo_pqrs" value="{{ $t['val'] }}" {{ $selected ? 'checked' : '' }} class="pill-input">
                            <span class="pill-icon">{{ $t['icon'] }}</span> {{ $t['val'] }}
                        </label>
                    @endforeach
                </div>
                @error('tipo_pqrs')<span class="form-error">{{ $message }}</span>@enderror
            </fieldset>

            <fieldset class="form-fieldset">
                <legend class="form-legend"><span class="legend-num">04</span> Estado del caso</legend>
                <div class="form-group">
                    <label class="form-label" for="estado">Estado <span class="req">*</span></label>
                    <select id="estado" name="estado" class="form-input @error('estado') is-invalid @enderror">
                        @foreach(['pendiente' => 'Pendiente', 'en_revision' => 'En revisión', 'resuelto' => 'Resuelto'] as $val => $label)
                            <option value="{{ $val }}" {{ old('estado', $pqrs->estado) === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </fieldset>

            <fieldset class="form-fieldset">
                <legend class="form-legend"><span class="legend-num">05</span> Comentario</legend>
                <div class="form-group">
                    <label class="form-label" for="comentario">Comentario <span class="req">*</span></label>
                    <textarea id="comentario" name="comentario"
                              class="form-textarea @error('comentario') is-invalid @enderror"
                              rows="5" required>{{ old('comentario', $pqrs->comentario) }}</textarea>
                    <span class="char-counter" id="char-counter">{{ strlen($pqrs->comentario) }} / 1000 caracteres</span>
                    @error('comentario')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </fieldset>

            <div class="form-submit-wrap" style="display:flex; gap:1rem; align-items:center; flex-wrap:wrap;">
                <button type="submit" class="submit-btn" id="submit-btn">
                    <span class="submit-text">Guardar cambios</span>
                    <svg class="submit-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12,5 19,12 12,19"/></svg>
                </button>
                <a href="{{ route('messages') }}" style="font-size:.9rem; color:#666; text-decoration:underline;">
                    Cancelar y volver
                </a>
            </div>
        </form>

    </div>
</section>

@endsection

@push('scripts')
    @vite(['resources/js/support.js'])
@endpush
