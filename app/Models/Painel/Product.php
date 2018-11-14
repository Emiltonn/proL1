<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'number', 'active', 'category', 'description'
    ];//metodo para permitir o preenchimento//whitelist
    //protected $guarded = ['admin'];//metodo para bloquear o preenchimento//blacklist

    

}


