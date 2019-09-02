<?php

use Illuminate\Http\Request;

Route::prefix('v1')->namespace('Api')->group(function () {
  Route::resource('clients', 'Clients\ClientController')->except(['create', 'edit']);
  Route::resource('sectors', 'Sectors\SectorController')->except(['create', 'edit']);
  Route::resource('responsibles', 'Responsibles\ResponsibleController')->except(['create', 'edit']);
  Route::resource('calls', 'Calls\CallController')->except(['create', 'edit']);
  Route::resource('histories', 'Calls\HistoryController')->except(['create', 'edit']);
});
