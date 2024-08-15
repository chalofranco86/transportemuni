<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ruta
 *
 * @property $id
 * @property $nombre_ruta
 * @property $numero_ruta
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ruta extends Model
{
    static $rules = [
        'nombre_ruta' => 'required',
        'numero_ruta' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['nombre_ruta', 'numero_ruta'];

    /**
     * Get the vehicles associated with the route.
     */
    public function vehis()
    {
        return $this->hasMany(Vehi::class, 'numero_ruta_id', 'id');
    }
}