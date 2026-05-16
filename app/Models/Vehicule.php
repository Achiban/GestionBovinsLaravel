<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['Matricule', 'type', 'id_trans'])]
class Vehicule extends Model
{
    protected $primaryKey = 'id_veh';

    public function transporteur()
    {
        return $this->belongsTo(Transporteur::class, 'id_trans');
    }
}
