<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modelo Inmueble
 * 
 * Representa una propiedad inmobiliaria.
 * - Pertenece a UN vendedor (quien lo gestiona)
 * - Puede ser comprado por MUCHOS compradores (historial)
 * 
 * @property int $id
 * @property string $nombre
 * @property float $precio
 * @property string $direccion
 * @property int $metros
 * @property int $vendedor_id
 */
class Inmueble extends Model
{
    use HasFactory;

    // ════════════════════════════════════════════════════════════
    // CONFIGURACIÓN DE LA TABLA
    // ════════════════════════════════════════════════════════════

    protected $table = 'inmueble';

    protected $fillable = [
        'nombre',
        'precio',
        'direccion',
        'metros',
        'vendedor_id',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'metros' => 'integer',
    ];

    // ════════════════════════════════════════════════════════════
    // RELACIONES
    // ════════════════════════════════════════════════════════════

    /**
     * Relación: Un inmueble PERTENECE A un vendedor
     * 
     * Relación inversa de uno-a-muchos (N:1)
     */
    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(
            Vendedor::class,    // Modelo padre
            'vendedor_id',      // FK en esta tabla
            'id'                // PK en tabla vendedor
        );
    }

    /**
     * Relación: Un inmueble puede ser comprado por MUCHOS compradores
     * 
     * Relación muchos-a-muchos con datos de la transacción
     */
    public function compradores(): BelongsToMany
    {
        return $this->belongsToMany(
            Comprador::class,
            'inmueble_comprador',
            'inmueble_id',
            'comprador_id'
        )->withPivot(['comision', 'fecha_com'])
            ->withTimestamps();
    }

    // ════════════════════════════════════════════════════════════
    // ACCESSORS
    // ════════════════════════════════════════════════════════════

    /**
     * Precio formateado
     */
    public function getPrecioFormateadoAttribute(): string
    {
        return number_format($this->precio, 2, ',', '.') . ' €';
    }

    /**
     * Precio por metro cuadrado
     */
    public function getPrecioMetroAttribute(): float
    {
        return $this->metros > 0 ? round($this->precio / $this->metros, 2) : 0;
    }
}
