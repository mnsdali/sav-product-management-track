<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    // Relationships
    public function interventionOperations()
    {
        return $this->hasMany(InterventionOperation::class, 'operation_id');
    }


}
