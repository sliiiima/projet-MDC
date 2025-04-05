<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use App\Models\Patient;
use App\Models\Medicament;
use Illuminate\Http\Request;

class OrdonnanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordonnances = Ordonnance::with(['patient', 'detailMedicaments.medicament'])
            ->latest()
            ->paginate(10);

        return view('ordonnances.index', compact('ordonnances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::orderBy('nom')->get();
        $medicaments = Medicament::orderBy('nom')->get();

        return view('ordonnances.create', compact('patients', 'medicaments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_donnee' => 'required|date',
            'medicaments' => 'required|array',
            'medicaments.*.id' => 'required|exists:medicaments,id',
            'medicaments.*.quantite' => 'required|integer|min:1',
            'etat' => 'required|in:completed,incompleted'
        ]);

        $ordonnance = Ordonnance::create([
            'patient_id' => $request->patient_id,
            'date_donnee' => $request->date_donnee,
            'etat' => $request->etat == 'completed' ? true : false,
        ]);

        foreach ($request->medicaments as $medicament) {
            $ordonnance->detailMedicaments()->create([
                'medicament_id' => $medicament['id'],
                'qte_donnee' => $medicament['quantite']
            ]);
        }

        return redirect()->route('ordonnances.show', $ordonnance)
            ->with('success', 'Prescription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordonnance $ordonnance)
    {
        $ordonnance->load(['patient', 'detailMedicaments.medicament']);
        return view('ordonnances.show', compact('ordonnance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ordonnance $ordonnance)
    {
        $patients = Patient::orderBy('nom')->get();
        $medicaments = Medicament::orderBy('nom')->get();
        $ordonnance->load('detailMedicaments');

        return view('ordonnances.edit', compact('ordonnance', 'patients', 'medicaments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordonnance $ordonnance)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_ordonnance' => 'required|date',
            'medicaments' => 'required|array',
            'medicaments.*.id' => 'required|exists:medicaments,id',
            'medicaments.*.quantite' => 'required|integer|min:1',
            'instructions' => 'nullable|string|max:1000',
            'statut' => 'required|in:active,completed,cancelled'
        ]);

        $ordonnance->update([
            'patient_id' => $request->patient_id,
            'date_ordonnance' => $request->date_ordonnance,
            'instructions' => $request->instructions,
            'statut' => $request->statut
        ]);

        // Delete existing medications
        $ordonnance->detailMedicaments()->delete();

        // Add new medications
        foreach ($request->medicaments as $medicament) {
            $ordonnance->detailMedicaments()->create([
                'medicament_id' => $medicament['id'],
                'quantite' => $medicament['quantite']
            ]);
        }

        return redirect()->route('ordonnances.show', $ordonnance)
            ->with('success', 'Prescription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordonnance $ordonnance)
    {
        $ordonnance->detailMedicaments()->delete();
        $ordonnance->delete();

        return redirect()->route('ordonnances.index')
            ->with('success', 'Prescription deleted successfully.');
    }
}
