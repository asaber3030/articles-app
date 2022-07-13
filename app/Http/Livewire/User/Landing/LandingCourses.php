<?php

namespace App\Http\Livewire\User\Landing;

use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\FavCourses;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Facades\Schema;

class LandingCourses extends Component
{
  public $search;

  public $letter_filter;
  public $time_filter;
  public $category_filter;

  public function render() {
    $courses = Courses::where('course_title', 'LIKE', '%' . $this->search . '%')
      ->orderBy('course_title', ($this->letter_filter === 'az') ? 'ASC' : 'DESC')
      ->orderBy('created_at', ($this->time_filter === 'old') ? 'ASC' : 'DESC')
      ->paginate(9);

    if ($this->category_filter) {
      $courses = Courses::where([
        ['course_title', 'LIKE', '%' . $this->search . '%'],
        ['course_category', $this->category_filter]
      ])
        ->orderBy('course_title', ($this->letter_filter === 'az') ? 'ASC' : 'DESC')
        ->orderBy('created_at', ($this->time_filter === 'old') ? 'ASC' : 'DESC')
        ->paginate(9);
    }
    return view('livewire.user.landing.landing-courses')->with([
      'courses' => $courses,
    ]);
  }

  public function enroll_in_course($course_id) {
    Enrollments::create([
      'enroll_user' => id(),
      'enroll_course' => $course_id
    ]);
    session()->flash('msg', 'You have enrolled in this course successfully!');
    return redirect()->route('app.courses');
  }
  public function unenroll_in_course($course_id) {
    Enrollments::where([
      ['enroll_user', id()],
      ['enroll_course', $course_id]
    ])->delete();
    session()->flash('msg', 'You have unenrolled from course successfully!');
    return redirect()->route('app.courses');
  }

  public function add_to_favs($course_id) {
    FavCourses::store_favourite_course($course_id, id());
    session()->flash('msg', 'Course has been added to favourites successfully!');
    return redirect()->route('app.courses');
  }

  public function remove_from_favs($course_id) {
    FavCourses::where([
      ['fc_course', $course_id],
      ['fc_user', id()]
    ])->delete();
    session()->flash('msg', 'Course has been removed from favourites successfully!');
    return redirect()->route('app.courses');
  }
}
