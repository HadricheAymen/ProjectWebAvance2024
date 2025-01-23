<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prescription extends Model
{
    use HasFactory;

    protected $fillable = ['patientID','note', ];


    public function patient() {
        return $this->belongsTo(Patient::class, 'patientID');
    }

    public function prescriptionsmedication() {
        return $this->hasMany(Prescriptionsmedication::class, 'prescriptionID');
    }
}
