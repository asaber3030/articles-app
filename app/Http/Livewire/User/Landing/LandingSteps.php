<?php

namespace App\Http\Livewire\User\Landing;

use App\Models\Articles;
use App\Models\FavArticles;
use App\Models\FavSteps;
use App\Models\Steps;
use Livewire\Component;

class LandingSteps extends Component
{
  public $search;

  public $letter_filter;
  public $time_filter;
  public $category_filter;

  public function render() {
    $articles = Steps::where('h_title', 'LIKE', '%' . $this->search . '%')
      ->orderBy('h_title', ($this->letter_filter === 'az') ? 'ASC' : 'DESC')
      ->orderBy('created_at', ($this->time_filter === 'old') ? 'ASC' : 'DESC')
      ->paginate(9);

    return view('livewire.user.landing.landing-steps')->with([
      'articles' => $articles,
    ]);
  }

  public function add_to_favs($article_id) {
    FavSteps::store_favourite_article($article_id, id());
    session()->flash('msg', 'Article has been added to your bookmarks!');
  }

  public function remove_from_favs($article_id) {
    FavSteps::where([
      ['fs_step', $article_id],
      ['fs_user', id()]
    ])->delete();
    session()->flash('msg', 'Article has been removed from bookmarks!');
  }
}
