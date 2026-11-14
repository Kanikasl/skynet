<?php

use App\Livewire\Clientes;
use App\Livewire\Cuentas;
use Illuminate\Support\Facades\Route;

Route::get('/', Clientes::class);
Route::get('/cuentas', Cuentas::class);