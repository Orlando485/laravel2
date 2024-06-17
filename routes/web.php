<?php

use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/perfiles', [PerfilesController::class, 'index'])->name('perfiles.index');
Route::get('/perfiles/create', [PerfilesController::class, 'create'])->name('perfiles.create');
Route::post('/perfiles', [PerfilesController::class, 'store'])->name('perfiles.store');
Route::get('/perfiles/{perfil}/edit', [PerfilesController::class, 'edit'])->name('perfiles.edit');
Route::put('/perfiles/{perfil}', [PerfilesController::class, 'update'])->name('perfiles.update');
Route::delete('/perfiles/{perfil}', [PerfilesController::class, 'destroy'])->name('perfiles.destroy');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

Route::get('/facturas', [FacturasController::class, 'index'])->name('facturas.index');
Route::get('/facturas/create', [FacturasController::class, 'create'])->name('facturas.create');
Route::post('/facturas', [FacturasController::class, 'store'])->name('facturas.store');
Route::get('/facturas/{factura}/edit', [FacturasController::class, 'edit'])->name('facturas.edit');
Route::put('/facturas/{factura}', [FacturasController::class, 'update'])->name('facturas.update');
Route::delete('/facturas/{factura}', [FacturasController::class, 'destroy'])->name('facturas.destroy');

Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::get('/carrito', [CarritoController::class, 'show'])->name('carrito');
Route::get('/carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito-agregar');
Route::get('/carrito/borrar/{id}', [CarritoController::class, 'destroy'])->name('carrito-borrar');
Route::get('/carrito/vaciar', [CarritoController::class, 'trash'])->name('carrito-vaciar');
Route::get('/carrito/actualizar/{id}/{cantidad?}', [CarritoController::class, 'update'])->name('carrito-actualizar');
Route::get('/ordenar', [CarritoController::class, 'guardarPedido'])->name('ordenar');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
