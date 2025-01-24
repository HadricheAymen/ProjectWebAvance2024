<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index(){
        try {
            $medication = Medication::with('medicationtypes')->get();
            return response()->json($medication);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id){
        try {
            $medication = Medication::find($id);
            return response()->json($medication);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request){
        try {
            $medication = Medication::create($request->all());
            return response()->json($medication);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, $id){
        try {
            $medication = Medication::find($id);
            $medication->update($request->all());
            return response()->json($medication);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id){
        try {
            $medication = Medication::find($id);
            $medication->delete();
            return response()->json(['message' => 'Medication deleted']);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function medicationPaginate() { 
        try { 
            $perPage = request()->input('pageSize', 5); // Récupère la valeur dynamique pour la pagination 
            $medications = Medication::paginate($perPage); // Retourne le résultat en format JSON API 
            return response()->json(
           ['medication' => $medications->items(), // Les articles paginés 
                'totalPages' => $medications->lastPage(), // Le nombre de pages 
        ]); } 
        catch (\Exception $e) 
        { 
            return response()->json("Selection impossible {$e->getMessage()}"); 
        } 
    }
}
