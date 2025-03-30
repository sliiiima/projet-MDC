<?php

namespace App\Http\Controllers;

use App\Models\TypeMedicament;
use Illuminate\Http\Request;

class TypeMedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = TypeMedicament::all();
        return view("types-medicaments.index", compact("types"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("types-medicaments.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        TypeMedicament::create($request->all());
        return redirect()->route("types-medicaments.index")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeMedicament $typeMedicament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeMedicament $typeMedicament)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeMedicament $typeMedicament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TypeMedicament::find( $id )->delete();
        return redirect()->route("types-medicaments.index")->with("success","");
    }
}
