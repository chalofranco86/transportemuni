<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Card
 *
 * @property $id
 * @property $nombre_piloto
 * @property $direccion_piloto
 * @property $correo_piloto
 * @property $telefono_piloto
 * @property $tipo_licencia
 * @property $licencia
 * @property $foto_piloto
 * @property $dpi_piloto
 * @property $fecha_emision
 * @property $fecha_vencimiento
 * @property $antecedentes_penales
 * @property $antecedentes_policiacos
 * @property $renas
 * @property $boleto_ornato
 * @property $propietario_id
 * @property $numero_vehiculo_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Vehi $vehi
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Card extends Model
{
    protected $table = 'card';  

    static $rules = [
		'nombre_piloto' => 'required',
		'direccion_piloto' => 'required',
		'correo_piloto' => 'required',
		'telefono_piloto' => 'required',
		'tipo_licencia' => 'required',
		'licencia' => 'required',
		'foto_piloto' => 'required',
		'dpi_piloto' => 'required',
		'fecha_emision' => 'required',
		'fecha_vencimiento' => 'required',
		'antecedentes_penales' => 'required',
		'antecedentes_policiacos' => 'required',
		'renas' => 'required',
		'boleto_ornato' => 'required',
    'propietario_id' => 'required',
		'numero_vehiculo_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_piloto','direccion_piloto','correo_piloto','telefono_piloto','tipo_licencia','licencia','foto_piloto','dpi_piloto','fecha_emision','fecha_vencimiento','antecedentes_penales','antecedentes_policiacos','renas','boleto_ornato', 'propietario_id' ,'numero_vehiculo_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vehi()
    {
        return $this->hasOne('App\Models\Vehi', 'id', 'numero_vehiculo_id');
    }
    
    public function propio()
    {
        return $this->hasOne('App\Models\Propio', 'id', 'propietario_id');
    }
}
