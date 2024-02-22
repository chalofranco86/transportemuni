<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vehiculo
 *
 * @property $id
 * @property $nombre_vehiculo
 * @property $placa_vehiculo
 * @property $tarjeta_circulacion
 * @property $titulo_propiedad
 * @property $tipo_vehiculo
 * @property $numero_ruta_id
 * @property $nombre_piloto_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ruta $ruta
 * @property Tarjetapiloto $tarjetapiloto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vehiculo extends Model
{
    
    static $rules = [
		'nombre_vehiculo' => 'required',
		'placa_vehiculo' => 'required',
		'tarjeta_circulacion' => 'required',
		'titulo_propiedad' => 'required',
		'tipo_vehiculo' => 'required',
		'numero_ruta_id' => 'required',
		'nombre_piloto_id' => 'required',
    ];


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_vehiculo','placa_vehiculo','tarjeta_circulacion','titulo_propiedad','tipo_vehiculo','numero_ruta_id','nombre_piloto_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ruta()
    {
        return $this->belongsTo('App\Models\Ruta', 'numero_ruta_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tarjetapiloto()
    {
        return $this->belongsTo('App\Models\Tarjetapiloto', 'nombre_piloto_id', 'id');
    }
    
    
}
