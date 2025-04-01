<?php

use App\Http\Controllers\DetailMedicamentController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TypeMedicamentController;
use App\Http\Controllers\ImportController;

Route::resource('medicaments', MedicamentController::class);
Route::resource('patients', PatientController::class);
Route::resource('ordonnances', OrdonnanceController::class);
Route::resource('types-medicaments', TypeMedicamentController::class);
Route::resource('fournisseurs', FournisseurController::class);
Route::resource('details-medicaments', DetailMedicamentController::class);
Route::resource('import', ImportController::class);


Route::get('/',fn()=>view('dashboard'));