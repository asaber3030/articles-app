<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Articles;
use App\Models\Admin\InnerSteps;
use App\Models\Admin\Steps;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class StepsController extends Controller {

  ######## View All & Controller [HowTo Articles] ########
  public function index() {
    return view('admin.steps.index');
  }

  ######## Add [HowTo Article] ########
  public function add_index() {
    return view('admin.steps.add');
  }
  public function add_action(Request $request) {
    $request->validate([
      'title' => 'required|min:20|max:255',
      'tags' => 'required|min:10|max:255',
      'keywords' => 'required|min:10|max:255',
      'content' => 'required|min:255',
    ]);
    Steps::create([
      'h_admin' => Admin::id(),
      'h_user' => 1,
      'h_title' => $request->input('title'),
      'h_tags' => $request->input('tags'),
      'h_keywords' => $request->input('keywords'),
      'h_content' => $request->input('content'),
    ]);
    session()->flash('msg', 'HowTo Article has been added successfully!');
    return redirect()->route('admin.howto');
  }

  ######## Update [HowTo Article] ########
  public function update_index($id) {
    if (Steps::where('h_id', $id)->exists()) {
      return view('admin.steps.update')->with('howto', Steps::howto($id));
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
    Steps::where('h_id', $id)->update([
      'h_admin' => Admin::id(),
      'h_user' => 1,
      'h_title' => $request->input('title'),
      'h_tags' => $request->input('tags'),
      'h_keywords' => $request->input('keywords'),
      'h_content' => $request->input('content'),
      'h_status' => $request->input('status')
    ]);
    session()->flash('msg', 'HowTo Article has been updated successfully!');
    return redirect()->route('admin.howto');
  }

  ######## View [HowTo Article] ########
  public function view_index($id) {
    if (Steps::where('h_id', $id)->exists()) {
      return view('admin.steps.view')->with('howto', Steps::howto($id));
    } else {
      return view('errors.404');
    }
  }

  ######## Statistics of [HowTo Articles] ########
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

  ######## Delete Speicif [HowTo Article] ########
  public function delete_index($id) { # View
    if (Steps::where('h_id', $id)->exists()) {
      return view('admin.steps.delete')->with('howto', Steps::howto($id));
    } else {
      return view('errors.404');
    }
  }
  public function delete_action($id) { # Action
    session()->flash('msg', 'HowTo Article has been deleted successfully! You can restore it again.');
    Steps::set_status($id, 1);
    return redirect()->route('admin.howto');
  }

  ######## Restore Speicif [HowTo Article] ########
  public function restore_index($id) {
    if (Steps::where('h_id', $id)->exists()) {
      return view('admin.steps.restore')->with('howto', Steps::howto($id));
    } else {
      return view('errors.404');
    }
  }
  public function restore_action($id) {
    session()->flash('msg', 'HowTo Article has been restored successfully.');
    Steps::set_status($id, 0);
    return redirect()->route('admin.howto');
  }

  ######## Restore All [HowTo Articles] ########
  public function restore_all_index() {
    return view('admin.steps.restore-all');
  }
  public function restore_all_action() {
    session()->flash('msg', 'All HowTo Articles has been restored successfully!');
    Steps::restore_all();
    return redirect()->route('admin.howto');
  }

  ######## Delete All [HowTo Articles] ########
  public function delete_all_index() {
    return view('admin.steps.delete-all');
  }
  public function delete_all_action() {
    session()->flash('msg', 'All HowTo Articles has been deleted successfully!');
    Steps::delete_all();
    return redirect()->route('admin.howto');
  }

  ######################### Steps Inside HowTo Articles #####################################

  ######## Add New Step Inside [HowTo Articles] ########
  public function add_step_index($h_id) {
    return view('admin.steps.add-step')->with('howto', Steps::howto($h_id));
  }
  public function add_step_action($h_id, Request $request) {
    $request->validate([
      'step_title' => 'required|min:5',
      'step_content' => 'required|min:255'
    ]);
    InnerSteps::create([
      'step_title' => $request->input('step_title'),
      'step_content' => $request->input('step_content'),
      'belongs_to' => $h_id,
    ]);
    session()->flash('msg', 'New Step Has Been Added');
    return redirect()->route('admin.howto');
  }

  ######## Update a Step Inside [HowTo Articles] ########
  public function update_step_index($step_id) {
    if (InnerSteps::where('step_id', $step_id)->exists()) {
      return view('admin.steps.update-step')->with('step', InnerSteps::step($step_id));
    } else {
      return view('errors.404');
    }
  }
  public function update_step_action($step_id, Request $request) {
    $request->validate([
      'step_title' => 'required|min:5',
      'step_content' => 'required|min:255'
    ]);
    InnerSteps::where('step_id', $step_id)->update([
      'step_title' => $request->input('step_title'),
      'step_content' => $request->input('step_content'),
    ]);
    session()->flash('msg', 'Step Has Been Updated');
    return redirect()->route('admin.howto');
  }

  ######## Delete a Step Inside [HowTo Articles] ########
  public function delete_step_index($step_id) {
    return view('admin.steps.delete-step');
  }
  public function delete_step_action($step_id) {
    InnerSteps::delete_step($step_id);
    session()->flash('msg', 'Step Has Been Deleted');
    return redirect()->route('admin.howto');
  }

  ######## View a Step Inside [HowTo Articles] ########
  public function view_step_index($h_id, $step_id) {
    return view('admin.steps.view-step')->with([
      'step' => InnerSteps::step($step_id),
      'howto' => Steps::howto($h_id)
    ]);
  }

}
