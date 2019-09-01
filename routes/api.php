<?php

use Illuminate\Http\Request;

Route::prefix('v1')->namespace('Api')->group(function () {
  Route::resource('clients', 'Clients\ClientController')->except(['create', 'edit']);
});
