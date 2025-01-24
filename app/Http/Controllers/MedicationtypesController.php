<?php

namespace App\Http\Controllers;

use App\Models\Medicationtypes;
use Illuminate\Http\Request;

class MedicationtypesController extends Controller
{
    public function index(){
        try {
            $medicationtypes = Medicationtypes::all();
            return response()->json($medicationtypes);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id){
        try {
            $medicationtypes = Medicationtypes::find($id);
            return response()->json($medicationtypes);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request){
        try {
            $medicationtypes = Medicationtypes::create($request->all());
            return response()->json($medicationtypes);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, $id){
        try {
            $medicationtypes = Medicationtypes::find($id);
            $medicationtypes->update($request->all());
            return response()->json($medicationtypes);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id){
        try {
            $medicationtypes = Medicationtypes::find($id);
            $medicationtypes->delete();
            return response()->json(['message' => 'Medication type deleted']);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function medicationtypePaginate() { 
        try { 
            $perPage = request()->input('pageSize', 5); // Récupère la valeur dynamique pour la pagination 
            $medicationstypes = Medicationtypes::paginate($perPage); // Retourne le résultat en format JSON API 
            return response()->json(
           ['medicationtypes' => $medicationstypes->items(), // Les articles paginés 
                'totalPages' => $medicationstypes->lastPage(), // Le nombre de pages 
        ]); } 
        catch (\Exception $e) 
        { 
            return response()->json("Selection impossible {$e->getMessage()}"); 
        } 
    }
}
