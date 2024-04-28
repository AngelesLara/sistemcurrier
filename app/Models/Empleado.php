<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Empleado';

    protected $fillable = [
        'empCodigo', 'empNombre', 'empTelefono', 'empEmail', 'empDireccion', 'empCargo', 'empSueldo', 'empEstado'
    ];

    public function trucks(){
        return $this->belongsToMany(Truck::class)->withTimestamps()->withPivot('etFecha', 'etEstado');
    }
}
