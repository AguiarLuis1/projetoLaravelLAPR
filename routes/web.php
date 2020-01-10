<?php

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
//form to contact
Route::get('/contact', 'ContactFormController@create')->name('contact.create')->middleware('auth');

//submit contact
Route::post('/contact', 'ContactFormController@store')->name('contact.store')->middleware('auth');

//show all books
Route::get('/', 'BooksController@showAll');

//show one book
Route::get('/book/{id}', 'BooksController@view');

//insert
Route::post('/book', 'BooksController@store')->name('books.store')->middleware('auth');

//delete book
Route::delete('/book/{id}', 'BooksController@delete')->name('books.delete')->middleware('auth');

//Get form to update
Route::get('/book/{id}/edit', 'BooksController@edit')->name('books.edit')->middleware('auth');

//Update
Route::put('/book/{id}/edit', 'BooksController@editSubmit')->name('books.update')->middleware('auth');

//show my books
Route::get('/mybooks', 'BooksController@showMyBooks')->name('books.mybooks')->middleware('auth');

Route::get('/create', 'BooksController@create')->name('books.create')->middleware('auth');

Auth::routes();
