<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'medications';
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'medicationtypeID'
    ];

    public function medicationtypes() {
        return $this->belongsTo(Medicationtypes::class, 'medicationtypeID');
    }

    public function prescriptionmedication() {
        return $this->hasMany(Prescriptionsmedication::class, 'medicationID');
    }
}
