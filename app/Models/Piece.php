<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    protected $primaryKey = 'ref';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    public function articlesPiece()
    {
        return $this->hasMany(ArticlesPiece::class, 'ref', 'ref');
    }
}
