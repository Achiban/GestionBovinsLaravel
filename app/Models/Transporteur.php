<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['cin_t', 'nom', 'prenom', 'tel'])]
class Transporteur extends Model
{
    protected $primaryKey = 'id_trans';

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class, 'id_trans');
    }
}
