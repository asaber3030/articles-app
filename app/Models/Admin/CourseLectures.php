<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLectures extends Model
{
  use HasFactory;
  protected $table = 'course_lectures';
  protected $primaryKey = 'lecture_id';
  protected $fillable = [
    'lecture_title',
    'lecture_content',
    'lecture_video',
    'lecture_youtube',
    'lecture_file',
  ];

  public static function course_lectures_titles($course_id) {
    return self::join('courses', 'course_lectures.lecture_course', 'courses.course_id')
      ->get();
  }

  public static function lecture_info($course_id, $lecture_id) {
    return self::join('courses', 'course_lectures.lecture_course', 'courses.course_id')
      ->where('course_lectures.lecture_id', $lecture_id)
      ->where('course_lectures.lecture_course', $course_id)
      ->get();
  }
}
