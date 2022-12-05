<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DependienteController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\DepartamentoController;

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



Route::get('/', [EmpleadoController::class, 'index']);

Route::post('agregarEmpleado', [EmpleadoController::class, 'agregar']);
Route::post('modificarEmpleado', [EmpleadoController::class, 'modificar']);
Route::post('eliminarEmpleado', [EmpleadoController::class, 'eliminar']);

Route::get('/departamento', [DepartamentoController::class, 'index']);

Route::post('agregarDepartamento', [DepartamentoController::class, 'agregar']);
Route::post('modificarDepartamento', [DepartamentoController::class, 'modificar']);
Route::post('eliminarDepartamento', [DepartamentoController::class, 'eliminar']);

Route::get('/puesto/{id}', [PuestoController::class, 'index']);

Route::post('agregarPuesto', [PuestoController::class, 'agregar']);
Route::post('modificarPuesto', [PuestoController::class, 'modificar']);
Route::post('eliminarPuesto', [PuestoController::class, 'eliminar']);

Route::get('/dependiente/{id}', [DependienteController::class, 'index']);

Route::post('agregarDependiente', [DependienteController::class, 'agregar']);
Route::post('modificarDependiente', [DependienteController::class, 'modificar']);
Route::post('eliminarDependiente', [DependienteController::class, 'eliminar']);