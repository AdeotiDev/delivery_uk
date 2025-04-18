<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    // return view('welcome');

    return redirect('/app');
});


Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
Route::post('/admin/reports/download', [ReportController::class, 'download'])->name('admin.reports.download');
