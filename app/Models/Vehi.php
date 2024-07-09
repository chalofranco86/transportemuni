<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehi extends Model
{
    protected $table = 'vehi';

    static $rules = [
        'nombre_vehi' => 'required',
        'placa_vehi' => 'required',
        'tarjeta_circulacion' => 'required',
        'titulo_propiedad' => 'required',
        'tipo_vehi' => 'required',
        'numero_ruta_id' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['nombre_vehi',
         'placa_vehi', 
         'tarjeta_circulacion', 
         'titulo_propiedad', 
         'tipo_vehi', 
         'numero_ruta_id'];

    public function ruta()
    {
        return $this->hasOne('App\Models\Ruta', 'id', 'numero_ruta_id');
    }

    // Relación muchos a muchos con Propio
    public function propios()
    {
        return $this->belongsToMany(Propio::class, 'propios_vehiculos', 'vehi_id', 'propios_id');
    } 

}
