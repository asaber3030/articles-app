<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
  public function articles_landing() {
    return view('auth.landing.articles');
  }

  public function view_article($article_id) {
    $article = Articles::find($article_id);
    return view('auth.articles.view')->with([
      'article' => $article,
      'user' => User::find($article->article_user)
    ]);
  }
}
