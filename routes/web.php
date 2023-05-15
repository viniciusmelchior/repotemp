<?php

use App\Http\Controllers\PerfilAcessoController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/perfilAcesso', [PerfilAcessoController::class, 'index'])->name('perfilAcesso.index');
    Route::post('/perfilAcesso', [PerfilAcessoController::class, 'update'])->name('perfilAcesso.update');
    Route::get('/perfilAcesso/show/{id}', [PerfilAcessoController::class, 'show'])->name('perfilAcesso.show');
});
