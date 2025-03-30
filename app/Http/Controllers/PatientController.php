<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view("patients.index",compact("patients"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("patients.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Patient::create([
            "nom"=> $request->nom,
            "prenom"=> $request->prenom,
            "sexe"=> $request->sexe?'Homme':'Femme',
            "date_naissance"=> $request->date_naissance,
            "adresse"=> $request->adresse,
        ]);
        return redirect()->route("patients.index")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view("patients.modify",compact("patient"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->update([
            "nom"=> $request->nom,
            "prenom"=> $request->prenom,
            "sexe"=> $request->sexe?'Homme':'Femme',
            "date_naissance"=> $request->date_naissance,
            "adresse"=> $request->adresse,
        ]);
        return redirect()->route("patients.index")->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Patient::find($id)->delete();
        return redirect()->route("patients.index")->with("success","");
    }
}
