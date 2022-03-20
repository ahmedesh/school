<?php

namespace App\Repository\Interfaces;

interface TeacherRepositoryInterface  // فالصفحه دي بعرف الفانكشن بس
{
    // get all Teachers
    public function getAllTeachers();

    // Get specialization
    public function GetSpecialization();

    // Get Gender
    public function GetGender();

    // StoreTeachers
    public function StoreTeachers($request);

    // StoreTeachers
    public function editTeachers($id);

    // UpdateTeachers
    public function UpdateTeachers($request);

    // DeleteTeachers
    public function DeleteTeachers($request);

}
