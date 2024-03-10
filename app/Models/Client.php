<?php

namespace App\Models;

use App\Traits\OrderByDesc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class Client extends Model
{
    use HasFactory,OrderByDesc ,Notifiable;
    public function payements()
    {
        return $this->hasMany(Payement::class);
    }
    public function totalpayements()
    {
        return $this->payements->sum('montant');
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function totalarticle()
    {
        return $this->articles->sum(function($article){
            return $article->montant * $article->quantite;
        });
    }
    //si le date_remboursement est null envoi true sinon false
    public function estRembourse()
    {
        return $this->restant() == 0;
    }

    public function remboursementDepasse()
    {
        // Vérifie que la date de remboursement n'est pas null.
        if (is_null($this->date_remboursement)) {
            return false;
        }
            $tomorow = Carbon::today()->toDateString();
            return $this->date_remboursement <= $tomorow;

    }
    public function restant()
    {
        return $this->totalarticle() - $this->totalpayements();
    }

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'notification',
        'date_remboursement',
    ];
}
