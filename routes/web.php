<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('escola.showEscola');
});

Route::get('/empresa', function () {
   return view('empresa');
});

Route::get('/produto',[ProdutoController::class, 'index']
);
