<?php

use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
// -------------------------------- Guest Routes --------------------------------
Route::group(['middleware'=>['guest']],function(){
    // +++++++++++++++++++ Login +++++++++++++++++++
    Route::get('/', function()
    {
        return view('auth.login');
    });
});
// -------------------------------- LaravelLocalization : Mcamara Routes --------------------------------
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]
    ], function()
    {
        // +++++++++++++++++++ Dashboard +++++++++++++++++++
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        // +++++++++++++++++++ Grades +++++++++++++++++++
        Route::group(['namespace' => 'Grades'],function(){
            Route::resource('Grades', 'GradeController');
        });
        // +++++++++++++++++++ Classes +++++++++++++++++++
        Route::group(['namespace' => 'Classrooms'],function(){
            Route::resource('Classrooms', 'ClassroomController');
            // Delete_All_Checkboxes
            Route::post('delete_all',[ClassroomController::class,'delete_all'])->name('delete_all');
            // Search_On_DataTable
            Route::post('Filter_Classes',[ClassroomController::class,'Filter_Classes'])->name('Filter_Classes');
        });
        // +++++++++++++++++++ Sections +++++++++++++++++++
        Route::group(['namespace' => 'Sections'],function(){
            Route::resource('Sections', 'SectionController');
            // Get "classrooms" of "selected option"
            Route::get('/classes/{id}', 'SectionController@getclasses');
        });
        // +++++++++++++++++++ Parents +++++++++++++++++++
        Route::view('add_parent', 'livewire.show-form');
    }
);

Auth::routes();
