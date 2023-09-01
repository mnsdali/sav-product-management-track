<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;


    public function operations()
    {
        return $this->hasMany(InterventionOperation::class, 'intervention_id');
    }
}
