<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoVehi extends Model
{
    protected $table = 'tipo_vehi';

    protected $fillable = [
        'tipo_vehiculo'
    ];

    public function vehiculos()
    {
        return $this->hasMany('App\Models\Vehi', 'tipo_vehi');
    }
}