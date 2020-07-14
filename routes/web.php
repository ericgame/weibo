<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

//首頁
Route::get('/', 'StaticPagesController@home')->name('home');

//幫助
Route::get('/help', 'StaticPagesController@help')->name('help');

//關於我們
Route::get('/about', 'StaticPagesController@about')->name('about');

//註冊
Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

//登入
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');

//登出
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//確認信的確認連結
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//忘記密碼
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//文章新增與刪除
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

//追蹤
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');

//關注
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');

//取消關注
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');


// TEST =========================================
/*
use App\Models\User;

Route::get('/sync', function(){
	$user = User::find(1);
	// $user->followings()->sync([1,2,3,4,5]);
	// $user->followings()->sync([1, 2=>['created_at'=>'2020-5-26','updated_at'=>NOW()], 3]);
	// $user->followings()->syncWithoutDetaching([1, 2, 3]);
	$user->followings()->sync([1, 2, 3], false);

	return 'Success';
});

Route::get('/attach', function(){
	$user = User::find(1);
	$user->followings()->attach([1,2,3,4]);
	
	return 'Success';
});

Route::get('/detach', function(){
	$user = User::find(1);
	$user->followings()->detach();
	
	return 'Success';
});
*/