<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nom_vend', 'prenom_vend', 'tel_vend', 'farm_vend'])]
class Vendeur extends Model
{
    protected $primaryKey = 'id_vend';

    public function bovins()
    {
        return $this->hasMany(Bovin::class, 'id_vend');
    }
}
