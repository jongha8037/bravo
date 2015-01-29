<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/*
Route::resource('/user', 'UserController');
Route::get('findpassword', function()
{
    return View::make('findpassword');
});
Route::post('findpassword', 'UserController@findPassword');
Route::post('findpassword', array('uses'=>'UserController@findPassword'));
Route::post('findpassword', array('uses' => 'RemindController@postRemind')); 

Route::get('password/reset/{token}', 'RemindController@getReset');
Route::post('password/reset/{token}', 'RemindController@postReset');
Route::controller('/', 'HomeController');
*/

Route::get('/', function()
{
    $users = Product::all();
    return View::make('index');//, ['users' => $users]);

});

Route::post('upload', 'UploadController@upload');

