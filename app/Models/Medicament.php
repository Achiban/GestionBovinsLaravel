<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'libelle', 'description', 'quantite_med', 'prix_med', 'dateachat', 'dateexp_med'
])]
class Medicament extends Model
{
    protected $primaryKey = 'id_med';

    protected $casts = [
        'dateachat' => 'date',
        'dateexp_med' => 'date',
    ];
}
