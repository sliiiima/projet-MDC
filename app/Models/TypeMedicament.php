<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMedicament extends Model
{
    use HasFactory;

    //protected $fillable = ['nom_type'];
    protected $guarded = ['id'];

    protected function medicaments(){
        return $this->hasMany(Medicament::class);
    }
}
