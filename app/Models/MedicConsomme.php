<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['libelle_m', 'quantite_m', 'id_bov'])]
class MedicConsomme extends Model
{
    protected $table = 'medic_consommes';
    protected $primaryKey = 'id_m';

    public function bovin()
    {
        return $this->belongsTo(Bovin::class, 'id_bov');
    }
}
