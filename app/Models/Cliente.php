<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='clientes';
    protected $fillable = [
        'nombre',
        'rfc',
        'direccion',
        'telefono',
        'email'
    ];

    public function scopeBuscador($query,$nombre){
        return $query -> where('nombre','LIKE','%'.$nombre.'%');
    }
    
}


