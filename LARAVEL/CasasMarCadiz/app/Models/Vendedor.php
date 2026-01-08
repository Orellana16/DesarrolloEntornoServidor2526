<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Vendedor
 * 
 * Representa a un empleado que vende inmuebles.
 * Tiene una relación uno-a-muchos con Inmueble.
 * 
 * @property int $id
 * @property string $nombre
 * @property string $nif
 * @property string $fecha_nac
 * @property string $sexo
 * @property float $sueldo_base
 */
class Vendedor extends Model
{
    use HasFactory;

    // ════════════════════════════════════════════════════════════
    // CONFIGURACIÓN DE LA TABLA
    // ════════════════════════════════════════════════════════════

    protected $table = 'vendedor';

    protected $fillable = [
        'nombre',
        'nif',
        'fecha_nac',
        'sexo',
        'sueldo_base',
    ];

    protected $casts = [
        'fecha_nac' => 'date',
        'sueldo_base' => 'decimal:2',  // Decimal con 2 decimales
    ];

    // ════════════════════════════════════════════════════════════
    // RELACIONES
    // ════════════════════════════════════════════════════════════

    /**
     * Relación: Un vendedor tiene MUCHOS inmuebles asignados
     * 
     * Relación uno-a-muchos (1:N)
     */
    public function inmuebles(): HasMany
    {
        return $this->hasMany(
            Inmueble::class,    // Modelo relacionado
            'vendedor_id',      // FK en la tabla inmueble
            'id'                // PK local (opcional, por defecto 'id')
        );
    }

    // ════════════════════════════════════════════════════════════
    // ACCESSORS
    // ════════════════════════════════════════════════════════════

    /**
     * Sueldo formateado con símbolo de moneda
     */
    public function getSueldoFormateadoAttribute(): string
    {
        return number_format($this->sueldo_base, 2, ',', '.') . ' €';
    }
}
