<?php

use App\Livewire\Home;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
