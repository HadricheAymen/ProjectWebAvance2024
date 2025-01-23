<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescriptionsmedication extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'prescriptionID',
        'medicationID',
    ];

    public function prescription() {
        $this->belongsTo(Prescription::class, 'prescriptionID');
    }

    public function medications() {
        $this->belongsTo(Medication::class, 'medicationID');
    }
} 
