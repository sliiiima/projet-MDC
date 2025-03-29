<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMedicament extends Model
{
    use HasFactory;
    protected $fillable = ['medicament_id', 'qte_donnee', 'commentaire', 'ordonnance_id'];

    public function medicament()
    {
        return $this->belongsTo(Medicament::class, 'medicament_id');
    }

    public function ordonnance()
    {
        return $this->belongsTo(Ordonnance::class, 'ordonnance_id');
    }
}
