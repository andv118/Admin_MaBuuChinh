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

/*******************         TRANG CHỦ       *******************************/
Route::get('trangchu','TrangChu\HomeController@getIndex' )->name('home');

Route::get('searchMBC', 'TrangChu\HomeController@searchMBC');
Route::get('postSearch', 'TrangChu\HomeController@postSearch')->name('search');
Route::post('handleAjax', 'TrangChu\HomeController@handleAjax')->name('ajax');
Route::get('gioithieu','TrangChu\HomeController@getGt' )->name('gioithieu');
Route::get('vanban','TrangChu\HomeController@getVb' )->name('vanban');
Route::get('huongdan','TrangChu\HomeController@getHd' )->name('huongdan');
Route::group(['prefix' => 'mbc-english', 'as'=>'english.'], function () {
    Route::get('','TrangChu\HomeControllerE@getIndex' )->name('home');
    Route::get('searchMBC', 'TrangChu\HomeControllerE@searchMBC');
    Route::get('postSearch', 'TrangChu\HomeControllerE@postSearch')->name('search');
    Route::post('handleAjax', 'TrangChu\HomeControllerE@handleAjax')->name('ajax');
    Route::get('gioithieu','TrangChu\HomeControllerE@getGt' )->name('gioithieu');
    Route::get('vanban','TrangChu\HomeControllerE@getVb' )->name('vanban');
    Route::get('huongdan','TrangChu\HomeControllerE@getHd' )->name('huongdan');
});

Route::post('ajaxTinh','Admin\HandleAjax@ajaxTinh')->name('ajaxtinh');
Route::post('ajaxHuyen','Admin\HandleAjax@ajaxHuyen')->name('ajaxhuyen');
Route::post('ajaxSearch','Admin\HandleAjax@ajaxSearch')->name('ajaxSearch');



/*******************         ADMIN       *******************************/
Route::group(['prefix' => 'admin','as'=>'Admin.','namespace'=>'Admin','middleware'=>['checklogin']], function() {
    
    /******************     Tỉnh    ************************/
    Route::group(['prefix' => 'tinh'], function() {
        Route::get('','TinhController@getTinh')->name('tinh');
        Route::get('add','TinhController@addTinh')->name('add_tinh');
        Route::post('add','TinhController@PostaddTinh')->name('create_tinh');
        Route::get('edit/{id}','TinhController@editTinh')->name('edit_tinh');
        Route::post('edit/{id}','TinhController@postEditTinh')->name('update_tinh');
        Route::get('delete/{id}','TinhController@deleteTinh')->name('delete_tinh');
    });

    /******************     Huyện    ************************/
    Route::group(['prefix' => 'huyen'], function() {
        Route::get('','HuyenController@getHuyen')->name('huyen');
        Route::get('filter','HuyenController@getHuyenFilter')->name('huyen.fetch');
        // Route::get('','HuyenController@PostgetHuyen');
        Route::get('add','HuyenController@addHuyen')->name('add_huyen');
        Route::post('add','HuyenController@PostaddHuyen');  
        Route::get('edit/{id}','HuyenController@editHuyen')->name('edit_huyen');
        Route::post('edit/{id}','HuyenController@postEditHuyen');
        Route::get('delete/{id}','HuyenController@deleteHuyen')->name('delete_huyen');
    });

    /******************     Đối Tượng Gán Mã    ************************/
    Route::group(['prefix' => 'doi-tuong-gan-ma'], function() {
        Route::get('','AdminController@getDoiTuongGanMa')->name('doiTuongGanMa');
        Route::post('fetch_tinh','AdminController@dtgmGetTinhFetch')->name('doiTuongGanMa.fetch_tinh');
        // Route::get('','AdminController@PostgetHuyen');
        Route::get('add','AdminController@addHuyenChiTiet')->name('add_huyenchitiet');
        Route::post('add','AdminController@PostaddHuyenChiTiet');  
        Route::get('edit/{id}','AdminController@editHuyenChiTiet')->name('edit_huyenchitiet');
        Route::post('edit/{id}','AdminController@postEditHuyenChiTiet');
        Route::get('delete/{id}','AdminController@deleteHuyenChiTiet')->name('delete_huyenchitiet');
    });

     /******************     Index    ************************/
    Route::get('', 'AdminController@getindex')->name('index');
    Route::get('nhat-ky-hoat-dong', 'AdminController@diary')->name('diary')->middleware('CheckAdmin');
    
    
    /******************     Excel    ************************/
    Route::post('import-file-excel', 'AdminController@import_excel')->name('import_excel');
    Route::get('cap-nhat-file-excel', 'AdminController@import_excels')->name('import_excels');
    
    
    /******************     Account    ************************/
    Route::get('cai-dat-tai-khoan', 'AdminController@setting_account')->name('setting_account');
    Route::get('quan-ly-tai-khoan', 'AdminController@manage_account')->name('manage_account')->middleware('CheckAdmin'); 
    Route::get('tao-tai-khoan', 'AdminController@add_account')->name('add_account')->middleware('CheckAdmin');
    Route::post('tao-tai-khoan', 'AdminController@createAcc')->name('createAcc')->middleware('CheckAdmin');
    Route::post('cap-nhat-tai-khoan', 'AdminController@update_account')->name('update_account');
    Route::post('doi-mat-khau', 'AdminController@changePass')->name('changePass');
    Route::post('xoa-tai-khoan', 'AdminController@deleteAcc')->name('deleteAcc')->middleware('CheckAdmin');
    Route::post('cap-nhat-quyen', 'AdminController@updateRole')->name('updateRole')->middleware('CheckAdmin');
    Route::post('ajaxAccount', 'AdminController@getAcc')->name('getAcc')->middleware('CheckAdmin');
    Route::post('tim-kiem-tai-khoan', 'a;;dminController@searchAcc')->name('searchAcc')->middleware('CheckAdmin');
    Route::post('getHuyenById', 'AdminController@getHuyenById')->name('getHuyenById');
    Route::post('them-doi-tuong-gan-ma','AdminController@PostaddTinhChiTiet')->name('add_dtgm');

   
    
    Route::group(['prefix' => 'tinhchitiet'], function() {
        Route::get('','AdminController@getTinhChiTiet')->name('tinhchitiet');
        // Route::get('','AdminController@PostgetHuyen');
        Route::get('add','AdminController@addTinhChiTiet')->name('add_tinhchitiet');
        Route::post('add','AdminController@PostaddTinhChiTiet');  
        Route::get('edit/{id}','AdminController@editTinhChiTiet')->name('edit_tinhchitiet');
        Route::post('edit/{id}','AdminController@postEditTinhChiTiet');
        Route::get('delete/{id}','AdminController@deleteTinhChiTiet')->name('delete_tinhchitiet');
    });
    
    
    
});

/******************     Login    ************************/
Route::group(['middleware'=>['checklogout']], function () {
    Route::get('/','LoginControler@getLogin')->name('login');
    Route::post('/','LoginControler@postLogin');
});
Route::get('logout','LoginControler@getLogout')->name('logout');    



