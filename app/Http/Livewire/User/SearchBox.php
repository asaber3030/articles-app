<?php

namespace App\Http\Livewire\User;

use App\Models\Articles;
use App\Models\Courses;
use App\Models\Steps;
use Livewire\Component;

class SearchBox extends Component
{
  public $search = '';

  public function render() {
    $articles = Articles::where('article_title', 'LIKE', '%' . $this->search . '%')->orWhere('article_keywords', 'LIKE', '%' . $this->search . '%')->limit(5)->get();
    $courses = Courses::where('course_title', 'LIKE', '%' . $this->search . '%')->limit(5)->get();
    $howto = Steps::where('h_title', 'LIKE', '%' . $this->search . '%')->orWhere('h_keywords', 'LIKE', '%' . $this->search . '%')->limit(5)->get();

    return view('livewire.user.search-box')->with([
      'articles' => $articles,
      'courses' => $courses,
      'howto' => $howto
    ]);
  }

  public function submitSearch() {
    if ($this->search !== '') redirect('/search?search=' . $this->search);
  }

}
