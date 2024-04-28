<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enviocliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_EnvCliente';

    protected $fillable = [
        'ecNombre', 'ID_Envio', 'ID_Cliente'
    ];

}
