<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'username',
    'firstname',
    'lastname',
    'bio',
    'job_title',
    'email',
    'password',
  ];
  protected $hidden = [
    'password',
    'remember_token',
  ];
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  protected $primaryKey = 'id';

  ######## Helpers #########
  public static function count_articles() {
    return count(auth()->user()->articles);
  }
  public static function count_courses() {
    return count(auth()->user()->courses);
  }
  public static function count_steps() {
    return count(auth()->user()->steps);
  }

  ######## Relations #########

  ### Articles Relations
  public function articles() {
    return $this->hasMany(Articles::class, 'article_user', 'id');
  }
  public static function last_article() {
    return auth()->user()->articles()->orderBy('article_id', 'DESC')->take(1)->get();
  }

  ### Courses Relations
  public function courses() {
    return $this->hasMany(Courses::class, 'course_user', 'id');
  }
  public static function last_course() {
    return auth()->user()->courses()->orderBy('course_id', 'DESC')->take(1)->get();
  }

  ### Steps Relations
  public function steps() {
    return $this->hasMany(Steps::class, 'h_user', 'id');
  }
  public static function last_step() {
    return auth()->user()->steps()->orderBy('h_id', 'DESC')->take(1)->get();
  }

  ### Enrollments Course:
  public function enrolls() {
    return $this->hasMany(Enrollments::class, 'enroll_user', 'id');
  }

  ### Activity Relations
  public function activities() {
    return $this->hasMany(UserActivity::class, 'ac_user', 'id');
  }

  public static function get_user_by_id($user_id) {
    return self::find($user_id);
  }

}
