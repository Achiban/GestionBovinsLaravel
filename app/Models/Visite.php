<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['description_v', 'datepres', 'prix_pres', 'id_bov', 'id_vet'])]
class Visite extends Model
{
    protected $primaryKey = 'id_pres';

    protected $casts = [
        'datepres' => 'date',
    ];

    public function bovin()
    {
        return $this->belongsTo(Bovin::class, 'id_bov');
    }

    public function veto()
    {
        return $this->belongsTo(Veto::class, 'id_vet');
    }
}
