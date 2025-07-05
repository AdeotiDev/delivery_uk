<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', [HomeController::class, 'home'])->name('myhome');

Route::get('about', [AboutUsController::class, 'about'])->name('about');

Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
Route::post('/admin/reports/download', [ReportController::class, 'download'])->name('admin.reports.download');
Route::post('/admin/reports/download-excel', [ReportController::class, 'downloadExcel'])->name('admin.reports.download.excel');


Route::get('/logout', function () {
    return redirect('/');
});
