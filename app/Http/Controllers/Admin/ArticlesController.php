<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Articles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class ArticlesController extends Controller {

  public function index() {
    return view('admin.articles.index');
  }

  public function add_index() {
    return view('admin.articles.add');
  }
  public function add_action(Request $request) {
    $request->validate([
      'title' => 'required|min:20|max:255',
      'keywords' => 'required|min:10|max:255',
      'tags' => 'required|min:10|max:255',
      'content' => 'required|min:255',
    ]);
    Articles::create([
      'article_admin' => Admin::id(),
      'article_user' => 1,
      'article_title' => $request->input('title'),
      'article_content' => $request->input('content'),
      'article_keywords' => $request->input('keywords'),
      'article_tags' => $request->input('tags'),
    ]);
    session()->flash('msg', 'Article has been added successfully!');
    return redirect()->route('admin.articles');
  }

  public function update_index($id) {
    if (Articles::where('article_id', $id)->exists()) {
      return view('admin.articles.update')->with('article', Articles::where('article_id', $id)->get()->first());
    } else {
      return view('errors.404');
    }
  }
  public function update_action($id, Request $request) {
    $request->validate([
      'title' => 'required|min:20|max:255',
      'keywords' => 'required|min:10|max:255',
      'tags' => 'required|min:10|max:255',
      'content' => 'required|min:255',
    ]);
    Articles::where('article_id', $id)->update([
      'article_title' => $request->input('title'),
      'article_content' => $request->input('content'),
      'article_keywords' => $request->input('keywords'),
      'article_tags' => $request->input('tags'),
      'updated_at' => Carbon::now()
    ]);
    session()->flash('msg', 'Article has been updated successfully!');
    return redirect()->route('admin.articles');
  }

  public function view_index($id) {
    if (Articles::where('article_id', $id)->exists()) {
      return view('admin.articles.view')->with('article', Articles::article($id));
    } else {
      return view('errors.404');
    }
  }

  public function stats_index() {
    return view('admin.articles.stats')->with([
      'last_5_articles' => Articles::last_5_articles(4),
      'highest_views_article' => Articles::highest_views_article(),
      'longest_article' => Articles::longest_article(),
      'deleted_count' => Articles::count_deleted(),
      'available_count' => Articles::count_available(),
      'count_articles_by_user' => Articles::count_articles_by_user(),
      'count_articles_by_admin' => Articles::count_articles_by_admin(),
    ]);
  }

  public function delete_index($id) {
    if (Articles::where('article_id', $id)->exists()) {
      return view('admin.articles.delete')->with('article', Articles::where('article_id', $id)->get()->first());
    } else {
      return view('errors.404');
    }
  }
  public function delete_action($id) {
    session()->flash('msg', 'Article has been deleted successfully! You can restore it again.');
    Articles::set_status($id, 0);
    return redirect()->route('admin.articles');
  }

  public function restore_index($id) {
    if (Articles::where('article_id', $id)->exists()) {
      return view('admin.articles.restore')->with('article', Articles::where('article_id', $id)->get()->first());
    } else {
      return view('errors.404');
    }
  }
  public function restore_action($id) {
    session()->flash('msg', 'Article has been restored successfully.');
    Articles::set_status($id, 1);
    return redirect()->route('admin.articles');
  }

  public function restore_all_index() {
    return view('admin.articles.restore-all');
  }
  public function restore_all_action() {
    session()->flash('msg', 'All Articles has been restored successfully!');
    Articles::restore_all();
    return redirect()->route('admin.articles');
  }

  public function delete_all_index() {
    return view('admin.articles.delete-all');

  }
  public function delete_all_action() {
    session()->flash('msg', 'All Articles has been deleted successfully!');
    Articles::delete_all();
    return redirect()->route('admin.articles');
  }

  public function settings_view() {
    return view('admin.articles.settings');
  }

}
