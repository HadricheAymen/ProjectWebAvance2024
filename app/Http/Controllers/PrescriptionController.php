<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use App\Models\Prescription;
use App\Models\prescriptionsmedication;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index() {
        try {
            $prescriptions= Prescription::with('patient', 'prescriptionsmedication')->get();
            return response()->json($prescriptions);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function prescriptionBypatient($patientID)
    {
        try {
            $prescriptions = Prescription::with('patient', 'prescriptionsmedication')->where('patientID', $patientID)->get();
            return response()->json($prescriptions);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }



    public function show($id)
    {
        try {
            $prescriptions = Prescription::with('patient', 'prescriptionsmedication.medication')->find($id);
            return response()->json($prescriptions);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'patientID' => 'required|exists:patients,id',
                'medications' => 'required|array',
                'medications.*.id' => 'required|exists:medications,id',
                'note' => 'nullable|string',
            ]);

            // Create a new prescription
            $prescription = Prescription::create([
                'patientID' => $validated['patientID'],
                'note' => $validated['note'],
            ]);

            // Attach medications to the prescription
            foreach ($validated['medications'] as $medication) {
                prescriptionsmedication::create([
                    'prescriptionID' => $prescription->id,
                    'medicationID' => $medication['id'],
                ]);
            }

            return response()->json(['message' => 'Prescription created successfully!', 'data' => $prescription->load('prescriptionsmedication')], 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Update an existing prescription
            $validated = $request->validate([
                'medications' => 'nullable|array',
                'medications.*.id' => 'required|exists:medications,id',
                'note' => 'nullable|string',
            ]);

            $prescription = Prescription::findOrFail($id);

            // Update the prescription note if provided
            if (isset($validated['note'])) {
                $prescription->update(['note' => $validated['note']]);
            }

            // If medications are provided, update them
            if (isset($validated['medications'])) {
                // Remove existing medications
                PrescriptionsMedication::where('prescriptionID', $prescription->id)->delete();

                // Add new medications
                foreach ($validated['medications'] as $medication) {
                    PrescriptionsMedication::create([
                        'prescriptionID' => $prescription->id,
                        'medicationID' => $medication['id'],
                    ]);
                }
            }

            return response()->json(['message' => 'Prescription updated successfully!', 'data' => $prescription->load('prescriptionsmedication')], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function prescriptionPaginate() { 
        try { 
            $perPage = request()->input('pageSize', 5); // Récupère la valeur dynamique pour la pagination 
            $prescriptions = Prescription::with('patient', 'prescriptionsmedication')->paginate($perPage); // Retourne le résultat en format JSON API 
            return response()->json(
           ['medication' => $prescriptions->items(), // Les articles paginés 
                'totalPages' => $prescriptions->lastPage(), // Le nombre de pages 
        ]); } 
        catch (\Exception $e) 
        { 
            return response()->json("Selection impossible {$e->getMessage()}"); 
        } 
    }
}
