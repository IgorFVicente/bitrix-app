<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ContactsController;

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

Route::get(
    '/',
    [CompaniesController::class, 'list']
)->name('index');


Route::post(
    '/',
    [CompaniesController::class, 'list']
);


Route::get(
    '/companies/new',
    [CompaniesController::class, 'create']
);


Route::post(
    '/companies/new',
    [CompaniesController::class, 'store']
)->name('register_company');


Route::get(
    '/companies/list',
    [CompaniesController::class, 'list']
);


Route::post(
    '/companies/update/{ID}',
    [CompaniesController::class, 'update']
)->name('update_company');


Route::get(
    '/companies/edit/{ID}',
    [CompaniesController::class, 'edit']
);


Route::get(
    '/companies/delete/{ID}',
    [CompaniesController::class, 'remove']
)->name('remove_company');

Route::get(
    '/vue',
    [CompaniesController::class, 'vue']
);
