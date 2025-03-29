<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'date_naissance', 'sexe', 'adresse'];

    public function ordonnances()
    {
        return $this->hasMany(Ordonnance::class, 'patient_id');
    }
}
