<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{


    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->foreignId('nationalitie_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreignId('blood_id')->references('id')->on('type__bloods')->onDelete('cascade');
            $table->date('Date_Birth');
            $table->foreignId('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreignId('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('parent_id')->references('id')->on('my__parents')->onDelete('cascade');
            $table->string('academic_year');
            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('students');
    }
}
