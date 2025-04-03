<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use App\Models\TypeMedicament;
use App\Models\Medicament;
use App\Models\Patient;

class ImportExcelController extends Controller
{
    public function create()
    {
        return view('import.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls|max:2048'
        ]);

        try {
            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file->getRealPath());

            DB::beginTransaction();

            // 1. Importer les types des medicaments
            $medTypesSheet = $spreadsheet->getSheetByName('type_medicaments');
            $medTypesData = $medTypesSheet->toArray(null, true, true, true);
            $medTypeIds = [];
            foreach (array_slice($medTypesData, 1) as $row) {
                $type = TypeMedicament::create([
                    'nom_type' => $row['A'] // Assuming type_name is in column A
                ]);
                $medTypeIds[$row['A']] = $type->id;
            }

            // 2. Importer les medicaments
            $medsSheet = $spreadsheet->getSheetByName('medicaments');
            $medsData = $medsSheet->toArray(null, true, true, true);
            foreach (array_slice($medsData, 1) as $row) {
                Medicament::create([
                    'nom' => $row['A'],
                    'description' => $row['B'],
                    'type_medicament_id' => $row['C'],
                    'est_active' => boolval($row['D']),
                    'qte_alerte' => $row['E'],
                    'qte_initial' => $row['F']
                ]);
            }

            // 3. Importer les patients
            $patientsSheet = $spreadsheet->getSheetByName('patients');
            $patientsData = $patientsSheet->toArray(null, true, true, true);
            foreach (array_slice($patientsData, 1) as $row) {
                $date_naissance = $row['C'];
                if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_naissance)) {
                    $date = \DateTime::createFromFormat('m/d/Y', $date_naissance);
                    $date_naissance = $date ? $date->format('Y-m-d') : null;
                }
                else if(is_numeric($date_naissance)) {
                    $date_naissance = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_naissance)
                        ->format('Y-m-d');
                }

                Patient::create([
                    'nom' => $row['A'],
                    'prenom' => $row['B'],
                    'date_naissance' => $date_naissance,
                    'sexe' => $row['D'],
                    'adresse' => $row['E']
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data imported successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }
}
