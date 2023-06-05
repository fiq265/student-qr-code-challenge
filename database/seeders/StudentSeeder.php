<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'name'              => 'Abu',
            'class'             => 'Zamrud',
            'level'             => '1',
            'parent_contact'    => '0112111111'
        ]);

        Student::create([
            'name'              => 'Muthu',
            'class'             => 'Delima',
            'level'             => '3',
            'parent_contact'    => '0114111111'
        ]);
    }
}
