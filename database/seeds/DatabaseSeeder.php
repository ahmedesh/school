<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    public function run()
    {
        $this->call(GradeSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(BloodTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(ParentsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
//        $this->call(SettingsTableSeeder::class);

    }

}


