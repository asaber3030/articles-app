<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\InnerSteps;
use App\Models\Steps;
use App\Models\User;
use Illuminate\Http\Request;

class StepsController extends Controller
{
  public function steps_landing() {
    return view('auth.landing.steps');
  }

  public function view_article($id) {
    $article = Steps::find($id);
    return view('auth.howto.client-view')->with([
      'article' => $article,
      'user' => User::find($article->h_user),
      'steps' => Steps::find($id)->inner_steps
    ]);
  }


}
