<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Medicament;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view("fournisseurs.index", compact("fournisseurs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("fournisseurs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Fournisseur::create($request->all());
        $medicament = Medicament::find($request->medicament_id);
        Medicament::find($request->medicament_id)->update(["qte_initial"=> $medicament->qte_initial + $request->qte_recue]);
        return redirect()->route("fournisseurs.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fournisseur = Fournisseur::find($id);
        return view("fournisseurs.modify", compact("fournisseur"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fournisseur = Fournisseur::find($id);
        
        $medicament = Medicament::find($fournisseur->medicament_id);
        $medicament->update(["qte_initial"=> $medicament->qte_initial - $fournisseur->qte_recue]);

        $medicament = Medicament::find($request->medicament_id);
        $medicament->update(["qte_initial"=> $medicament->qte_initial + $request->qte_recue]);

        $fournisseur->update($request->all());
        return redirect()->route("fournisseurs.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fournisseur = Fournisseur::find( $id );
        $medicament = Medicament::find($fournisseur->medicament_id);
        Medicament::find($fournisseur->medicament_id)->update(["qte_initial"=> $medicament->qte_initial - $fournisseur->qte_recue]);
        $fournisseur->delete();
        return redirect()->route("fournisseurs.index");
    }
}
