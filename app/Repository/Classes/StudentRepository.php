<?php

namespace App\Repository\Classes;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use App\Repository\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use function public_path;
use function redirect;
use function toastr;
use function trans;
use function view;


class StudentRepository implements StudentRepositoryInterface
 {

// Get_Student
    public function Get_Student(){
        $data['students'] = Student::all();  // students = $students يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
        return view('pages.Students.index',$data);
    }

    // Show_Student
    public function Show_Student($id){
        $data['Student'] = Student::findOrFail($id);  // students = $students يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
        return view('pages.Students.show',$data);
    }

    // Show_Student
    public function Edit_Student($id){
        $data['Students'] = Student::findOrFail($id);

        $data['Grades'] = Grade::all();  // my_grades = $my_grades يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
        $data['parents'] = My_Parent::all(); // parents = $parents يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
        $data['Genders'] = Gender::all(); // Genders = $Genders يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
        $data['nationals'] = Nationality::all(); // nationals = $nationals يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
        $data['bloods'] = Type_Blood::all(); // bloods = $bloods يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
        return view('pages.Students.edit',$data);

    }

// Update_Student
    public function Update_Student($request){

        try {
           $students = Student::findorfail($request->id);
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->update();
            toastr()->success(trans('messages.success_update'));
            return redirect()->route('Students.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

// delete_Student
    public function Delete_Student($request){
//         Student::findOrFail($request->id)->delete();

        Student::destroy($request->id);  // destroy(1,2,3,.....etc) ممكن يمسح array اكتر من حاجه
        toastr()->error(trans('messages.success_delete'));
        return redirect()->route('Students.index');

    }
// Create_Student
   public function Create_Student(){

       $data['my_grades'] = Grade::all();  // my_grades = $my_grades يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
       $data['parents'] = My_Parent::all(); // parents = $parents يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
       $data['Genders'] = Gender::all(); // Genders = $Genders يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
       $data['nationals'] = Nationality::all(); // nationals = $nationals يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
       $data['bloods'] = Type_Blood::all(); // bloods = $bloods يعتبر هو المتغير بتاعي اللي هستخدمه فال .blade
       return view('pages.Students.add',$data);
    }

    public function Get_classrooms($id){

        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        // بجيب ال id عشان احطه فال value واجيب الاسم عشان يختار منه من ال select
        return $list_classes;

    }

    //Get Sections
    public function Get_Sections($id){

        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
    }

    public function Store_Student($request)
    {

//        dd($request->all());

        DB::beginTransaction();    // بعرفه ان خلي بالك انت هنا هتحفظ ف جدولين مش جدول واحد
//        DB::transaction(function () use ($request) {
        try {

            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $newPhoto = time() . $file->getClientOriginalName(); // getClientOriginalName بيفصلي ام الصوره عن الامتداد بتاعها
                    $file->move(public_path('attachments/students/' . $students->name), $newPhoto);

                    // insert in image_table
                    $images = new Image();
                    $images->filenameg = 'attachments/students/' . $students->name . '/'. $newPhoto;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }

          // طيب ما هوه صح كدة لو لاقي صوره هينفذ حفظ صوره ملقاش هيطلع ايرو بس الكود مش مترتب صح ارفع الكودج على الجت وهشوفها من عندي افضل علشان اعرف ترتيب الكود الي انت ماشي بيه عامل ازاي


            DB::commit();  //  لو كل امورك كانت تمام احفظلي بقا فالداتابيز

            toastr()->success(trans('messages.success_create'));
            return redirect()->route('Students.create');
        } catch (\Exception $e){
            DB::rollBack();  // لو مش تمام امسحلي بقا اللي عملته دا اتراجع عنه
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Upload_attachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $newPhoto = time() . $file->getClientOriginalName(); // getClientOriginalName بيفصلي ام الصوره عن الامتداد بتاعها
            $file->move(public_path('attachments/students/' . $request->student_name), $newPhoto);

            // insert in image_table
            $images= new image();
            $images->filename = 'attachments/students/' . $request->student_name . '/'. $newPhoto;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        toastr()->success(trans('messages.success_upload'));
        return redirect()->route('Students.show',$request->student_id);
    }


    public function Delete_attachment($request)
    {
        // Delete img in server disk

        $image = Image::where('id', $request->id)->where('filename',$request->filename)->first();  // product => this function in Model Category

        if($image->filename) {
//            Storage::disk('public_uploads')->deleteDirectory($category->slug); // delete this folder of image for slug
            // طريقه اخري
            $path = $image->filename;
            if(File::exists($path)) {
                File::delete($path); // delete path from public uploads  (delete this image for path)
            }
        }
        // Delete in data
        $image->delete();
        toastr()->error(trans('messages.success_delete'));
        return redirect()->route('Students.show',$request->student_id);
    }

}
