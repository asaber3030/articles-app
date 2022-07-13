<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavCourses extends Model
{
  use HasFactory;
  protected $table = 'fav_courses';
  protected $primaryKey = 'fc_id';
  protected $fillable = [
    'fc_course',
    'fc_user'
  ];
  public $timestamps = false;
//  public function get_current_user_favs() {
//    return self::where('');
//  }
  public static function is_added_before($course_id, $user_id) {
    return self::where([
      ['fc_course', $course_id],
      ['fc_user', $user_id]
    ])->exists();
  }

  public static function store_favourite_course($course_id, $user_id) {
    return self::create([
      'fc_course' => $course_id,
      'fc_user' => $user_id
    ]);
  }
}
