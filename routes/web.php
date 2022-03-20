<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routes/web.php

Auth::routes();
// guest => يعني دا لسا مسجلش دخول
Route::group(['middleware' => ['guest']] , function (){  // اللي مش مسجل بس هو اللي هيوديه علي صقحه التسجيل
    Route::get('/', function()
    {
        return view('auth.login');
    });
});


// mCamera to multi language and open the latest language in website
Route::group(
    [   // بيجبلي اخر لغه انا كنت فاتح بيها الموقع دا لما اقفله واجي افتحه تاني من جديد => localeSessionRedirect
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth' ]  // دول اللي حطيتهم ف ملف ال kernel.php
    ], function(){

//    Route::get('/', function()
//    {
//        return view('dashboard');
//    });

    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Grades'] , function (){
        Route::resource('Grades', 'GradeController');
    });

    //============================== Classrooms ============================
    Route::group(['namespace' => 'Classrooms'] , function (){
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');

        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
    });

    //============================== Sections ============================

    Route::group(['namespace' => 'Sections'], function () {

        Route::resource('Sections', 'SectionController');

        Route::get('/classes/{id}', 'SectionController@getclasses');
    });

    //============================== Parents ============================
    Route::view('add_parent' ,'livewire.show_Form');

    //============================== Teachers ============================
    Route::group(['namespace' => 'Teachers'], function () {
    Route::resource('Teachers' ,'TeacherController');
    });

    //============================== Students ============================
    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Students' ,'StudentController');
        Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
        Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');

        Route::resource('Promotion', 'PromotionController');
        Route::resource('Graduated', 'GraduatedController');

//Accounts
        Route::resource('Fees_Invoices', 'FeeInvoiceController');
        Route::get('Get_amount/{id}', 'FeeInvoiceController@Get_amount');
        Route::resource('Fees', 'FeesController');
        Route::resource('receipt_students', 'ReceiptStudentsController');
        Route::resource('ProcessingFee', 'ProcessingFeeController');
    });

});




