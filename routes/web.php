<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuickLinkController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DepartmentController as AdminDepartmentController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\Admin\QuickLinkController as AdminQuickLinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PublicAnnouncementController;
use App\Http\Controllers\PublicDirectoryController;
use App\Http\Controllers\PublicDocumentController;
use App\Http\Controllers\AnnouncementAttachmentController;
use App\Http\Controllers\PublicQuickLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'landing'])->name('home');

Route::get('/public/announcements', [PublicAnnouncementController::class, 'index'])->name('public.announcements');
Route::get('/public/documents', [PublicDocumentController::class, 'index'])->name('public.documents');
Route::get('/public/documents/{document}', [PublicDocumentController::class, 'show'])->name('public.documents.show');
Route::get('/public/documents/{document}/download', [PublicDocumentController::class, 'download'])->name('public.documents.download');
Route::get('/public/directory', [PublicDirectoryController::class, 'index'])->name('public.directory');
Route::get('/public/links', [PublicQuickLinkController::class, 'index'])->name('public.links');
Route::get('/announcement-attachments/{attachment}/download', [AnnouncementAttachmentController::class, 'download'])->name('announcement-attachments.download');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('documents', DocumentController::class);
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/directory', [DirectoryController::class, 'index'])->name('directory.index');
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/links', [QuickLinkController::class, 'index'])->name('links.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('announcements', AdminAnnouncementController::class)->except(['show']);
    Route::resource('links', AdminQuickLinkController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('employees', AdminEmployeeController::class);
    Route::resource('departments', AdminDepartmentController::class);
    Route::resource('categories', AdminCategoryController::class);
});

require __DIR__.'/auth.php';
