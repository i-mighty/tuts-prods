<?php
use App\User;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id?}', function ($id=null){
	if($id == null){
		#Show me me
		$user = Auth::user();
	}else{
		$user = User::find($id);
	}
	return view('profile',['profileUser' => $user]);
})->middleware('auth');
Route::view('/contact', 'contact');
Route::get('courses/{course_id}/register', 'CourseController@register')->name('intro')->middleware('multi_auth');
Route::post('/course', 'CourseController@addRegistration')->name('course.register');
Route::resource('courses', 'CourseController');
Route::resource('courses/{course_id}/chapter', 'ChapterController');
Route::resource('courses/{course_id}/chapter/{chapter_id}/topic', 'TopicController');
Route::view('/about-us', 'about');
Route::post('/contact', 'MailinController@mailinSubmit')->name('submit-mailin');
Route::put('/profile/{user}/edit', 'HomeController@profile');
Route::prefix('admin')->group(function() {
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

