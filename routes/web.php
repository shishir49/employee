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

Route::get('/', function () {
    return view('welcome');
});

Route::get('employees-list','App\Http\Controllers\EmployeeController@index');
Route::get('employee/search','App\Http\Controllers\EmployeeController@searchEmployee');
Route::post('employee/add','App\Http\Controllers\EmployeeController@create');
Route::get('employee/update-data/{id}','App\Http\Controllers\EmployeeController@show');
Route::post('employee/update/{id}','App\Http\Controllers\EmployeeController@update');
Route::post('employee/delete-employee/{id}','App\Http\Controllers\EmployeeController@destroy');
Route::get('{path}','App\Http\Controllers\Master@index')->where( 'path', '.*' );
