@extends('components.layout.template')

@section('title', 'Mensajes PQRS')

@push('styles')
    @vite(['resources/css/messages.css'])
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <style>
    /* ── DataTables overrides ── */
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid #ddd;
        border-radius: 8px;
        padding: .35rem .7rem;
        font-size: .875rem;
        outline: none;
        transition: border-color .2s;
    }
    .dataTables_wrapper .dataTables_filter input:focus { border-color: #111; }
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_length label { font-size: .85rem; color: #555; }
    .dataTables_wrapper .dataTables_info { font-size: .82rem; color: #888; }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 7px !important;
        font-size: .82rem !important;
        padding: .3rem .65rem !important;
        margin: 0 2px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #111 !important;
        color: #fff !important;
        border-color: #111 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f5f5f5 !important;
        color: #111 !important;
        border-color: #ddd !important;
    }
    table.dataTable thead th { cursor: pointer; user-select: none; }
    table.dataTable thead th.sorting_asc::after  { content: " ↑"; color: #111; }
    table.dataTable thead th.sorting_desc::after { content: " ↓"; color: #111; }
    .dt-top-bar { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .8rem; margin-bottom: 1rem; }
    </style>
@endpush

@section('main')

<div class="messages-page">

    <div class="msg-header">
        <div class="msg-header-left">
            <p class="section-eyebrow">Panel de administración</p>
            <h1 class="msg-title">Mensajes PQRS</h1>
            <p class="msg-subtitle">Registros enviados desde el formulario de soporte</p>
        </div>
        <a href="{{ route('support') }}" class="btn-primary-ch">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nueva PQRS
        </a>
    </div>

    @if(session('success'))
        <div style="background:#d4edda;color:#155724;border:1px solid #c3e6cb;border-radius:8px;padding:12px 18px;margin-bottom:1.2rem;display:flex;align-items:center;gap:10px;font-size:.9rem;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Tarjetas de estadísticas --}}
    <div class="msg-stats">
        <div class="msg-stat-card msg-stat--total">
            <div class="msg-stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            </div>
            <div><span class="msg-stat-num">{{ $totales['total'] }}</span><span class="msg-stat-lbl">Total</span></div>
        </div>
        <div class="msg-stat-card msg-stat--pendiente">
            <div class="msg-stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
            </div>
            <div><span class="msg-stat-num">{{ $totales['pendientes'] }}</span><span class="msg-stat-lbl">Pendientes</span></div>
        </div>
        <div class="msg-stat-card msg-stat--queja">
            <div class="msg-stat-icon">😠</div>
            <div><span class="msg-stat-num">{{ $totales['quejas'] }}</span><span class="msg-stat-lbl">Quejas</span></div>
        </div>
        <div class="msg-stat-card msg-stat--feli">
            <div class="msg-stat-icon">🎉</div>
            <div><span class="msg-stat-num">{{ $totales['felicitaciones'] }}</span><span class="msg-stat-lbl">Felicitaciones</span></div>
        </div>
        <div class="msg-stat-card msg-stat--reco">
            <div class="msg-stat-icon">💡</div>
            <div><span class="msg-stat-num">{{ $totales['recomendaciones'] }}</span><span class="msg-stat-lbl">Recomendaciones</span></div>
        </div>
    </div>

    <div class="msg-table-wrap">

        @if($registros->isEmpty())
            <div class="msg-empty">
                <div class="msg-empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <h3>Sin registros</h3>
                <p>Aún no se han enviado mensajes PQRS.</p>
                <a href="{{ route('support') }}" class="btn-primary-ch" style="margin-top:1.2rem">Enviar primera PQRS</a>
            </div>
        @else

            <div class="msg-table-scroll">
                {{-- id="pqrs-table" es el hook para DataTables --}}
                <table id="pqrs-table" class="msg-table table table-hover w-100">
                    <thead>
                        <tr>
                            <th class="th-id">#</th>
                            <th class="th-nombre">Nombre</th>
                            <th class="th-correo">Correo</th>
                            <th class="th-rol">Rol</th>
                            <th class="th-tipo">Tipo PQRS</th>
                            <th class="th-estado">Estado</th>
                            <th class="th-comentario">Comentario</th>
                            <th class="th-fecha">Fecha</th>
                            <th class="th-acciones" style="text-align:center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $r)
                            <tr class="msg-row">
                                <td class="td-id">
                                    <span class="row-id">#{{ str_pad($r->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="td-nombre">
                                    <div class="nombre-cell">
                                        <div class="nombre-avatar">
                                            {{ mb_strtoupper(mb_substr($r->nombres,0,1)) }}{{ mb_strtoupper(mb_substr($r->apellidos,0,1)) }}
                                        </div>
                                        <span class="nombre-full">{{ $r->nombres }} {{ $r->apellidos }}</span>
                                    </div>
                                </td>
                                <td class="td-correo">
                                    <a href="mailto:{{ $r->correo }}" class="correo-link">{{ $r->correo }}</a>
                                </td>
                                <td class="td-rol">
                                    <span class="badge-rol badge-rol--{{ strtolower($r->rol) }}">{{ $r->rol }}</span>
                                </td>
                                <td class="td-tipo">
                                    <span class="badge-tipo badge-tipo--{{ strtolower($r->tipo_pqrs) }}">
                                        @if($r->tipo_pqrs === 'Queja') 😠 Queja
                                        @elseif($r->tipo_pqrs === 'Felicitacion') 🎉 Felicitación
                                        @else 💡 Recomendación
                                        @endif
                                    </span>
                                </td>
                                <td class="td-estado">
                                    <span class="badge-estado badge-estado--{{ $r->estado }}">
                                        <span class="estado-dot"></span>
                                        @if($r->estado === 'pendiente') Pendiente
                                        @elseif($r->estado === 'en_revision') En revisión
                                        @else Resuelto
                                        @endif
                                    </span>
                                </td>
                                <td class="td-comentario">
                                    {{ Str::limit($r->comentario, 70) }}
                                </td>
                                <td class="td-fecha" data-order="{{ $r->created_at->timestamp }}">
                                    <span class="fecha-dia">{{ $r->created_at->format('d/m/Y') }}</span>
                                    <span class="fecha-hora">{{ $r->created_at->format('H:i') }}</span>
                                </td>
                                <td style="text-align:center; white-space:nowrap;">
                                    {{-- Botón Editar --}}
                                    <a href="{{ route('pqrs.edit', $r) }}"
                                       style="display:inline-flex;align-items:center;gap:4px;padding:5px 10px;font-size:.8rem;font-weight:500;color:#fff;background:#111;border-radius:6px;text-decoration:none;margin-right:4px;">
                                        ✏️ Editar
                                    </a>
                                    {{-- Botón Eliminar --}}
                                    <form action="{{ route('pqrs.destroy', $r) }}" method="POST" style="display:inline;"
                                          onsubmit="return confirm('¿Eliminar PQRS #{{ str_pad($r->id,3,'0',STR_PAD_LEFT) }}? Esta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                style="display:inline-flex;align-items:center;gap:4px;padding:5px 10px;font-size:.8rem;font-weight:500;color:#fff;background:#c0392b;border:none;border-radius:6px;cursor:pointer;">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif
    </div>

</div>

@endsection

@push('scripts')
    @vite(['resources/js/messages.js'])

    {{-- jQuery (requerido por DataTables) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function () {
        $('#pqrs-table').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
            },
            order: [[7, 'desc']],          // Ordenar por fecha descendente por defecto
            pageLength: 15,
            lengthMenu: [5, 10, 15, 25, 50],
            columnDefs: [
                { orderable: false, targets: [6] },  // Columna comentario no ordenable
                { orderable: false, targets: [8] }   // Columna acciones no ordenable
            ]
        });
    });
    </script>
@endpush
