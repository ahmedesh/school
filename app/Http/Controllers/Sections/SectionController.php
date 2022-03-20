<?php

namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        $Grades = Grade::with(['Sections'])->get(); // عشان يعرضلي المرحله بالاقسام   // Sections => دا اسم العلاقه
        $list_Grades = Grade::all();  // عشان لما اجي اضيف قسم تبع مرحله كذا تيجيلي اسم المرحله دي
        $teachers = Teacher::all();
        return view('pages.Sections.Sections',compact('Grades','list_Grades' , 'teachers'));
    }



    public function store(StoreSections $request)
    {
        try {
            $validated = $request->validated();

            $Sections = new Section();
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            $Sections->Status = 1;
            $Sections->save();
            $Sections->teachers()->attach($request->teacher_id);  // use attach when insert to other table
            toastr()->success(trans('messages.success_create'));

            return redirect()->route('Sections.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function update(StoreSections $request)
    {
        try {
            $validated = $request->validated();

            $Sections = Section::findOrFail($request->id);

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;

            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }


            // update pivot tABLE
            if (isset($request->teacher_id)) {
                $Sections->teachers()->sync($request->teacher_id);  // sync => بتعدل بتمسح القيمه القديمه اللي دخلت عندي وتحط القيم الجديده بقا
            } else {
                $Sections->teachers()->sync(array());
            }


            $Sections->save();
            toastr()->success(trans('messages.success_update'));

            return redirect()->route('Sections.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function destroy(request $request)
    {

        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.success_delete'));
        return redirect()->route('Sections.index');

    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
    }

}
