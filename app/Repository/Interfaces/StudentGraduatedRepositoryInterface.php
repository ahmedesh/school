<?php

namespace App\Repository\Interfaces;

interface StudentGraduatedRepositoryInterface
{
    // Get Student graduated
    public function index();


    public function create();

    // update Students to SoftDelete to graduated
    public function SoftDelete($request);

    // ReturnData Students to retrieve from graduated
    public function ReturnData($request);

    // destroy Students
    public function destroy($request);
}
