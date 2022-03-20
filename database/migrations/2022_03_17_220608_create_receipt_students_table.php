<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptStudentsTable extends Migration
{


    public function up()
    { // جدول سند القبض (لما الطالب يسد فلوس من اللي عليه يعني)
        Schema::create('receipt_students', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->decimal('Debit',8,2)->nullable();
            $table->string('description');
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('receipt_students');
    }
}
