<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Users extends Model
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $table = 'users';

  protected $fillable = [
    'username',
    'firstname',
    'lastname',
    'email',
    'password',
    'picture',
  ];
  protected $hidden = [
    'password',
    'remember_token',
  ];
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public static function filter_users(string $user = '', int $paginate = 10) {
    return self::where('username', 'LIKE', '%' . $user . '%')
      ->orWhere('firstname', 'LIKE', '%' . $user . '%')
      ->orWhere('lastname', 'LIKE', '%' . $user . '%')
      ->paginate($paginate);
  }

  public static function user($id) {
    return self::where('id', $id)
      ->get()
      ->first();
  }

  public static function get_fullname_by_id($id): string {
    return self::user($id)->firstname . ' ' . self::user($id)->lastname;
  }

  public static function user_articles($id, $pag = 5) {
    return Articles::join('users', 'articles.article_user', 'users.id')
      ->where('users.id', $id)
      ->paginate($pag);
  }

  public static function last_user_articles($id, $take = 1) {
    return Articles::join('users', 'articles.article_user', 'users.id')
      ->select(
        'articles.created_at', 'articles.article_tags', 'articles.updated_at', 'articles.article_id', 'articles.article_title', 'articles.status',
        'users.username'
      )
      ->where('articles.article_user', $id)
      ->orderBy('articles.article_id', 'DESC')
      ->take($take)
      ->get()
      ->first();
  }
  public static function last_user_courses($id, $take = 1) {
    return Courses::join('users', 'courses.course_user', 'users.id')
      ->join('categories', 'courses.course_category', 'categories.category_id')
      ->select(
        'users.id', 'users.username',
        'courses.*',
        'categories.category_id', 'categories.category_name'
      )
      ->where('courses.course_user', $id)
      ->orderBy('courses.course_id', 'DESC')
      ->take($take)
      ->get()
      ->first();
  }

  public static function last_user_steps($id, $take = 1) {
    return Steps::join('users', 'howto.h_user', 'users.id')
      ->select(
        'users.id', 'users.username',
        'howto.*',
      )
      ->where('howto.h_user', $id)
      ->orderBy('howto.h_id', 'DESC')
      ->take($take)
      ->get()
      ->first();
  }

  public static function user_courses($id, $pag = 5) {
    return Courses::join('users', 'courses.course_user', 'users.id')
      ->where('courses.course_user', $id)
      ->paginate($pag);
  }
  public static function user_steps($id, $pag = 5) {
    return Steps::join('users', 'howto.h_user', 'users.id')
      ->where('howto.h_user', $id)
      ->paginate($pag);
  }
  public static function user_enrolled_in($id): int {
    return DB::table('course_enrolls')->where('enroll_user', $id)->get()->count();
  }

  public static function set_status(int $id, int $status) {
    return self::where('id', $id)->update([
      'user_status' => $status
    ]);
  }
  public static function restore_all() {
    return self::where('user_status', 0)->update([
      'user_status' => 1
    ]);
  }
  public static function delete_all() {
    return self::where('user_status', 1)->update([
      'user_status' => 0
    ]);
  }

  public static function last_5_users($limit = 5) {
    return self::where('user_status', 1)
      ->orderBy('id', 'desc')
      ->take($limit)
      ->get();
  }

  public static function count_deleted() {
    return self::where('user_status', 0)->count();
  }
  public static function count_available() {
    return self::where('user_status', 1)->count();
  }

  public static function count_user_articles($id) {
    return Articles::where('article_user', $id)->get()->count();
  }
  public static function count_user_howto($id) {
    return Steps::where('h_user', $id)->get()->count();
  }
  public static function count_user_courses($id) {
    return Courses::where('course_user', $id)->get()->count();
  }

}
