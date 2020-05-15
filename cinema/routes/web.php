<?php


Route::get('/', 'ControllerMovie@show');
Route::get('/showMovie/{id}', 'ControllerMovie@showCurrentMovie');
// Route::post'/buyTicket/{id}', 'ControllerMovie@registerForMovie');
Route::get('/registerMovie/{id}', 'ControllerMovie@registerForMovie');

Route::post('/user/{id}/buyTicket', 'ControllerMovie@buyTicket')->name('buyTicket');


Auth::routes(); //loading the login,register routes

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/{id}/profile', 'ProfileController@showProfile')->name('profile');
Route::get('/user/{id}/tickets', 'TicketsListController@showTickets')->name('tickets');
Route::get('/tickets/pdf', 'TicketsListController@exportTickets')->name('export');

Route::post('/user/{id}/profileUpdate', 'ProfileController@updateProfile')->name('profileUpdate');

Route::get('/user/{id}/ticketDelete/{ticketId}', 'TicketsListController@deleteTicket')->name('ticketDelete');
Route::post('/user/{id}/ticketUpdate/{ticketId}', 'TicketsListController@updateTicket')->name('ticketUpdate');

Route::get('/addMovies', 'AdminController@show')->name('addMovies');
Route::get('/users/excel','AdminController@showExportUsers')->name('exportToExel');
Route::get('/export/{type}','AdminController@Export');
Route::post('/addMovies', 'AdminController@movieUploadPost')->name('addMoviesPost');
