<?php

namespace App\Http\Livewire\User\Landing;

use App\Models\Articles;
use App\Models\FavArticles;
use Livewire\Component;

class LandingArticles extends Component
{
  public $search;

  public $letter_filter;
  public $time_filter;
  public $category_filter;

  public function render() {
    $articles = Articles::where('article_title', 'LIKE', '%' . $this->search . '%')
      ->orderBy('article_title', ($this->letter_filter === 'az') ? 'ASC' : 'DESC')
      ->orderBy('created_at', ($this->time_filter === 'old') ? 'ASC' : 'DESC')
      ->paginate(9);

    return view('livewire.user.landing.landing-articles')->with([
      'articles' => $articles,
    ]);
  }

  public function add_to_favs($article_id) {
    FavArticles::store_favourite_article($article_id, id());
    session()->flash('msg', 'Article has been added to your bookmarks!');
  }

  public function remove_from_favs($article_id) {
    FavArticles::where([
      ['fa_article', $article_id],
      ['fa_user', id()]
    ])->delete();
    session()->flash('msg', 'Article has been removed from bookmarks!');
  }
}
