<?php

use App\Http\Controllers\PRController;
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

//Login
Route::get('/', function () {
    return view('auth.login');
});

//Auth
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware(['approved', 'auth']);

//User 
Route::get('/approval', 'UserController@approval')->name('user.approval');
Route::patch('/user/reset', 'UserController@reset')->name('user.reset');
Route::post('/user/approved/{user}', 'UserController@approved')->name('user.approved');
Route::post('/user/unapproved', 'UserController@unapproved')->name('user.unapproved');
Route::delete('/user/destroy', 'UserController@destroy')->name('user.destroy');
Route::resource('user', 'UserController', [
    'except' => ['show', 'destroy']
]);

//PR
Route::get('/pr/history/import', 'PRController@import_pr_history')->name('import_pr_history');
Route::get('/pr/file/{importpr}', 'PRController@pr_file_download')->name('pr_file_download');
Route::get('/pr/view/import', 'PRController@import_pr_view')->name('import_pr_view');
Route::post('/pr/import', 'PRController@import_pr')->name('import_pr');
Route::delete('/pr/destroy', 'PRController@destroy')->name('pr.destroy');
Route::resource('pr', 'PRController', [
    'except' => ['destroy']
]);

//Migrasi
Route::get('/list/history/migrasi', 'POController@migrasi_list_history')->name('migrasi_list_history');
Route::get('/list/file/{migrasi}', 'POController@list_file_download')->name('list_file_download');
Route::get('/list/view/migrasi', 'POController@migrasi_list_view')->name('migrasi_list_view');
Route::post('/list/migrasi', 'POController@migrasi_list')->name('migrasi_list');

//PO
Route::get('/po/history/import', 'POController@import_po_history')->name('import_po_history');
Route::get('/po/file/{importpo}', 'POController@po_file_download')->name('po_file_download');
Route::get('/po/view/import', 'POController@import_po_view')->name('import_po_view');
Route::post('/po/import', 'POController@import_po')->name('import_po');
Route::get('po/create/{po}', 'POController@create')->name('po.create');
Route::post('po/store/{po}', 'POController@store')->name('po.store');
Route::resource('po', 'POController', [
    'except' => ['create', 'store', 'destroy']
]);

//json PR
Route::get('/rekananjson', 'RekananController@json')->name('rekananjson');

//json PO
Route::get('/pojson', 'POController@json')->name('pojson');

//Unit
Route::post('/unit/store2', 'UnitController@store2')->name('unit.store2');
Route::patch('/unit/update', 'UnitController@update')->name('unit.update');
Route::delete('/unit/destroy', 'UnitController@destroy')->name('unit.destroy');
Route::resource('unit', 'UnitController', [
    'except' => ['show', 'update', 'destroy']
]);


//Status
Route::post('/status/store2', 'StatusController@store2')->name('status.store2');
Route::patch('/status/update', 'StatusController@update')->name('status.update');
Route::delete('/status/destroy', 'StatusController@destroy')->name('status.destroy');
Route::resource('status', 'StatusController', [
    'except' => ['show', 'update', 'destroy']
]);

//Rekanan
Route::get('/rekanan/history/import', 'RekananController@import_vendor_history')->name('import_vendor_history');
Route::get('/rekanan/file/{importv}', 'RekananController@vendor_file_download')->name('vendor_file_download');
Route::get('/rekanan/view/import', 'RekananController@import_vendor_view')->name('import_vendor_view');
Route::post('/rekanan/import', 'RekananController@import_vendor')->name('import_vendor');
Route::get('/rekanan/dashboard', 'RekananController@dashboard')->name('rekanan.dashboard');
Route::get('/rekanan/pelayanan', 'RekananController@pelayanan')->name('rekanan.pelayanan');
Route::delete('/rekanan/destroy', 'RekananController@destroy')->name('rekanan.destroy');
Route::resource('rekanan', 'RekananController', [
    'except' => ['destroy'],
]);

//Punishment
Route::delete('/punishment/destroy', 'PunishmentController@destroy')->name('punishment.destroy');
Route::resource('punishment', 'PunishmentController', [
    'except' => ['destroy']
]);

//Presentasi
Route::get('/presentasi/company_profile/{presentasi}', 'PresentasiController@company_profile')->name('presentasi.company_profile');
Route::get('/presentasi/katalog/{presentasi}', 'PresentasiController@katalog')->name('presentasi.katalog');
Route::get('/presentasi/surat_permohonan/{presentasi}', 'PresentasiController@surat_permohonan')->name('presentasi.surat_permohonan');
Route::get('/presentasi/pengalaman_kerja/{presentasi}', 'PresentasiController@pengalaman_kerja')->name('presentasi.pengalaman_kerja');
Route::delete('/presentasi/destroy', 'PresentasiController@destroy')->name('presentasi.destroy');
Route::patch('/presentasi/acc/{presentasi}', 'PresentasiController@acc')->name('presentasi.acc');
Route::resource('presentasi', 'PresentasiController', [
    'except' => ['destroy']
]);

//Progress
Route::post('/progress/store2', 'ProgressController@store2')->name('progress.store2');
Route::patch('/progress/update', 'ProgressController@update')->name('progress.update');
Route::delete('/progress/destroy', 'ProgressController@destroy')->name('progress.destroy');
Route::resource('progress', 'ProgressController', [
    'except' => ['show', 'update', 'destroy']
]);

Route::patch('/sos/update', 'SoSController@update')->name('sos.update');
Route::delete('/sos/destroy', 'SoSController@destroy')->name('sos.destroy');
Route::resource('sos', 'SoSController', [
    'except' => ['show', 'update', 'destroy']
]);

Route::delete('/keluhan/destroy', 'KeluhanController@destroy')->name('keluhan.destroy');
Route::resource('keluhan', 'KeluhanController', [
    'except' => ['destroy']
]);

//Laporan
Route::get('/laporan/pengadaanjasa', 'LaporanController@pengadaan_jasa')->name('laporan.jasa');
Route::get('/laporan/distribusipemasaran', 'LaporanDPController@distribusi_pemasaran')->name('laporan.distribusi');
Route::get('/laporan/pabrik', 'LaporanPabrikController@pabrik')->name('laporan.pabrik');
Route::get('/laporan/nonpabrik', 'LaporanNonPabrikController@non_pabrik')->name('laporan.nonpabrik');
Route::get('/laporan/investasi_epc', 'LaporanEPCController@investasi_epc')->name('laporan.investasi');
Route::get('/laporan/keluhan', 'LaporanController@keluhan')->name('laporan.keluhan');



// Route::get('/approval', 'UserController@approval')->name('user.approval');
// Route::get('/user', 'UserController@user')->name('user');
// Route::post('/user/approved/{user}', 'UserController@approved')->name('user.approved');
// Route::delete('/user/rejected/{user}', 'UserController@rejected')->name('user.rejected');

//->middleware('role:Pengadaan Jasa')