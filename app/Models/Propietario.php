<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Propietario
 *
 * @property $id
 * @property $nombre
 * @property $dpi
 * @property $nit
 * @property $nombre_transporte
 * @property $telefono
 * @property $correo
 * @property $direccion_fiscal
 * @property $no_vehiculo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Propietario extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'dpi' => 'required',
		'nit' => 'required',
		'nombre_transporte' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'direccion_fiscal' => 'required',
		'no_vehiculo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','dpi','nit','nombre_transporte','telefono','correo','direccion_fiscal','no_vehiculo'];



}
