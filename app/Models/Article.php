<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'serie_number', 'client_pseudo', 'rev_email', 'var_designation', 'cmd_ref', 'status'
    ];

    public function reclamations()
    {
        return $this->hasMany(Reclamation::class, 'serie_number', 'serie_number');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_pseudo', 'pseudo');
    }

    public function revendeurCommande()
    {
        return $this->belongsTo(RevendeurCommande::class, 'cmd_ref', 'reference');
    }

    public function revendeur()
    {
        return $this->belongsTo(User::class, 'rev_email', 'email');
    }


    public function variation()
    {
        return $this->belongsTo(Variation::class, 'var_designation', 'designation');
    }
}
