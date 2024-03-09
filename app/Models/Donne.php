<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donne extends Model
{
    use HasFactory;
    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }
    protected $fillable = [
        'montant',
        'camion_id'

    ];
}
