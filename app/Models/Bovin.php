<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'race', 'dateachat', 'prixachat', 'poidachat', 'lieuachat', 
    'datevente', 'prixavente', 'poidvente', 'lieuvente', 
    'vendu', 'mort', 'datemort', 'poidAct',
    'id_etab', 'id_vend', 'id_q'
])]
class Bovin extends Model
{
    protected $primaryKey = 'id_bov';

    protected $casts = [
        'dateachat' => 'date',
        'datevente' => 'date',
        'datemort' => 'date',
        'vendu' => 'boolean',
        'mort' => 'boolean',
    ];

    public function etable()
    {
        return $this->belongsTo(Etable::class, 'id_etab');
    }

    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class, 'id_vend');
    }

    public function quarantaine()
    {
        return $this->belongsTo(Quarantaine::class, 'id_q');
    }

    public function medicConsommes()
    {
        return $this->hasMany(MedicConsomme::class, 'id_bov');
    }

    public function nourritures()
    {
        return $this->hasMany(Nourriture::class, 'id_bov');
    }

    public function visites()
    {
        return $this->hasMany(Visite::class, 'id_bov');
    }
}
