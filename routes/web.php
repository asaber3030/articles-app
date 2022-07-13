<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StepsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {

  Route::get('/', [UserController::class, 'profile'])->name('profile');

  Route::get('/bookmarks', [UserController::class, 'my_bookmarks'])->name('profile.bookmarks');

  ### Profile information actions
  Route::get('/picture', [UserController::class, 'profile_picture_view'])->name('profile.change.picture');
  Route::post('/picture', [UserController::class, 'profile_picture_action']);

  Route::get('/contact-information', [UserController::class, 'profile_contact_view'])->name('profile.change.contact');
  Route::post('/contact-information', [UserController::class, 'profile_contact_action']);

  Route::get('/personal-information', [UserController::class, 'profile_personal_view'])->name('profile.change.personal');
  Route::post('/personal-information', [UserController::class, 'profile_personal_action']);

  Route::get('/password', [UserController::class, 'profile_password_view'])->name('profile.change.password');
  Route::post('/password', [UserController::class, 'profile_password_action']);

  Route::get('/activity', [UserController::class, 'my_activity'])->name('profile.activity');

  Route::get('/delete-account', [UserController::class, 'delete_account_view'])->name('profile.delete');
  Route::post('/delete-account', [UserController::class, 'delete_account_action']);

  ### Articles of Current user
  Route::prefix('articles')->group(function () {
    Route::get('/', [UserController::class, 'my_articles'])->name('profile.articles');

    Route::get('/{article_id}/views', [UserController::class, 'article_views'])->name('profile.articles.views');

    Route::get('/add', [UserController::class, 'add_article_view'])->name('profile.articles.add');
    Route::post('/add', [UserController::class, 'add_article_action']);

    Route::get('/update/{article_id}', [UserController::class, 'update_article_view'])->name('profile.articles.update');
    Route::post('/update/{article_id}', [UserController::class, 'update_article_action']);

    Route::get('/delete/{article_id}', [UserController::class, 'delete_article_view'])->name('profile.articles.delete');
    Route::post('/delete/{article_id}', [UserController::class, 'delete_article_action']);

  });

  ### Courses of Current user
  Route::prefix('courses')->group(function () {
    Route::get('/', [UserController::class, 'my_courses'])->name('profile.courses');

    Route::get('/add', [UserController::class, 'add_course_view'])->name('profile.courses.add');
    Route::post('/add', [UserController::class, 'add_course_action']);

    Route::get('/add-lecture/{course_id}', [UserController::class, 'add_lecture_view'])->name('profile.courses.add.lecture');
    Route::post('/add-lecture/{course_id}', [UserController::class, 'add_lecture_action']);

    Route::get('/enrolled', [UserController::class, 'my_enrolled_courses'])->name('profile.courses.my-enrolls');

    Route::get('/enrolled/{course_id}', [UserController::class, 'course_enrolled_users'])->name('profile.courses.enrolled');

    Route::get('/update/{course_id}', [UserController::class, 'update_course_view'])->name('profile.courses.update');
    Route::post('/update/{course_id}', [UserController::class, 'update_course_action']);

    Route::get('/delete/{course_id}', [UserController::class, 'delete_course_view'])->name('profile.courses.delete');
    Route::post('/delete/{course_id}', [UserController::class, 'delete_course_action']);

    Route::get('/view/{course_id}', [UserController::class, 'view_course_view'])->name('profile.courses.view');

    Route::get('/view/lecture/{course_id}/{lecture_id}', [UserController::class, 'view_lecture_view'])->name('profile.courses.view.lecture');

    Route::get('/delete/lecture/{course_id}/{lecture_id}', [UserController::class, 'delete_lecture_view'])->name('profile.courses.delete.lecture');
    Route::post('/delete/lecture/{course_id}/{lecture_id}', [UserController::class, 'delete_lecture_action']);
  });


  ### Steps of Current user
  Route::prefix('how-to')->group(function () {
    Route::get('/', [UserController::class, 'my_steps'])->name('profile.howto');

    Route::get('/add', [UserController::class, 'add_howto_view'])->name('profile.howto.add');
    Route::post('/add', [UserController::class, 'add_howto_action']);

    Route::get('/add/step/{howto_id}', [UserController::class, 'add_step_view'])->name('profile.howto.add.step');
    Route::post('/add/step/{howto_id}', [UserController::class, 'add_step_action']);

    Route::get('/update/step/{howto_id}/{step_id}', [UserController::class, 'update_step_view'])->name('profile.howto.update.step');
    Route::post('/update/step/{howto_id}/{step_id}', [UserController::class, 'update_step_action']);

    Route::get('/delete/step/{howto_id}/{step_id}', [UserController::class, 'delete_step_view'])->name('profile.howto.delete.step');
    Route::post('/delete/step/{howto_id}/{step_id}', [UserController::class, 'delete_step_action']);

    Route::get('/update/{howto_id}', [UserController::class, 'update_howto_view'])->name('profile.howto.update');
    Route::post('/update/{howto_id}', [UserController::class, 'update_howto_action']);

    Route::get('/delete/{howto_id}', [UserController::class, 'delete_howto_view'])->name('profile.howto.delete');
    Route::post('/delete/{howto_id}', [UserController::class, 'delete_howto_action']);

    Route::get('/view/{howto_id}', [UserController::class, 'view_howto_view'])->name('profile.howto.view');
  });

});

Route::prefix('/articles')->group(function() {
  Route::get('/', [ArticlesController::class, 'articles_landing'])->name('app.articles');
  Route::get('/{article_id}', [ArticlesController::class, 'view_article'])->name('app.articles.view');

});

Route::prefix('/courses')->group(function() {
  Route::get('/', [CoursesController::class, 'courses_landing_page'])->name('app.courses');
  Route::get('/{course_id}', [CoursesController::class, 'view_course'])->name('app.courses.view');
  Route::get('/{course_id}/lecture/{lecture_id}', [CoursesController::class, 'course_lecture'])->name('app.courses.lecture');
});

Route::prefix('/howto')->group(function() {
  Route::get('/', [StepsController::class, 'steps_landing'])->name('app.howto');
  Route::get('/{id}', [StepsController::class, 'view_article'])->name('app.howto.view');
});
