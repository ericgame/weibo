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
Route::get('signup','UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

//確認信的確認連結
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//追蹤
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');




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