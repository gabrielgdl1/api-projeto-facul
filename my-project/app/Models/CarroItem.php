<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarroItem extends Model
{
    use HasFactory;

    protected $table = 'carros_itens';

    protected $fillable = [
        'id_carro',
        'id_item'
    ];
}
