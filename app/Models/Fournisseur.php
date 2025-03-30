<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = ['medicament_id', 'qte_recue', 'date_recue'];

    public function medicament()
    {
        return $this->belongsTo(Medicament::class, 'medicament_id');
    }
}
