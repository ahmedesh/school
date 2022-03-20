<?php

namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

// ======================== index ======================
  public function index()
  {
      $Grades = Grade::all();
    return view('pages.Grades.Grades' , compact('Grades'));
  }


// ========================= store ========================
  public function store(StoreGrades $request)
  {

      try {

          $validated = $request->validated();

          if (Grade::where('Name->ar' , $request->Name)->orWhere('Name->en' , $request->Name_en)->exists())
          {
              return redirect()->back();
          }

          $Grade = new Grade();
          /* الطريقه الاولي عشان افعل العربي والانجليزي بدون م اعمل حقل زياده فالداتابيز
             $translations = [
                 'en' => $request->Name_en,
                 'ar' => $request->Name
             ];
             $Grade->setTranslations('Name', $translations);
             */

          // الطريقه التانيه
          $Grade->Name = ['en' =>  $request->Name_en, 'ar' => $request->Name];   // عشان افعل العربي والانجليزي بدون م اعمل حقل زياده فالداتابيز


          $Grade->Notes = $request->Notes;
          $Grade->save();
          toastr()->success(trans('messages.success_create'));
          return redirect()->route('Grades.index');
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

  }

// =============================== Update ================================
  public function update(StoreGrades $request)
  {
      try {

          $validated = $request->validated();

          $Grade = Grade::findOrFail($request->id);
          $Grade->Name = ['en' =>  $request->Name_en, 'ar' => $request->Name];   // عشان افعل العربي والانجليزي بدون م اعمل حقل زياده فالداتابيز
          $Grade->Notes = $request->Notes;
          $Grade->update();
          toastr()->success(trans('messages.success_update'));
          return redirect()->route('Grades.index');
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

  }


// =============================== Delete ================================
  public function destroy(Request $request)
  {
      // عشان لو راح يحذف مرحله وكان المرحله دي تابع لها صفوف دراسيه ميرضاش يحذفها الا م يحذف الصفوف دي الاول
      $MyClass_id = Classroom::where('Grade_id',$request->id)->pluck('Grade_id'); // ->pluck('Grade_id') يعني احمل ال id دا
// وعادي ممكن اعمله first() مش شرط pluck يعني
      if($MyClass_id->count() == 0) {  // لو مفيش كلاس تبعها
          $Grades = Grade::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.success_delete'));
          return redirect()->route('Grades.index');
      }
      else{
          toastr()->error(trans('Grades_trans.delete_Grade_Error'));
          return redirect()->route('Grades.index');
      }
  }

}

?>
