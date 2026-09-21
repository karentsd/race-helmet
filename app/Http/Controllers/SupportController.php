<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePqrsRequest;
use App\Models\Pqrs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function index(): View
    {
        return view('support');
    }

    public function store(StorePqrsRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Pqrs::create([
            'nombres'      => $validated['nombres'],
            'apellidos'    => $validated['apellidos'],
            'correo'       => strtolower(trim($validated['correo'])),
            'rol'          => $validated['rol'],
            'tipo_pqrs'    => $validated['tipo_pqrs'],
            'comentario'   => $validated['comentario'],
            'estado'       => 'pendiente',
            'ip_remitente' => $request->ip(),
        ]);

        return redirect()
            ->route('support')
            ->with('success', '¡Tu PQRS fue enviada con éxito! Te respondemos en menos de 24 horas.');
    }

    public function messages(): View
    {
        // DataTables maneja paginación, búsqueda y orden en el cliente
        $registros = Pqrs::recientes()->get();

        $totales = [
            'total'           => Pqrs::count(),
            'pendientes'      => Pqrs::pendientes()->count(),
            'quejas'          => Pqrs::tipo('Queja')->count(),
            'felicitaciones'  => Pqrs::tipo('Felicitacion')->count(),
            'recomendaciones' => Pqrs::tipo('Recomendacion')->count(),
        ];

        return view('messages', compact('registros', 'totales'));
    }

    // ── Editar ────────────────────────────────────────────────
    public function edit(Pqrs $pqrs): View
    {
        return view('pqrs.edit', compact('pqrs'));
    }

    // ── Actualizar ────────────────────────────────────────────
    public function update(Request $request, Pqrs $pqrs): RedirectResponse
    {
        $request->validate([
            'nombres'    => ['required', 'string', 'min:2', 'max:100'],
            'apellidos'  => ['required', 'string', 'min:2', 'max:100'],
            'correo'     => ['required', 'email:rfc', 'max:180'],
            'rol'        => ['required', 'in:Cliente,Socio,Empleado'],
            'tipo_pqrs'  => ['required', 'in:Queja,Felicitacion,Recomendacion'],
            'comentario' => ['required', 'string', 'min:10', 'max:1000'],
            'estado'     => ['required', 'in:pendiente,en_revision,resuelto'],
        ], [
            'nombres.required'    => 'El nombre es obligatorio.',
            'nombres.min'         => 'El nombre debe tener al menos 2 caracteres.',
            'apellidos.required'  => 'Los apellidos son obligatorios.',
            'correo.required'     => 'El correo es obligatorio.',
            'correo.email'        => 'Ingresa un correo válido.',
            'rol.required'        => 'Selecciona un rol.',
            'tipo_pqrs.required'  => 'Selecciona el tipo de PQRS.',
            'comentario.required' => 'El comentario es obligatorio.',
            'comentario.min'      => 'El comentario debe tener al menos 10 caracteres.',
            'estado.required'     => 'Selecciona un estado.',
        ]);

        $pqrs->update([
            'nombres'    => $request->nombres,
            'apellidos'  => $request->apellidos,
            'correo'     => strtolower(trim($request->correo)),
            'rol'        => $request->rol,
            'tipo_pqrs'  => $request->tipo_pqrs,
            'comentario' => $request->comentario,
            'estado'     => $request->estado,
        ]);

        return redirect()
            ->route('messages')
            ->with('success', 'PQRS #' . str_pad($pqrs->id, 3, '0', STR_PAD_LEFT) . ' actualizada correctamente.');
    }

    // ── Eliminar ──────────────────────────────────────────────
    public function destroy(Pqrs $pqrs): RedirectResponse
    {
        $id = str_pad($pqrs->id, 3, '0', STR_PAD_LEFT);
        $pqrs->delete();

        return redirect()
            ->route('messages')
            ->with('success', 'PQRS #' . $id . ' eliminada correctamente.');
    }
}