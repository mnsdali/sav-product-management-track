<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'nom', 'description', 'prix'
    ];

    public function variations()
    {
        return $this->hasMany(Variation::class, 'prod_ref', 'reference');
    }

}
