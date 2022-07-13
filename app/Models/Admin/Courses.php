<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Courses extends Model {
  use HasFactory;
  protected $table = 'courses';
  protected $primaryKey = 'course_id';
  protected $fillable = [
    'course_title',
    'course_content',
    'course_category',
    'course_user',
    'course_admin',
    'course_main_link',
    'course_status',
    'is_private'
  ];
  public static function all_courses_by_title(string $searchByTitle = '', int $paginate = 10, $col = 'course_id', $type = 'DESC') {
    return self::join('users', 'courses.course_user', 'users.id')
      ->join('admins', 'courses.course_admin', 'admins.admin_id')
      ->join('categories', 'courses.course_category', 'categories.category_id')
      ->select('users.username', 'users.id', 'courses.*', 'admins.admin_username', 'admins.admin_id', 'categories.category_id', 'categories.category_name')
      ->where('courses.course_title', 'LIKE', '%' . $searchByTitle . '%')
      ->orderBy($col, $type)
      ->paginate($paginate);
  }

  public static function count_enrolls($course_id) {
    return DB::table('course_enrolls')->where('enroll_course', $course_id)->count();
  }

  public static function course($id) {
    return self::join('users', 'courses.course_user', 'users.id')
      ->join('admins', 'courses.course_admin', 'admins.admin_id')
      ->join('categories', 'courses.course_category', 'categories.category_id')
      ->select('users.username', 'users.id', 'categories.category_id', 'categories.category_name', 'courses.*', 'admins.admin_username', 'admins.admin_id')
      ->where('courses.course_id', $id)
      ->get()
      ->first();
  }

  public static function set_status(int $id, int $status) {
    return self::where('course_id', $id)->update([
      'course_status' => $status
    ]);
  }
  public static function restore_all() {
    return self::where('course_status', 1)->update([
      'course_status' => 0
    ]);
  }
  public static function delete_all() {
    return self::where('course_status', 0)->update([
      'course_status' => 1
    ]);
  }


  public static function count_deleted() {
    return self::where('course_status', 0)->count();
  }
  public static function count_available() {
    return self::where('course_status', 1)->count();
  }

  public static function count_courses_by_user() {
    return self::where('course_admin', 1)->count();
  }
  public static function count_courses_by_admin() {
    return self::where('course_user', 1)->count();
  }
}
