<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicaments = Medicament::all();
        return view("medicaments.index", compact("medicaments"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("medicaments.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Medicament::create([
            "nom"=> $request->nom,
            "description"=> $request->description,
            "type_medicament_id"=> $request->type_medicament_id,
            // "Est_active"=>$request->est_active?true:false,
            "qte_alerte"=>$request->qte_alerte,
            "qte_initial"=>$request->qte_initial,
        ]);
        return redirect()->route("medicaments.index")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicament $medicament)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicament = Medicament::findOrFail($id);
        return view("medicaments.modify", compact("medicament"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Medicament::find($id)->update([
            "nom"=> $request->nom,
            "description"=> $request->description,
            "type_medicament_id"=> $request->type_medicament_id,
            // "Est_active"=>$request->est_active?true:false,
            "qte_alerte"=>$request->qte_alerte,
            "qte_initial"=>$request->qte_initial,
        ]);
        return redirect()->route("medicaments.index")->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Medicament::find($id)->delete();
        return redirect()->route("medicaments.index")->with("success","");
    }
}
