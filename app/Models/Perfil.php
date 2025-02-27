<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{

    protected $table = 'perfiles';
    protected $fillable = ['nombre'];
    public $timestamps = false;
   
    public function scopeBuscador($query,$nombre){
        return $query -> where('nombre','LIKE','%'.$nombre.'%');
    }

}
