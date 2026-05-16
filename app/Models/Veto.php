<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nom_vet', 'prenom_vet', 'tel_vet'])]
class Veto extends Model
{
    protected $primaryKey = 'id_vet';

    public function visites()
    {
        return $this->hasMany(Visite::class, 'id_vet');
    }
}
