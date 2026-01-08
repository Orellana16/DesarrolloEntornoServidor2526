<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class Comprador extends Model
{
    use HasFactory;

    protected $table = 'comprador';

    protected $fillable = [
        'nombre',
        'nif',
        'fecha_nac',
        'sexo',
    ];

    // El casting convierte automáticamente a Carbon
    protected $casts = [
        'fecha_nac' => 'date',
    ];

    public function inmuebles(): BelongsToMany
    {
        return $this->belongsToMany(
            Inmueble::class,
            'inmueble_comprador',
            'comprador_id',
            'inmueble_id'
        )->withPivot(['comision', 'fecha_com'])
            ->withTimestamps();
    }

    /**
     * Accessor para obtener la edad
     * Como tenemos el cast, fecha_nac YA es Carbon
     */
    public function getEdadAttribute(): ?int
    {
        if (!$this->fecha_nac) {
            return null;
        }

        // Con el cast 'date', esto funciona directamente:
        return $this->fecha_nac->age;

        // Si no tuvieras cast, necesitarías:
        // return Carbon::parse($this->fecha_nac)->age;
    }
}
