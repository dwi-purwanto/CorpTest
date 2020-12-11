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

Route::get('/test_logic', function() {
    return view('test_logic');
});
Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('images/{filename}', function ($filename)
    {
        $file = storage_path('app/company/'.$filename);

        return response()->file($file);
    })->name('company.logo');

    // Companies
    Route::group(['prefix' => 'companies'], function () {
        Route::get('/', 'company\CompanyController@index')->name('company.index');
        Route::get('/allCompanies', 'company\CompanyController@getAllIdName')->name('company.getIdName');
        Route::post('/', 'company\CompanyController@store')->name('company.store');
        Route::post('/show', 'company\CompanyController@show')->name('company.show');
        Route::put('/update', 'company\CompanyController@update')->name('company.update');
        Route::delete('delete/{id}', 'company\CompanyController@destroy')->name('company.delete');
    });

    // employees
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', 'employee\EmployeeController@index')->name('employee.index');
        Route::post('/', 'employee\EmployeeController@store')->name('employee.store');
        Route::post('/show', 'employee\EmployeeController@show')->name('employee.show');
        Route::put('/update', 'employee\EmployeeController@update')->name('employee.update');
        Route::delete('delete/{id}', 'employee\EmployeeController@destroy')->name('employee.delete');

    });


});
