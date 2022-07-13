<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Courses;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursesFactory extends Factory {
  protected $model = Courses::class;
  public function definition() {
    return [
      'course_title' => $this->faker->title,
      'course_content' => $this->faker->paragraph,
      'course_category' => 1,
      'course_main_link' => 'https://www.youtube.com/watch?v=LQbzz1isz6M&ab_channel=UniqueCoderzAcademy',
      'course_user' => 1,
      'course_admin' => 2
    ];
  }
}
