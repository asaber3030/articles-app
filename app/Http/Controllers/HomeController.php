<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Courses;
use App\Models\Steps;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller {
  public function index() {
    return view('home');
  }

  public function search() {
    return view('auth.search-result')->with('result', (object)[
      'search_keyword' => request()->get('search'),
      'articles' => Articles::apply_search(request()->get('search') ?? ''),
      'howto' => Steps::apply_search(request()->get('search') ?? ''),
      'courses' => Courses::apply_search(request()->get('search') ?? ''),
    ]);
  }

}
