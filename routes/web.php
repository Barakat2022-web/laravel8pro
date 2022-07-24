<?php

use App\Http\Controllers\Ajax\StudentController as AjaxStudentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FluentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeContoller;
use App\Http\Controllers\ZipController;
use Illuminate\Support\Facades\App;
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




Route::get('/',[WelcomeContoller::class,'fruits']);

    Route::get('/welcome/{name?}',[WelcomeContoller::class,'index'])->name('welcome.index');



/*Start API Controller */

Route::get('posts',[ClientController::class,'getAllPost'])->name('client.posts');

Route::get('posts/{id}',[ClientController::class,'getPostById'])->name('posts.getpostbyid');
Route::get('AddPost',[ClientController::class,'addPost'])->name('posts.add');

Route::get('updatePost',[ClientController::class,'updatePost'])->name('posts.update');

Route::get('DeletePost/{id}',[ClientController::class,'deletePost'])->name('posts.delete');

/*End API Controller */


//Start Fluent Controller
Route::get('fluent-string',[FluentController::class,'index'])->name('fluent.index');
Route::get('fluent-replace',[FluentController::class,'replaceString'])->name('fluent.replaceString');

//End Fluent Controller

Route::get('user',[UserController::class,'index']);

//Route::get('login',[UserController::class,'getLoginForm'])->name('login.index')->middleware('CheckUser');
//Route::post('login',[UserController::class,'loginSubmit'])->name('login.submit');

Route::get('session/get',[WelcomeContoller::class,'getSessionData'])->name('session.get');
Route::get('session/set',[WelcomeContoller::class,'storeSessionData'])->name('session.store');
Route::get('session/delete',[WelcomeContoller::class,'deleteSessionData'])->name('session.delete');

Route::get('posts',[PostController::class,'getAllPost'])->name('posts');

Route::get('add-post',[PostController::class,'addPost'])->name('post.add');
Route::post('add-post',[PostController::class,'addPostSubmit'])->name('post.submit');

Route::get('posts/{id}',[PostController::class,'getPostById'])->name('post.getbyid');
Route::get('delete-post/{id}',[PostController::class,'DeletePost'])->name('post.delete');
Route::get('edit-post/{id}',[PostController::class,'editPost'])->name('post.edit');
Route::post('update-posts',[PostController::class,'UpdatePost'])->name('post.update');

Route::get('export-data',[PostController::class,'ExportData'])->name('post.export');


//route for view inheritance and blade extends

Route::get('home',function(){
    return view('index');
});



Route::get('upload',[UserController::class,'getUploadPage'])->name('user.upload');
Route::post('UploadForm',[UserController::class,'uploadFile'])->name('user.UploadForm');
Route::get('contact',[UserController::class,'allUsers']);

Route::get('send-email',[MailController::class,'SendEmail']);

Route::resource('students',StudentController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('add-user',[UserController::class,'insertRecord']);
Route::get('/get-phone/{id}',[UserController::class,'fetchPhoneByUser']);

Route::get('/add-comment/{id}',[PostController::class,'addComment']);

Route::get('/getCommentsByPost/{id}',[PostController::class,'getCommentsByPost']);

Route::get('Add-Role',[RoleController::class,'addRole']);

Route::get('add-users',[RoleController::class,'addUser']);

Route::get('RoleUser/{user_id}',[RoleController::class,'getAllRolesByUser']);
Route::get('UserRole/{role_id}',[RoleController::class,'getAllUsersByRole']);

Route::get('export-excel',[StudentController::class,'exportIntoExcel'])->name('excel.export');

Route::get('export-csv',[StudentController::class,'exportIntoCSV'])->name('excel.csv');

Route::get('export-pdf',[StudentController::class,'ExportPDF'])->name('Export.PDF');
Route::get('import-form',[StudentController::class,'ImportStudent'])->name('excel.import');


Route::post('import',[StudentController::class,'import'])->name('student.import');
Route::get('autocomplete',[StudentController::class,'autocomplete'])->name('student.autocomplete');

Route::get('resize-image',[ImageController::class,'resizeImage']);
Route::post('resize-image',[ImageController::class,'resizeImageSubmit'])->name('image.resize');


Route::get('dropzone',[ImageController::class,'dropzone']);
Route::post('dropzone',[ImageController::class,'dropzoneStore'])->name('dropzone.store');


Route::get('gallery',[ImageController::class,'gallery']);

Route::get('editor',[EditorController::class,'editor']);

Route::get('contact-us',[ContactController::class,'contact']);
Route::post('send-message',[ContactController::class,'sendEmail'])->name('contact.send');

Route::get('get-name',[ContactController::class,'getFirstLastName']);

Route::get('zip',[ZipController::class,'zipFile']);

Route::get('employee',[EmployeeController::class,'index']);

/*  Ajax Route*/
Route::prefix('ajax')->group(function(){
    Route::get('student',[AjaxStudentController::class,'index']);
    
});

/**Ajax Route */
Route::get('student',[AjaxStudentController::class,'index'])->name('student.index');
Route::post('add-student',[AjaxStudentController::class,'AddStudent'])->name('student.add');
