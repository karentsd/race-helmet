<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pqrs extends Model
{
    use HasFactory;

    protected $table = 'pqrs';

    protected $fillable = [
        'nombres', 'apellidos', 'correo',
        'rol', 'tipo_pqrs', 'comentario',
        'estado', 'ip_remitente',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombres} {$this->apellidos}");
    }

    public function getTipoPqrsLabelAttribute(): string
    {
        return match ($this->tipo_pqrs) {
            'Queja'         => '😠 Queja',
            'Felicitacion'  => '🎉 Felicitación',
            'Recomendacion' => '💡 Recomendación',
            default         => $this->tipo_pqrs,
        };
    }

    public function scopeTipo($query, string $tipo)
    {
        return $query->where('tipo_pqrs', $tipo);
    }

    public function scopeEstado($query, string $estado)
    {
        return $query->where('estado', $estado);
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeRecientes($query)
    {
        return $query->orderByDesc('created_at');
    }
}