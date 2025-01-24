<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\MedicationtypesController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\PrescriptionController;


Route::middleware('api')->group(function () {
    Route::resource('/medications', MedicationController::class);
    Route::resource('/medicationtypes', MedicationtypesController::class);
    Route::resource('/prescriptions', PrescriptionController::class);
    Route::resource('/patients', PatientsController::class);
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refreshToken', [AuthController::class, 'refresh']);
Route::get('/user-profile', [AuthController::class, 'userProfile']);

Route::get('users/verify-email', [AuthController::class, 'verifyEmail'])
    ->name('verify.email');


Route::get('/prescriptionsbyPatient/{patientID}', [PrescriptionController::class, 'prescriptionBypatient']);

Route::get('/paginatemedication', [MedicationController::class, 'medicationPaginate']);
Route::get('/paginateprescription', [PrescriptionController::class, 'prescriptionPaginate']);
Route::get('/paginateprescriptionbyPatient/{patientID}', [PrescriptionController::class, 'prescriptionPaginateByPatient']);
Route::get('/paginatepatient', [PatientsController::class, 'patientPaginate']);
Route::get('/paginatemedicationtype', [MedicationtypesController::class, 'medicationtypePaginate']);
