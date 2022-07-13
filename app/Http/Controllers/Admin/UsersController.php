<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Articles;
use App\Models\Admin\Users;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsersController extends Controller
{
  public function index() {
    return view('admin.users.index');
  }

  public function find_user($id) {
    return Users::find($id);
  }

  public function add_index() {
    return view('admin.users.add');
  }
  public function add_action(Request $request) {
    $request->validate([
      'username' => 'required|min:5|max:20',
      'firstname' => 'required|min:4|max:50',
      'lastname' => 'required|min:4|max:50',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|max:255',
    ]);
    Users::create([
      'username' => $request->input('username'),
      'firstname' => $request->input('firstname'),
      'lastname' => $request->input('lastname'),
      'email' => $request->input('email'),
      'password' => $request->input('password'),
    ]);
    session()->flash('msg', 'User has been added successfully!');
    return redirect()->route('admin.users');
  }

  public function update_index($id) {
    if ($this->find_user($id)) {
      return view('admin.users.update')->with('user', Users::user($id));
    } else {
      return view('errors.404');
    }
  }
  public function update_action($id, Request $request) {
    $request->validate([
      'username' => 'required|min:5|max:20',
      'firstname' => 'required|min:4|max:50',
      'lastname' => 'required|min:4|max:50',
      'email' => 'required|email|unique:users,email,' . $id,
    ]);
    Users::where('id', $id)->update([
      'username' => $request->input('username'),
      'firstname' => $request->input('firstname'),
      'lastname' => $request->input('lastname'),
      'email' => $request->input('email'),
    ]);
    session()->flash('msg', 'User has been updated successfully!');
    return redirect()->route('admin.users');
  }

  public function view_index($id) {
    if ($this->find_user($id)) {
      return view('admin.users.view')->with([
        'user' => Users::user($id),
        'fullname' => Users::get_fullname_by_id($id),
        'articles' => Users::user_articles($id),
        'courses' => Users::user_courses($id),
        'steps' => Users::user_steps($id),
        'count_enrolled' => Users::user_enrolled_in($id),
        'last_article' => Users::last_user_articles($id),
        'last_step' => Users::last_user_steps($id),
        'last_course' => Users::last_user_courses($id)
      ]);
    } else {
      abort(404);
      return view('errors.404');
    }
  }

  public function stats_index() {
    return view('admin.users.stats')->with([
      'last_5_users' => Articles::last_5_users(4),
      'highest_views_article' => Articles::highest_views_article(),
      'longest_article' => Articles::longest_article(),
      'deleted_count' => Articles::count_deleted(),
      'available_count' => Articles::count_available(),
      'count_users_by_user' => Articles::count_users_by_user(),
      'count_users_by_admin' => Articles::count_users_by_admin(),
    ]);
  }

  public function delete_index($id) {
    if ($this->find_user($id)) {
      return view('admin.users.delete')->with('user', Users::user($id));
    } else {
      return view('errors.404');
    }
  }
  public function delete_action($id) {
    session()->flash('msg', 'User has been deleted successfully! You can restore it again.');
    Users::set_status($id, 0);
    return redirect()->route('admin.users');
  }

  public function restore_index($id) {
    if ($this->find_user($id)) {
      return view('admin.users.restore')->with('user', Users::user($id));
    } else {
      return view('errors.404');
    }
  }
  public function restore_action($id) {
    session()->flash('msg', 'User has been restored successfully.');
    Users::set_status($id, 1);
    return redirect()->route('admin.users');
  }

  public function restore_all_index() {
    return view('admin.users.restore-all');
  }
  public function restore_all_action() {
    session()->flash('msg', 'All Users has been restored successfully!');
    Users::restore_all();
    return redirect()->route('admin.users');
  }
  public function delete_all_index() {
    return view('admin.users.delete-all');

  }
  public function delete_all_action() {
    session()->flash('msg', 'All Users has been deleted successfully!');
    Users::delete_all();
    return redirect()->route('admin.users');
  }
}
