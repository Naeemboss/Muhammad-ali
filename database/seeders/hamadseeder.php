<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Hamad; // Import the Hamad model

class hamadseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/json/hamad.json'); // Ensure correct path
        $hamad = collect(json_decode($json));

        $hamad->each(function($inam) {
            Hamad::create([ // Ensure you use the correct model name
                'name' => $inam->name,
                'father_name' => $inam->father_name,
                'email' => $inam->email,
                'address' => $inam->address,
                'city' => $inam->city,
                'password' => bcrypt($inam->password), // Hash the password
                'age' => $inam->age,
            ]);
        });
    }
}


