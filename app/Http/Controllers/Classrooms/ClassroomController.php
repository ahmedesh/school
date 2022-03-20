<?php


namespace App\Http\Controllers\Classrooms;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreClassroom;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{


  public function index()
  {
      $My_Classes = Classroom::all();
      $Grades = Grade::all();
      return view('pages.My_Classes.My_Classes', compact('My_Classes', 'Grades'));

  }



  public function store(StoreClassroom $request)
  {

          $List_Classes = $request->List_Classes;

        try {

            $validated = $request->validated();

//              $this->validate($request , [
//              'List_Classes.*.Name'          => 'required',    // 'List_Classes.*.Name' عملتها كدا عشان هي عباره عن Array
//              'List_Classes.*.Name_class_en' => 'required',    // 'List_Classes.*.Name' عملتها كدا عشان هي عباره عن Array
//          ],[
//                  // 'List_Classes.*.Name' عملتها كدا عشان هي عباره عن Array
//              'List_Classes.*.Name.required'          => trans('validation.required'),
//              'List_Classes.*.Name_class_en.required' => trans('validation.required'),
//          ]);

            foreach ($List_Classes as $List_Class) {  // عامل هنا foreach عشان انا مستخدم form-repeater عشان يدخلي كل الداتا اللي مبعوتاله للداتابيز

                $My_Classes = new Classroom();
// عشان بنضيف array اكتر من صف
                $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];

                $My_Classes->Grade_id = $List_Class['Grade_id'];

                $My_Classes->save();

            }
          toastr()->success(trans('messages.success_create'));
          return redirect()->route('Classrooms.index');
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  }


  public function update(StoreClassroom $request)  //  $request بستحدم ال  عشان انا جاي من موديل مش من صفحه edit لوجدها
  {
      try {

          $validated = $request->validated();

          $Classrooms = Classroom::findOrFail($request->id);

          $Classrooms->Name_Class = ['en' =>  $request->Name_en, 'ar' => $request->Name];   // عشان افعل العربي والانجليزي بدون م اعمل حقل زياده فالداتابيز
          $Classrooms->Grade_id   = $request->Grade_id;
          $Classrooms->update();
          toastr()->success(trans('messages.success_update'));
          return redirect()->route('Classrooms.index');
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }


  }


  public function destroy(Request $request)
  {
      $Classrooms = Classroom::findOrFail($request->id)->delete();
      toastr()->error(trans('messages.success_delete'));
      return redirect()->route('Classrooms.index');

  }

  public function delete_all(Request $request){

      $delete_all_id = explode(",", $request->delete_all_id);  // explode => بتعملي array

      Classroom::whereIn('id', $delete_all_id)->Delete(); // whereIn => تستعمل مع ال array فقط
      toastr()->error(trans('messages.success_delete'));
      return redirect()->route('Classrooms.index');
  }

    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();
        return view('pages.My_Classes.My_Classes',compact('Grades'))->withDetails($Search);

    }

}

?>
