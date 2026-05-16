<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['libelle_n', 'quantite_n', 'prix', 'id_bov'])]
class Nourriture extends Model
{
    protected $primaryKey = 'id_n';

    public function bovin()
    {
        return $this->belongsTo(Bovin::class, 'id_bov');
    }
}
