<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Technicien extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public function reclamations()
    {
        return $this->hasMany(Reclamation::class, 'tech_email');
    }

    public function routeNotificationForVonage($notification)
    {
        return '216'.$this->num_telephone;
    }


}
