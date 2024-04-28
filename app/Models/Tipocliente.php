<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipocliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_tpCliente';

    protected $fillable = [
        'tcNombre'
    ];

    public function cliente(){
        return $this->hasOne(Cliente::class);
    }
}
