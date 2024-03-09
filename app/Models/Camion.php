<?php

namespace App\Models;

use App\Traits\OrderByDesc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class Camion extends Model
{
    use HasFactory,OrderByDesc,Notifiable;
    public function donnes()
    {
        return $this->hasMany(Donne::class);
    }
    public function totaldonnes()
    {
        return $this->donnes->sum('montant');
    }

    public function estRembourse()
    {
        return $this->restant() == 0;
    }

    public function remboursementDepasse()
    {

        $tomorow = Carbon::today()->toDateString();
        return $this->date_remboursement <= $tomorow;
    }
    public function restant()
    {
        //le montant moin $this->totaldonnes
        return $this->montant - $this->totaldonnes();
        }
    protected $fillable = [
        'matricule',
        'montant',
        'notification',
        'date_remboursement',
        'detail'

    ];
}
