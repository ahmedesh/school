<?php

namespace App\Repository\Interfaces;

interface StudentRepositoryInterface{

   // Get Student
    public function Get_Student();

    // Show Student
    public function Show_Student($id);

    // Edit Student
    public function Edit_Student($id);

    // Update Student
    public function Update_Student($request);

    // Update Student
    public function Delete_Student($request);

    // Get Add Form Student
    public function Create_Student();

    // Get classrooms
    public function Get_classrooms($id);

    //Get Sections
    public function Get_Sections($id);

    //Store_Student
    public function Store_Student($request);

    //Upload_attachment
    public function Upload_attachment($request);

    //Delete_attachment
    public function Delete_attachment($request);
}


