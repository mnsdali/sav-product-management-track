<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation', 'est_disponible', 'prod_ref'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'prod_ref', 'reference');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'var_designation', 'designation');
    }
}
