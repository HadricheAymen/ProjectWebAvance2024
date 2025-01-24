<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     ['name' => 'Admin',
        //     'email' => 'admin@example',
        //     'password' => bcrypt('password'),
        //     'role' => 'admin',
        //     'isActive' => true],
        //     ['name' => 'pharmacist',
        //     'email' => 'pharmacist@example',
        //     'password' => bcrypt('password'),
        //     'role' => 'pharmacist',
        //     'isActive' => true],
        // ]);

        DB::table('medicationtypes')->insert([
            ['name' => 'Antibiotics'],
            ['name' => 'Antihistamines'],
            ['name' => 'Antipsychotics'],
            ['name' => 'Antivirals'],
            ['name' => 'Antianxiety Drugs'],
            ['name' => 'Antiemetics'],
            ['name' => 'Anticonvulsants'],
            ['name' => 'Antidepressants'],
            ['name' => 'Antipsychotics'],
            ['name' => 'Antiseptics'],

        ]);

        $AntibioticsID = DB::table('medicationtypes')->where('name','Antibiotics')->value('id');
        $Antihistamines = DB::table('medicationtypes')->where('name','Antihistamines')->value('id');
        $Antipsychotics = DB::table('medicationtypes')->where('name','Antipsychotics')->value('id');
        $Antivirals = DB::table('medicationtypes')->where('name','Antivirals')->value('id');
        $Antiemetics = DB::table('medicationtypes')->where('name','Antiemetics')->value('id');

        Db::table('medications')->insert([
            ['name' => 'Macrolides','medicationtypeID' => $AntibioticsID],
            ['name' => 'Penicillins','medicationtypeID' => $AntibioticsID],
            ['name' => 'Tetracyclines','medicationtypeID' => $AntibioticsID],
            ['name' => 'Aciclovir','medicationtypeID' => $Antivirals],
            ['name' => 'Azithromycin','medicationtypeID' => $AntibioticsID],
            ['name' => 'Zanamivir ','medicationtypeID' => $Antivirals],
            ['name' => 'Citalopram','medicationtypeID' => $Antipsychotics],
            ['name' => 'Fluoxetine','medicationtypeID' => $Antipsychotics],
            ['name' => 'Sertraline','medicationtypeID' => $Antipsychotics],
            ['name' => 'Zoloft','medicationtypeID' => $Antipsychotics],
            ['name' => 'Cetirizine','medicationtypeID' => $Antihistamines],
            ['name' => 'Loratadine','medicationtypeID' => $Antihistamines],
            ['name' => 'Pseudoephedrine','medicationtypeID' => $Antiemetics],
            ['name' => 'Diphenhydramine','medicationtypeID' => $Antiemetics],
            ['name' => 'Naproxen','medicationtypeID' => $Antiemetics],
            ['name' => 'Ibuprofen','medicationtypeID' => $Antiemetics],
            ['name' => 'Dexamethasone','medicationtypeID' => $Antiemetics],
            ['name' => 'Prednisone','medicationtypeID' => $Antiemetics],
            ['name' => 'Hydrocortisone','medicationtypeID' => $Antiemetics],
            ['name' => 'Metformin','medicationtypeID' => $Antiemetics],
            ['name' => 'Glimepiride','medicationtypeID' => $Antiemetics],
            ['name' => 'Insulin','medicationtypeID' => $Antiemetics],
            ['name' => 'Metformin','medicationtypeID' => $Antiemetics],
            ['name' => 'Glimepiride','medicationtypeID' => $Antiemetics],
            ['name' => 'Insulin','medicationtypeID' => $Antiemetics],
        ]);
        DB::table('patients')->insert([
            ['name' => 'patient1', 'datenaissance' => '1/1/1999', 'email' => 'patient1@patient1.com', 'phone' => '1234567890'],
            ['name' => 'patient2', 'datenaissance' => '5/4/1990', 'email' => 'patient2@patient2.com', 'phone' => '1234567891'],
            ['name' => 'patient3', 'datenaissance' => '5/4/1991', 'email' => 'patient3@patient3.com', 'phone' => '1234567892'],
            ['name' => 'patient4', 'datenaissance' => '5/4/1992', 'email' => 'patient4@patient4.com', 'phone' => '1234567893'],
            ['name' => 'patient5', 'datenaissance' => '5/4/1993', 'email' => 'patient5@patient5.com', 'phone' => '1234567894'],
            ['name' => 'patient6', 'datenaissance' => '5/4/1994', 'email' => 'patient6@patient6.com', 'phone' => '1234567895'],
            ['name' => 'patient7', 'datenaissance' => '5/4/1995', 'email' => 'patient7@patient7.com', 'phone' => '1234567896'],
        ]);

        DB::table('prescriptions')->insert([
            ['patientID' => 1, 'note' => ''],
        ]);
        $prescriptionID = DB::table('prescriptions')->where('patientID',1)->value('id');

        DB::table('prescriptionsmedication')->insert([
            ['prescriptionID' => $prescriptionID, 'medicationID' => 1],
            ['prescriptionID' => $prescriptionID, 'medicationID' => 2],
        ]);
    }
}
