<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\StepsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

  Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
  Route::get('/login', [AdminController::class, 'login_index'])->name('admin.login');
  Route::post('/login', [AdminController::class, 'login_action']);

  Route::prefix('/profile')->group(function () {

    Route::get('/', [AdminController::class, 'profile'])->name('admin.profile');

    Route::get('/activities', [AdminController::class, 'admin_activity_index'])->name('admin.activities');

    Route::get('/change-password', [AdminController::class, 'change_password_index'])->name('admin.change.password');
    Route::post('/change-password', [AdminController::class, 'change_password_action']);

    Route::get('/change-info', [AdminController::class, 'change_info_index'])->name('admin.change.info');
    Route::post('/change-info', [AdminController::class, 'change_info_action']);

    Route::get('/change-picture', [AdminController::class, 'change_picture_index'])->name('admin.change.picture');
    Route::post('/change-picture', [AdminController::class, 'change_picture_action']);

  });

  Route::prefix('articles')->group(function () {
    Route::get('/', [ArticlesController::class, 'index'])->name('admin.articles');

    Route::get('/stats', [ArticlesController::class, 'stats_index'])->name('admin.articles.stats');

    Route::get('/view/{id}', [ArticlesController::class, 'view_index'])->name('admin.articles.view');

    Route::get('/add', [ArticlesController::class, 'add_index'])->name('admin.articles.add');
    Route::post('/add', [ArticlesController::class, 'add_action']);

    Route::get('/update/{id}', [ArticlesController::class, 'update_index'])->name('admin.articles.update');
    Route::post('/update/{id}', [ArticlesController::class, 'update_action']);

    Route::get('/restore/{id}', [ArticlesController::class, 'restore_index'])->name('admin.articles.restore');
    Route::post('/restore/{id}', [ArticlesController::class, 'restore_action']);

    Route::get('/delete/{id}', [ArticlesController::class, 'delete_index'])->name('admin.articles.delete');
    Route::post('/delete/{id}', [ArticlesController::class, 'delete_action']);

    Route::get('/delete-all', [ArticlesController::class, 'delete_all_index'])->name('admin.articles.delete.all');
    Route::post('/delete-all', [ArticlesController::class, 'delete_all_action']);

    Route::get('/restore-all', [ArticlesController::class, 'restore_all_index'])->name('admin.articles.restore.all');
    Route::post('/restore-all', [ArticlesController::class, 'restore_all_action']);

  });

  Route::prefix('courses')->group(function () {
    Route::get('/', [CoursesController::class, 'index'])->name('admin.courses');

    Route::get('/{id}/lectures', [CoursesController::class, 'lectures_index'])->name('admin.courses.lectures');

    Route::get('/{course_id}/lectures/{lecture_id}', [CoursesController::class, 'lecture_view_index'])->name('admin.courses.lectures.view');

    Route::get('/delete/lecture/{lecture_id}', [CoursesController::class, 'delete_lecture_index'])->name('admin.courses.lectures.delete');
    Route::post('/delete/lecture/{lecture_id}', [CoursesController::class, 'delete_lecture_action']);

    Route::get('/update/{course_id}/lecture/{lecture_id}', [CoursesController::class, 'update_lecture_index'])->name('admin.courses.lectures.update');
    Route::post('/update/{course_id}/lecture/{lecture_id}', [CoursesController::class, 'update_lecture_action']);

    Route::get('/add', [CoursesController::class, 'add_index'])->name('admin.courses.add');
    Route::post('/add', [CoursesController::class, 'add_action']);

    Route::get('/add/{course_id}/video', [CoursesController::class, 'add_video_index'])->name('admin.courses.add.video');
    Route::post('/add/{course_id}/video', [CoursesController::class, 'add_video_action']);

    Route::get('/stats', [CoursesController::class, 'stats_index'])->name('admin.courses.stats');

    Route::get('/view/{id}', [CoursesController::class, 'view_index'])->name('admin.courses.view');

    Route::get('/update/{id}', [CoursesController::class, 'update_index'])->name('admin.courses.update');
    Route::post('/update/{id}', [CoursesController::class, 'update_action']);

    Route::get('/restore/{id}', [CoursesController::class, 'restore_index'])->name('admin.courses.restore');
    Route::post('/restore/{id}', [CoursesController::class, 'restore_action']);

    Route::get('/delete/{id}', [CoursesController::class, 'delete_index'])->name('admin.courses.delete');
    Route::post('/delete/{id}', [CoursesController::class, 'delete_action']);

    Route::get('/delete-all', [CoursesController::class, 'delete_all_index'])->name('admin.courses.delete.all');
    Route::post('/delete-all', [CoursesController::class, 'delete_all_action']);

    Route::get('/restore-all', [CoursesController::class, 'restore_all_index'])->name('admin.courses.restore.all');
    Route::post('/restore-all', [CoursesController::class, 'restore_all_action']);
  });

  Route::prefix('how-to')->group(function () {

    Route::get('/', [StepsController::class, 'index'])->name('admin.howto');

    Route::get('/add', [StepsController::class, 'add_index'])->name('admin.howto.add');
    Route::post('/add', [StepsController::class, 'add_action']);

    Route::get('/update/{id}', [StepsController::class, 'update_index'])->name('admin.howto.update');
    Route::post('/update/{id}', [StepsController::class, 'update_action']);

    Route::get('/restore/{id}', [StepsController::class, 'restore_index'])->name('admin.howto.restore');
    Route::post('/restore/{id}', [StepsController::class, 'restore_action']);

    Route::get('/delete/{id}', [StepsController::class, 'delete_index'])->name('admin.howto.delete');
    Route::post('/delete/{id}', [StepsController::class, 'delete_action']);

    Route::get('/view/{id}', [StepsController::class, 'view_index'])->name('admin.howto.view');

    Route::get('/delete-all', [StepsController::class, 'delete_all_index'])->name('admin.howto.delete.all');
    Route::post('/delete-all', [StepsController::class, 'delete_all_action']);

    Route::get('/restore-all', [StepsController::class, 'restore_all_index'])->name('admin.howto.restore.all');
    Route::post('/restore-all', [StepsController::class, 'restore_all_action']);

    Route::get('/stats', [StepsController::class, 'stats_index'])->name('admin.howto.stats');

    // For Steps:
    Route::get('/add/step/{h_id}', [StepsController::class, 'add_step_index'])->name('admin.howto.step.add');
    Route::post('/add/step/{h_id}', [StepsController::class, 'add_step_action']);

    Route::get('/update/step/{step_id}', [StepsController::class, 'update_step_index'])->name('admin.howto.step.update');
    Route::post('/update/step/{step_id}', [StepsController::class, 'update_step_action']);

    Route::get('/delete/step/{step_id}', [StepsController::class, 'delete_step_index'])->name('admin.howto.step.delete');
    Route::post('/delete/step/{step_id}', [StepsController::class, 'delete_step_action']);

    Route::get('/view/{h_id}/step/{step_id}', [StepsController::class, 'view_step_index'])->name('admin.howto.step.view');
  });

  Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('admin.users');

    Route::get('/stats', [UsersController::class, 'stats_index'])->name('admin.users.stats');

    Route::get('/view/{id}', [UsersController::class, 'view_index'])->name('admin.users.view');

    Route::get('/add', [UsersController::class, 'add_index'])->name('admin.users.add');
    Route::post('/add', [UsersController::class, 'add_action']);

    Route::get('/update/{id}', [UsersController::class, 'update_index'])->name('admin.users.update');
    Route::post('/update/{id}', [UsersController::class, 'update_action']);

    Route::get('/restore/{id}', [UsersController::class, 'restore_index'])->name('admin.users.restore');
    Route::post('/restore/{id}', [UsersController::class, 'restore_action']);

    Route::get('/delete/{id}', [UsersController::class, 'delete_index'])->name('admin.users.delete');
    Route::post('/delete/{id}', [UsersController::class, 'delete_action']);

    Route::get('/delete-all', [UsersController::class, 'delete_all_index'])->name('admin.users.delete.all');
    Route::post('/delete-all', [UsersController::class, 'delete_all_action']);

    Route::get('/restore-all', [UsersController::class, 'restore_all_index'])->name('admin.users.restore.all');
    Route::post('/restore-all', [UsersController::class, 'restore_all_action']);
  });

  Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'admins_index'])->name('admin.admins');

    Route::get('/add', [AdminController::class, 'add_index'])->name('admin.admins.add');
    Route::post('/add', [AdminController::class, 'add_action']);

    Route::get('/update/{id}', [AdminController::class, 'update_index'])->name('admin.admins.update');
    Route::post('/update/{id}', [AdminController::class, 'update_action']);

    Route::get('/delete/{id}', [AdminController::class, 'delete_index'])->name('admin.admins.delete');
    Route::post('/delete/{id}', [AdminController::class, 'delete_action']);

  });

});
