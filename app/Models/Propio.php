<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Propio
 *
 * @property $id
 * @property $nombre_propietario
 * @property $dpi_propietario
 * @property $nit_propietario
 * @property $telefono_propietario
 * @property $correo_propietario
 * @property $direccion_fiscal
 * @property $numero_vehiculos_asociados
 * @property $vehiculos_asociados
 * @property $nombre_empresa
 * @property $nit_empresa
 * @property $created_at
 * @property $updated_at
 * @property $vehi_id
 *
 * @property Vehi $vehi
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Propio extends Model
{
    use HasFactory;

    static $rules = [
        'nombre_propietario' => 'required',
        'dpi_propietario' => 'required',
        'nit_propietario' => 'required',
        'telefono_propietario' => 'required',
        'correo_propietario' => 'required',
        'direccion_fiscal' => 'required',
        'numero_vehiculos_asociados' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_propietario', 'dpi_propietario', 'nit_propietario', 'telefono_propietario', 'correo_propietario', 'direccion_fiscal', 'nombre_empresa', 'nit_empresa'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vehis()
    {
        return $this->belongsToMany(Vehi::class, 'propios_vehiculos', 'propios_id', 'vehi_id');
    }
}