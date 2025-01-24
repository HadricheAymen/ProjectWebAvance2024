<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index(){
        try {
            $patient = Patient::all();
            return response()->json($patient);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function show($id){
        try {
            $patient = Patient::with('prescription')->find($id);
            return response()->json($patient);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function store(Request $request)
    { 
        try {
            $patient = Patient::create($request->all());
            return response()->json($patient);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $patient = Patient::find($id);
            $patient->update($request->all());
            return response()->json($patient);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $patient = Patient::find($id);
            $patient->delete();
            return response()->json(['message' => 'Patient deleted']);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function patientPaginate() { 
        try { 
            $perPage = request()->input('pageSize', 5); // Récupère la valeur dynamique pour la pagination 
            $patients = Patient::paginate($perPage); // Retourne le résultat en format JSON API 
            return response()->json(
           ['medication' => $patients->items(), // Les articles paginés 
                'totalPages' => $patients->lastPage(), // Le nombre de pages 
        ]); } 
        catch (\Exception $e) 
        { 
            return response()->json("Selection impossible {$e->getMessage()}"); 
        } 
    }

}
