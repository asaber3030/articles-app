<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
  use HasFactory;
  protected $table = 'course_enrolls';
  protected $fillable = [
    'enroll_user',
    'enroll_course'
  ];

  public function course() {
    return $this->belongsTo(Courses::class, 'enroll_course', 'enroll_id');
  }

  public function user() {
    return $this->belongsTo(User::class, 'enroll_user', 'id');
  }

  public static function count_enrolls($course_id) {
    return self::where('enroll_course', $course_id)->count();
  }

  public static function get_user($user_id) {
    return self::where('enroll_user', $user_id)->enrolls;
  }

  public static function i_have_enrolled_in($course_id, $user_id) {
    return self::where([
      ['enroll_course', $course_id],
      ['enroll_user', $user_id]
    ])->exists();
  }

}
