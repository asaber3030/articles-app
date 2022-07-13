<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Admin\Articles;
use Livewire\Component;

class DisplayArticles extends Component {
  public $search = '';
  public function render() {
    if (isset($_GET['search'])) {
      $this->search = htmlspecialchars_decode($_GET['search']);
    }
    return view('livewire.admin.articles.display-articles')->with([
      'articles' => Articles::all_articles_by_title($this->search)
    ]);
  }
}
