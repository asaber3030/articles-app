<?php

namespace Database\Seeders;

use App\Models\Admin\Courses;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

  public function run()
  {
    $this->call([
      CoursesSeeder::class
    ]);
  }
}
