<?php

namespace App\Http\Livewire\User;

use App\Models\Articles;
use App\Models\User;
use Livewire\Component;

class ArticlesAll extends Component
{
  public $message;
  public $order = 'ASC';
  public $status = true;

  public function render() {
    $articles = User::find(id())
      ->articles()
      ->where('article_title', 'LIKE', '%' . $this->message . '%')
      ->orderBy('article_id', $this->order)->paginate(10);
    return view('livewire.user.articles-all')->with('articles', $articles);
  }
  public function inverseTable() {
    if ($this->status === true) {
      $this->status = false;
      $this->order = 'DESC';
    } else {
      $this->status = true;
      $this->order = 'ASC';
    }
  }
}
