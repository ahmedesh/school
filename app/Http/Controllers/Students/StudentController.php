<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentsRequest;
use App\Repository\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $Student;

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }

// Get_Student
    public function index()
    {
        return $this->Student->Get_Student();
    }

// Show_Student
    public function show($id)
    {
        return $this->Student->Show_Student($id);
    }

// Edit_Student
    public function edit($id)
    {
        return $this->Student->Edit_Student($id);
    }

// Update_Student
    public function update(StoreStudentsRequest $request)
    {
        return $this->Student->Update_Student($request);
    }

// Update_Student
    public function destroy(Request $request)
    {
        return $this->Student->Delete_Student($request);
    }

// Create_Student
    public function create()
    {
        return $this->Student->Create_Student();
    }

    public function store(StoreStudentsRequest $request)
    {
        return $this->Student->Store_Student($request);
    }


    public function Get_classrooms($id)
    {
        return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Student->Upload_attachment($request);
    }

    public function Delete_attachment(Request $request)
    {
        return $this->Student->Delete_attachment($request);

    }
}
