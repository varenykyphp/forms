<?php


use App\Http\Kernel;
use Illuminate\Support\Facades\Route;
use VarenykyForm\Http\Controllers\FormController;

Route::prefix(config('varenyky.path'))->name('admin.')->middleware(resolve(Kernel::class)->getMiddlewareGroups()['web'])->group(function () {
Route::resource('/forms',FormController::class);
});