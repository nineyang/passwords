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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/welcome', 'WelcomeController@index')->name('home');

Route::group(['prefix' => 'user'], function () {
    Route::get('/email/verify', 'AccountController@verifyEmail')->name('email.verify');
});

## 如需使用checkData，传递的参数需要按照model的第一个字母+id的形式，例如b_id
Route::group(['prefix' => 'boxes'], function () {

    # 新增
    Route::post('/', 'BoxController@add');

    Route::get('/deleted/passwords', 'PasswordController@deletedList');

    Route::group(['middleware' => 'checkData:box'], function () {
        # 查看
        Route::get('/{b_id}', 'BoxController@detail');
        # 更新
        Route::put('/{b_id}', 'BoxController@update');
        # 删除
        Route::delete('/{b_id}', 'BoxController@delete');

        # 获取所有passwords
        Route::get('/{b_id}/passwords', 'PasswordController@passwordList');
        # 新增password
        Route::post('/{b_id}/passwords', 'PasswordController@add');

        Route::group(['middleware' => 'checkData:password'], function () {
            # 查看
            Route::get('/{b_id}/passwords/{p_id}', 'PasswordController@detail');
            # 更新
            Route::put('/{b_id}/passwords/{p_id}', 'PasswordController@update');
            # 删除
            Route::delete('/{b_id}/passwords/{p_id}', 'PasswordController@delete');

            # 查看密码
            Route::get('/{b_id}/passwords/{p_id}/password', 'PasswordController@getPassword');
        });

        # 恢复password
        Route::put('/{b_id}/passwords/{p_id}/restore', 'PasswordController@restore');

        # 发送查看密码的请求
        Route::get('/{b_id}/passwords/{p_id}/email/code', 'PasswordController@sendMailCode');

    });

});


Route::group(['prefix' => 'tools'], function () {

    Route::get('/password/rand', 'ToolController@getRandPassword');

});
