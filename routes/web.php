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
Route::get('tickets', 'HomeController@buy_tickets')->name('tickets');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/create-tickets', 'AdminController@create_ticket')->name('create-tickets');
    Route::post('/update-ticket', 'AdminController@update_ticket')->name('update-ticket');
    Route::post('/delete-ticket', 'AdminController@delete_ticket')->name('delete-ticket');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/add_tickets', 'AdminController@add_tickets')->name('add_tickets');
Route::post('book_ticket', 'AdminController@book_ticket')->name('book_ticket');
