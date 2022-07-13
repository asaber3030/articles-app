<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
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

  public static function apply_search($search) {
    return self::where('course_title', 'LIKE', '%' . $search . '%')
      ->get();
  }

  public function user() {
    return $this->belongsTo(User::class, 'course_user', 'course_id');
  }

  public function enrolls() {
    return $this->hasMany(Enrollments::class, 'enroll_course', 'course_id');
  }

  public function lectures() {
    return $this->hasMany(CourseLectures::class, 'lecture_course', 'course_id');
  }

  public static function get_course($course_id) {
    return self::find($course_id);
  }

}
