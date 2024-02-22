<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarjetapiloto
 *
 * @property $id
 * @property $nombre_piloto
 * @property $dpi_piloto
 * @property $tipo_licencia_piloto
 * @property $fotografia_piloto
 * @property $fecha_emision_piloto
 * @property $fecha_vencimiento_piloto
 * @property $direccion_piloto
 * @property $telefono_piloto
 * @property $correo_piloto
 * @property $antecedentes_penales_piloto
 * @property $antecedentes_policiacos_piloto
 * @property $foto_licencia_piloto
 * @property $renas_piloto
 * @property $boleto_ornato_piloto
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tarjetapiloto extends Model
{
    
    static $rules = [
		'nombre_piloto' => 'required',
		'dpi_piloto' => 'required',
		'tipo_licencia_piloto' => 'required',
		'fotografia_piloto' => 'required',
		'fecha_emision_piloto' => 'required',
		'fecha_vencimiento_piloto' => 'required',
		'direccion_piloto' => 'required',
		'telefono_piloto' => 'nullable',
		'correo_piloto' => 'nullable',
		'antecedentes_penales_piloto' => 'nullable',
		'antecedentes_policiacos_piloto' => 'nullable',
		'foto_licencia_piloto' => 'nullable',
		'renas_piloto' => 'nullable',
		'boleto_ornato_piloto'  => 'nullable',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_piloto',
        'dpi_piloto',
        'tipo_licencia_piloto',
        'fotografia_piloto',
        'fecha_emision_piloto',
        'fecha_vencimiento_piloto',
        'direccion_piloto',
        'telefono_piloto',
        'correo_piloto',
        'antecedentes_penales_piloto',
        'antecedentes_policiacos_piloto',
        'foto_licencia_piloto',
        'renas_piloto',
        'boleto_ornato_piloto'
  ];


}
