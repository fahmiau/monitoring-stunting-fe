<?php

use App\Http\Controllers\ArticleController;
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
Route::post('/add-new',[UserController::class,'addNew']);

Route::get('/report',[ReportController::class,'viewReport']);
Route::get('/detail-anak/{id}',[ReportController::class,'viewChildrenDetail']);

Route::get('/list-article',[ArticleController::class,'index']);
Route::get('/edit-article/{id}',[ArticleController::class,'show']);
Route::get('/new-article',[ArticleController::class,'addNew']);
Route::post('/add-new',[ArticleController::class,'store']);
Route::post('/update-article',[ArticleController::class,'update']);


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
