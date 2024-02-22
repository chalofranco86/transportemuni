<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Documento
 *
 * @property $id
 * @property $antecedentes_policiacos
 * @property $antecedentes_penales
 * @property $renas
 * @property $licentia_tipo
 * @property $dpi
 * @property $boleto_ornato
 * @property $direccion_fiscal
 * @property $correo_documento
 * @property $telefono_documento
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Documento extends Model
{
    
    static $rules = [
		'antecedentes_policiacos' => 'required',
		'antecedentes_penales' => 'required',
		'renas' => 'required',
		'licentia_tipo' => 'required',
		'dpi' => 'required',
		'boleto_ornato' => 'required',
		'direccion_fiscal' => 'required',
		'correo_documento' => 'required',
		'telefono_documento' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['antecedentes_policiacos','antecedentes_penales','renas','licentia_tipo','dpi','boleto_ornato','direccion_fiscal','correo_documento','telefono_documento'];



}
