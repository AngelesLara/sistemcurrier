<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Destino';

    protected $fillable = [
        'desNombre', 'desDescripcion', 'desDireccion', 'desEstado'
    ];

    public function envios() {
        return $this->hasMany(Envio::class);
    }
}
