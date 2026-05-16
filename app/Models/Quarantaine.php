<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['libelle'])]
class Quarantaine extends Model
{
    protected $primaryKey = 'id_q';

    public function bovins()
    {
        return $this->hasMany(Bovin::class, 'id_q');
    }
}
