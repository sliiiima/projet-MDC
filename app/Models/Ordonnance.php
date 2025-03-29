<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'date_donnee', 'etat'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function detailMedicaments()
    {
        return $this->hasMany(DetailMedicament::class, 'ordonnance_id');
    }
}
