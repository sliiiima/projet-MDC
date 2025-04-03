<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;
    //protected $fillable = ['nom', 'description', 'type_medicament_id', 'Est_active', 'qte_alerte', 'qte_initial'];
    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(TypeMedicament::class, 'type_medicament_id');
    }

    public function detailMedicaments()
    {
        return $this->hasMany(DetailMedicament::class, 'medicament_id');
    }

    public function fournisseurs()
    {
        return $this->hasMany(Fournisseur::class, 'medicament_id');
    }
}
