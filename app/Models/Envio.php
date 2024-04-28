<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Envio';

    protected $fillable = [
        'envDescripcion', 'envEstado', 'envFecha_Llegada', 'ID_EncargadoTruck', 'ID_DestinoR' , 'ID_DestinoD', 'ID_User'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'ID_User');
    }

    public function destino(){
        return $this->belongsTo(Destino::class, 'ID_Destino');
    }

    public function paquetes() {
        return $this->hasMany(Paquete::class, 'ID_Paquete');
    }

    public function salidaenvio(){
        return $this->hasOne(Salidaenvio::class, 'ID_SalidaEnvio');
    }

    public function clientes(){
        return $this->belongsToMany(Cliente::class)->withTimestamps()->withPivot('ecNombre');
    }
}
