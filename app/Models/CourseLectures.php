<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLectures extends Model
{
  use HasFactory;

  protected $primaryKey = 'lecture_id';
  protected $table = 'course_lectures';
  protected $fillable = [
    'lecture_title',
    'lecture_course',
    'lecture_content',
    'lecture_video',
    'lecture_youtube',
    'lecture_file'
  ];

  public function course() {
    return $this->belongsTo(Courses::class, 'lecture_course', 'lecture_id');
  }

  public static function course_lectures($course_id) {
    return self::where('lecture_course', $course_id)->get();
  }

  public static function count_lectures($course_id) {
    return self::where('lecture_course', $course_id)->count();
  }
}
