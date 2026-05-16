<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'libelle_st', 'description_s', 'quantite_s', 'quantiteAct', 'prix_s', 'dateachat', 'dateexp_s'
])]
class Stock extends Model
{
    protected $primaryKey = 'id_stock';

    protected $casts = [
        'dateachat' => 'date',
        'dateexp_s' => 'date',
    ];
}
