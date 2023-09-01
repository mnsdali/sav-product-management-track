<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Reclamation extends Model
{
    use HasFactory;
    // use HasUlids;

    protected $fillable = [
        'type_panne', 'description_panne', 'etat', 'client_pseudo', 'tech_email', 'serie_number', 'lat', 'lng', 'kilometrage'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'serie_number', 'serie_number');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_pseudo', 'pseudo');
    }

    public function technicien()
    {
        return $this->belongsTo(User::class, 'tech_email', 'email')->role('technicien');
    }

}
