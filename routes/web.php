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

Route::get('/', 'PostsController@index')->name('posts.index');
//Laravel 內建登入、註冊、忘記密碼
Auth::routes();
//Lavavel內建登入頁面
Route::get('/home', 'HomeController@index')->name('home');

//文章路由


//因為index 會重複使用 所以使用 group 做網址 分組
//prefix => posts 表示 localhost/post/...
Route::group(['prefix' => 'posts'], function () {
    //列表頁
    Route::get('index', 'PostsController@index')->name('posts.index');

    //列表頁 - 查詢排序 範例版本
    Route::get('index_example', 'PostsController@index_example')->name('posts.index_example');

    //文章排序-舊->新
    Route::get('index/old','PostsController@postsSortByOld')->name('posts.SortByOld');

    //文章排序-新->舊
    Route::get('index/new','PostsController@postsSortByNew')->name('posts.SortByNew');

    //文章排序-更新時間-新->舊
    Route::get('index/update','PostsController@postsSortByUpdate')->name('posts.SortByUpdate');

    //文章搜尋
    Route::get('index/search','PostsController@postsSearch')->name('posts.search');

    //新增頁
    Route::get('create', 'PostsController@create')->name('posts.create');
    //儲存邏輯
    Route::post('store', 'PostsController@store')->name('posts.store');
    //編輯頁
    Route::get('edit/{id}', 'PostsController@edit')->name('posts.edit');
    //更新邏輯
    Route::put('update/{id}', 'PostsController@update')->name('posts.update');
    //預覽頁
    Route::get('show/{id}', 'PostsController@show')->name('posts.show');
    //刪除邏輯
    Route::delete('delete/{post_id}', 'PostsController@delete')->name('posts.delete');

    //回復文章
    Route::get('show/{id}/repost', 'PostsController@repost')->name('posts.re');

    //儲存回復文章
    Route::post('re_store', 'PostsController@re_store')->name('posts.re_store');

    //編輯回復文章 兩個id 一個是原文章id 一個是回文章id class不一樣
    Route::get('show/{id}/edit/{repost_id}','PostsController@re_edit')->name('posts.re_edit');

    //編輯回復文章,儲存邏輯
    Route::put('show/{id}/re_update/{repost_id}','PostsController@re_update')->name('posts.re_update');

    //回覆文章刪除
    Route::put('show/{id}/delete{repost_id}','Postscontroller@re_delete')->name('posts.re_delete');
});



//測試串接外部api 使用 guzzle
Route::group(['prefix'=>'guzzle'],function (){
    Route::get('index','GuzzleController@index')->name('guzzle.index');
    Route::get('example_index','GuzzleController@example_index')->name('guzzle.example_index');
});


//預約系統
Route::group(['prefix'=>'reserve'],function (){
    Route::get('index','ReserveController@index')->name('reserve.index');
    //預約儲存邏輯
    Route::post('create','ReserveController@create')->name('reserve.create');
    //查看預約歷史紀錄
    Route::get('history/{user_id}','ReserveController@history')->name('reserve.history');
    //取消預約
    Route::put('history/{user_id}/cancel{reserve_id}','ReserveController@cancel')->name('reserve.cancel');
});


//測試 route
/*Route::get('/news','NewsController@index');
Route::get('/news/{id}','NewsController@show_id');
Route::resource('news','NewsController');
Route::get('/hello','NewsController@hello');*/


//預約系統
Route::group(['prefix'=>'reserve_example'],function (){
    Route::get('index','Reserve_ExampleController@index')->name('reserve_example.index');
    //預約儲存邏輯
    Route::post('create','Reserve_ExampleController@create')->name('reserve_example.create');
    //查看預約歷史紀錄
    Route::get('history/{user_id}','Reserve_ExampleController@history')->name('reserve_example.history');
});


//Excel test
Route::group(['prefix'=>'excel'],function (){
    //allReserve export
    Route::get('export','ExcelController@allReserveExport')->name('excel.export');
    //userhistory export 只匯出user_id的資料
    Route::get('export/{user_id}','ExcelController@userIdReserveExport')->name('excel.userexport');
    //userhistory csv export 只匯出user_id的資料
    Route::get('export/csv/{user_id}','ExcelController@csvUserIdReserveExport')->name('excel.userexport_csv');
    //import excel post
    Route::get('import/excel','ExcelController@excelImport')->name('excel.import');
    //import excel post create
    Route::post('import/excel/upload','ExcelController@excelImportUpload')->name('excel.importUpload');
});
