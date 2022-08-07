<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ChildrenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteAction;
use Symfony\Component\Routing\Route as RoutingRoute;
use Symfony\Component\Routing\Router;

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

Route::get('/',[UserController::class,'dashboardView'])->name('dashboard');

Route::get('/login',[UserController::class,'loginView'])->name('login');
Route::post('/login',[UserController::class,'login']);
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::get('/list-account',[UserController::class,'viewAccounts'])->name('viewAccount');
Route::get('/add-new',[UserController::class,'addView']);
Route::get('/account/mother/{mother_id}',[UserController::class,'showAccount']);
Route::post('/account/mother/update',[UserController::class, 'motherUpdate']);
Route::post('/add-new',[UserController::class,'addNew']);

Route::get('/children/add/{mother_id}',[ChildrenController::class,'addChildren']);
Route::post('/children/add/store',[ChildrenController::class,'store']);
Route::post('/children/update',[ChildrenController::class,'update']);
Route::get('/children/detail/{id}',[ReportController::class,'viewChildrenDetail']);

Route::get('/report',[ReportController::class,'viewReport']);

Route::get('/article/list',[ArticleController::class,'index']);
Route::get('/article/published',[ArticleController::class,'articleShowPublished']);
Route::get('/article/published/{slug}',[ArticleController::class,'articleShow']);
Route::get('/article/create',[ArticleController::class,'create']);
Route::get('/article/edit/{slug}',[ArticleController::class,'show'])->name('articleEdit');
Route::get('/article/delete/{slug}',[ArticleController::class,'delete']);
Route::post('/article/store',[ArticleController::class,'store']);
Route::post('/article/update/{slug}',[ArticleController::class,'update']);
Route::post('/article/image-upload',[ArticleController::class,'uploadImage']);

// Route::get('/childrens/kelurahan/{id}',[ChildrenController::class,'getByKelurahan']);
// Route::get('/childrens/kecamatan/{id}',[ChildrenController::class,'getByKecamatan']);
// Route::get('/childrens/kota_kabupaten/{id}',[ChildrenController::class,'getByKotaKabupaten']);
// Route::get('/childrens/provinsi/{id}',[ChildrenController::class,'getByProvinsi']);

Route::get('/childrens/{type}/{id}',[ChildrenController::class,'getChildrens']);
Route::get('/status-stunting/{type}/{id}',[ChildrenController::class,'getStatusStunting']);

// Route::get('/article',[ReportController::class,'viewReport']);

// Route::get('/report', function (){
//     return view('report/report');
// });

Route::get('/daftar-akun', function (){
    return view('account/listAccount');
});

Route::get('/daftar-artikel', function (){
    return view('article/articleManager');
});

Route::get('/article', function (){
    return redirect()->route('dashboard');
});
