<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('specializations')->delete();  // فضيه عشان املاه وميحصلش تكرار

        $specializations = [
            ['en'=> 'Arabic'  , 'ar'=> 'عربي'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'English' , 'ar'=> 'انجليزي'],
        ];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }
    }

}
