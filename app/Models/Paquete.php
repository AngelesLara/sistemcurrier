<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Paquete';

    protected $fillable = [
        'paqDescripcion', 'paqPrecio', 'paqPeso', 'paqTamaño', 'paqEstado', 'paqFecha_Llegada', 'ID_Envio'
    ];


    public function envio() {
        return $this->belongsTo(Envio::class);
    }
}
