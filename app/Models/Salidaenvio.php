<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salidaenvio extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_SalidaEnvio';
    
    protected $fillable = [
        'seHoraSalida', 'ID_Envio', 'ID_EncargadoTruck'
    ];

    public function envios(){
        return $this->belongsTo(Envio::class);
    }

    public function encargadotruck(){
        return $this->belongsTo(Encargadotruck::class);
    }
}
