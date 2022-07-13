<?php

namespace App\Http\Controllers;

use App\Models\Admin\Admin;
use App\Models\Admin\Courses;
use App\Models\CourseLectures;
use App\Models\User;
use Illuminate\Http\Request;

class CoursesController extends Controller
{

  public function courses_landing_page() {
    return view('auth.landing.courses');
  }

  public function view_course($course_id) {
    $course = Courses::find($course_id);
    $lectures = $course->lectures;
    return view('auth.courses.client-view')->with([
      'course' => $course,
      'lectures' => CourseLectures::course_lectures($course_id),
      'user' => ($course->course_user === 1) ? Admin::find($course->course_admin) : User::find($course->course_user),
    ]);
  }

  public function course_lecture($course_id, $lecture_id) {
    $course = Courses::find($course_id);
    $lecture = CourseLectures::find($lecture_id);
    $lectures = CourseLectures::course_lectures($course_id);
    return view('auth.courses.client-lecture')->with([
      'course' => $course,
      'lecture' => $lecture,
      'lectures' => $lectures
    ]);
  }

}
