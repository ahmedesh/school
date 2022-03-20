<?php

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{


    public function run()
    {
        DB::table('genders')->delete();  // فضيه عشان املاه وميحصلش تكرار

        $genders = [
            ['en'=> 'Male', 'ar'=> 'ذكر'],
            ['en'=> 'Female', 'ar'=> 'انثي'],

        ];
        foreach ($genders as $ge) {
            Gender::create(['Name' => $ge]);
        }
    }

}
