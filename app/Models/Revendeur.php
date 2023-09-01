<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Revendeur extends Authenticatable
{
    use HasFactory;

    protected $guard = 'revendeur';

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    public function revendeurCommandes()
    {
        return $this->hasMany(RevendeurCommande::class);
    }
}
