<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable
{
    use HasFactory;
    use Notifiable;



    protected $fillable = [
        'pseudo', 'prenom', 'nom', 'num_tel1', 'num_tel2'
    ];

    public function reclamations()
    {
        return $this->hasMany(Reclamation::class, 'client_pseudo', 'pseudo');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'client_pseudo', 'pseudo');
    }
    public function routeNotificationForVonage($notification)
    {
        return '216'.$this->num_tel1;
    }


}
