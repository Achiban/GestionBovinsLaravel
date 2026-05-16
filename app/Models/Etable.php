<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nom'])]
class Etable extends Model
{
    protected $primaryKey = 'id_etab';

    public function bovins()
    {
        return $this->hasMany(Bovin::class, 'id_etab');
    }
}
