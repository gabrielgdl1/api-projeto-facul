<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $table = 'carros';

    protected $fillable = [
        'id_marca',
        'modelo',
        'cor',
        'ano',
        'tipo_cambio',
        'tipo_combustivel',
        'tipo_carroceria',
        'quilometragem',
        'usado'
    ];
}
