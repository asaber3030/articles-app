<?php

namespace App\Http\Livewire\User;

use App\Models\Enrollments;
use App\Models\FavArticles;
use App\Models\FavCourses;
use App\Models\FavSteps;
use Livewire\Component;

class AllFavourites extends Component {
  public function render() {

    $articles_bookmarks = FavArticles::where('fa_user', id())->get();
    $courses_bookmarks = FavCourses::where('fc_user', id())->get();
    $steps_bookmarks = FavSteps::where('fs_user', id())->get();

    return view('livewire.user.all-favourites')->with([
      'articles' => $articles_bookmarks,
      'courses' => $courses_bookmarks,
      'steps' => $steps_bookmarks
    ]);
  }

  public function unenroll_in_course($course_id) {
    Enrollments::where([
      ['enroll_user', id()],
      ['enroll_course', $course_id]
    ])->delete();
    session()->flash('msg', 'You have unenrolled from course successfully!');
    return redirect()->route('profile.bookmarks');
  }

  public function course_remove($course_id) {
    FavCourses::where([
      ['fc_course', $course_id],
      ['fc_user', id()]
    ])->delete();
    session()->flash('msg', 'Course has been removed from favourites successfully!');
    return redirect()->route('profile.bookmarks');
  }

  public function step_article_remove($article_id) {
    FavSteps::where([
      ['fs_step', $article_id],
      ['fs_user', id()]
    ])->delete();
    session()->flash('msg', 'Step Article has been removed from bookmarks!');
    return redirect()->route('profile.bookmarks');
  }

  public function article_remove($article_id) {
    FavArticles::where([
      ['fa_article', $article_id],
      ['fa_user', id()]
    ])->delete();
    session()->flash('msg', 'Article has been removed from bookmarks!');
    return redirect()->route('profile.bookmarks');
  }

  public function trash_all() {
    FavArticles::where('fa_user', id())->delete();
    FavSteps::where('fs_user', id())->delete();
    FavCourses::where('fc_user', id())->delete();
    session()->flash('msg', 'All Bookmarks have been trashed!');
    return redirect()->route('profile.bookmarks');
  }

}
