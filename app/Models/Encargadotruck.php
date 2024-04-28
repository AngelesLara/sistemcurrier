<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargadotruck extends Model
{
    use HasFactory;

    public function salidaenvio(){
        return $this->hasOne(Salidaenvio::class);
    }

    protected $primaryKey = 'ID_EncargadoTruck';
    
    protected $fillable = [
        'etNombre', 'ID_Camion', 'ID_Empleado'
    ];
}
