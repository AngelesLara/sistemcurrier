<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Cliente';

    protected $fillable = [
        'cliDNI', 'cliNombre', 'cliDireccion', 'cliTelefono', 'ID_tpCliente'
    ];

    public function tipocliente(){
        return $this->belongsTo(Tipocliente::class, 'ID_tpCliente');
    }


    public function envios(){
        return $this->belongsToMany(Envio::class)->withTimestamps()->withPivot('ecNombre');
    }
}
