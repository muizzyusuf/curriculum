<?php

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

Route::get('/', function () {
    return view('pages.landing');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/programs','ProgramController');
Route::get('/programs/{program}/submit','ProgramController@submit')->name('programs.submit');

Route::resource('/courses','CourseController');

Route::post('/courses/{course}/assign','CourseUserController@store')->name('courses.assign');
Route::delete('/courses/{course}/unassign','CourseUserController@destroy')->name('courses.unassign');
// Route::get('/courses/{course}/status','CourseController@status')->name('courses.status');
Route::get('/courses/{course}/submit','CourseController@submit')->name('courses.submit');
Route::get('/courses/{course}/summary','CourseController@show')->name('courses.summary');
Route::post('/courses/{course}/outcomeDetails','CourseController@outcomeDetails')->name('courses.outcomeDetails');
Route::get('/courses/{course}/pdf','CourseController@pdf')->name('courses.pdf');

Route::resource('/lo','LearningOutcomeController')->only(['store','update','edit', 'destroy']);

Route::resource('/plo','ProgramLearningOutcomeController');

Route::resource('/la','LearningActivityController');

Route::resource('/am','AssessmentMethodController');

Route::resource('/outcomeMap','OutcomeMapController');

Route::resource('/mappingScale','MappingScaleController');
Route::post('/mappingScale/default','MappingScaleController@default')->name('mappingScale.default');

Route::resource('/ploCategory','PLOCategoryController');

Route::resource('/programUser','ProgramUserController', ['except'=>'destroy']);
Route::delete('/programUser/{program}/{user}','ProgramUserController@delete')->name('programUser.destroy');


Route::get('/programWizard/{program}/step1','ProgramWizardController@step1')->name('programWizard.step1');
Route::get('/programWizard/{program}/step2','ProgramWizardController@step2')->name('programWizard.step2');
Route::get('/programWizard/{program}/step3','ProgramWizardController@step3')->name('programWizard.step3');
Route::get('/programWizard/{program}/step4','ProgramWizardController@step4')->name('programWizard.step4');

Route::get('/courseWizard/{course}/step1','CourseWizardController@step1')->name('courseWizard.step1');
Route::get('/courseWizard/{course}/step2','CourseWizardController@step2')->name('courseWizard.step2');
Route::get('/courseWizard/{course}/step3','CourseWizardController@step3')->name('courseWizard.step3');
Route::get('/courseWizard/{course}/step4','CourseWizardController@step4')->name('courseWizard.step4');
Route::get('/courseWizard/{course}/step5','CourseWizardController@step5')->name('courseWizard.step5');
Route::get('/courseWizard/{course}/step6','CourseWizardController@step6')->name('courseWizard.step6');

Auth::routes();
