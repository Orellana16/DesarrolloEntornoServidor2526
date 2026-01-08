<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo InmuebleComprador (Tabla Pivote)
 * 
 * Representa una transacción de compra.
 * Aunque Laravel puede manejar pivotes sin modelo, 
 * tenerlo permite añadir lógica de negocio.
 */
class InmuebleComprador extends Model
{
    use HasFactory;

    protected $table = 'inmueble_comprador';

    protected $fillable = [
        'comprador_id',
        'inmueble_id',
        'comision',
        'fecha_com',
    ];

    protected $casts = [
        'fecha_com' => 'datetime',
        'comision' => 'integer',
    ];

    // ════════════════════════════════════════════════════════════
    // RELACIONES
    // ════════════════════════════════════════════════════════════

    public function comprador(): BelongsTo
    {
        return $this->belongsTo(Comprador::class);
    }

    public function inmueble(): BelongsTo
    {
        return $this->belongsTo(Inmueble::class);
    }

    // ════════════════════════════════════════════════════════════
    // ACCESSORS
    // ════════════════════════════════════════════════════════════

    /**
     * Calcula el importe de la comisión
     */
    public function getImporteComisionAttribute(): float
    {
        return ($this->inmueble->precio * $this->comision) / 100;
    }
}
