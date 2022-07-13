<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  use HasFactory;

  protected $table = 'admins';
  protected $primaryKey = 'admin_id';
  protected $fillable = [
    'admin_username',
    'admin_firstname',
    'admin_lastname',
    'admin_email',
    'admin_picture',
    'admin_phone',
    'admin_password',
  ];

  public static function admin() {
    return self::find(session()->get('admin_id'));
  }
  public static function id() {
    return self::admin()->admin_id;
  }
  public static function fullname() {
    return self::admin()->admin_firstname . ' ' . self::admin()->admin_lastname;
  }
  public static function firstname() {
    return self::admin()->admin_firstname;
  }
  public static function lastname() {
    return self::admin()->admin_lastname;
  }
  public static function username() {
    return self::admin()->admin_username;
  }
  public static function email() {
    return self::admin()->admin_email;
  }
  public static function phone() {
    return self::admin()->admin_phone;
  }
  public static function picture() {
    return self::admin()->admin_picture;
  }
  public static function role() {
    return self::admin()->admin_role;
  }

  public static function get_admin($id) {
    return self::find($id);
  }

  public static function filter_admins(string $admin = '', string $order = 'admin_id', string $type = 'ASC', int $paginate = 10) {
    return self::where('admin_username', 'LIKE', '%' . $admin . '%')
      ->where('admin_id', '<>', self::id())
      ->where('admin_id', '<>', 1)
      ->orderBy($order, $type)
      ->paginate($paginate);
  }

  public static function admin_articles($id, $pag = 5) {
    return Articles::join('admins', 'articles.article_admin', 'admins.admin_id')
      ->where('admins.admin_id', $admin_id)
      ->paginate($pag);
  }

  public static function last_admin_steps($id, $take = 1) {
    return Steps::join('admins', 'howto.h_admin', 'admins.admin_id')
      ->select(
        'admins.admin_id', 'admins.admin_username',
        'howto.*',
      )
      ->where('howto.h_admin', $id)
      ->orderBy('howto.h_id', 'DESC')
      ->take($take)
      ->get()
      ->first();
  }
  public static function last_admin_articles($admin_id, $take = 1) {
    return Articles::join('admins', 'articles.article_admin', 'admins.admin_id')
      ->select(
        'articles.created_at', 'articles.article_id', 'articles.article_tags', 'articles.updated_at', 'articles.article_admin', 'articles.article_title', 'articles.status',
        'admins.admin_username'
      )
      ->where('articles.article_admin', $admin_id)
      ->orderBy('articles.article_id', 'DESC')
      ->take($take)
      ->get()
      ->first();
  }
  public static function last_admin_courses($admin_id, $take = 1) {
    return Courses::join('admins', 'courses.course_admin', 'admins.admin_id')
      ->join('categories', 'courses.course_category', 'categories.category_id')
      ->select(
        'admins.admin_id', 'admins.admin_username',
        'courses.*',
        'categories.category_id', 'categories.category_name'
      )
      ->where('courses.course_admin', $admin_id)
      ->orderBy('courses.course_id', 'DESC')
      ->take($take)
      ->get()
      ->first();
  }

  public static function count_admin_articles($id) {
    return Articles::where('article_admin', $id)->get()->count();
  }
  public static function count_admin_howto($id) {
    return Steps::where('h_admin', $id)->get()->count();
  }
  public static function count_admin_courses($id) {
    return Courses::where('course_admin', $id)->get()->count();
  }

  public static function append_activity(array $ac) {
    return AdminActivity::create($ac);
  }

}

