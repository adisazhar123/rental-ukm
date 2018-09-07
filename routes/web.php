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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/inventaris', 'AdminController@inventaris')->name('inventaris');
Route::get('/log', 'AdminController@bukuBesar')->name('bukuBesar');
Route::get('/report', 'AdminController@report')->name('report');
Route::get('/report/kas/{tahun}/{bulan}', 'PdfController@getPdfKas');
Route::get('/report/kas/download/{tahun}/{bulan}', 'PdfController@downloadPdfKas');
Route::get('/report/invoices/{tahun}/{bulan}', 'PdfController@getPdfInvoices');
Route::get('/report/invoices/download/{tahun}/{bulan}', 'PdfController@downloadPdfInvoices');
Route::get('/log/get-kas', 'AdminController@getKas')->name('get.kas');
Route::delete('/log/delete', 'AdminController@deleteKas')->name('log.deleteKas');
Route::post('/log/edit', 'AdminController@editKas')->name('log.editKas');
Route::post('/log/masuk', 'AdminController@pemasukan')->name('log.pemasukan');
Route::post('/log/keluar', 'AdminController@pengeluaran')->name('log.pengeluaran');
Route::post('/add/barang', 'AdminController@addProduct')->name('add.new.product');
Route::delete('/delete/barang', 'AdminController@deleteProduct')->name('delete.product');
Route::get('/find/barang', 'AdminController@findProduct')->name('find.product');
Route::put('/update/barang', 'AdminController@updateProduct')->name('update.product');
Route::get('/login', function(){
  return view('login');
});
Route::get('/transaksi', 'AdminController@transaksiPage')->name('transaksi');
Route::post('/transaction', 'AdminController@newTransaction')->name('new.transaction');
Route::get('/lihat/nota/{id}', 'AdminController@invoice');
Route::get('/nota', function(){
  return view('pdf.invoice');
});
