<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\AdminActivity;
use App\Models\Admin\Articles;
use App\Models\Admin\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Facades\Agent;

class AdminController extends Controller
{

  ###### Admin Current Profile ######
  public function index() {
    return view('admin.index')->with([
      'tables_nums' => count(\Illuminate\Support\Facades\DB::select('Show tables')),
      'activities' => AdminActivity::latest_current_admin_activity()
    ]);
  }

  public function login_index() {
    return view('admin.login');
  }
  public function login_action(Request $request) {
    $request->validate([
      'username' => 'required',
      'password' => 'required'
    ]);
    $admin = Admin::where('admin_username', $request->input('username'))->get()->first();
    if ($admin) {
      if (Hash::check($request->input('password'), $admin->admin_password)) {
        $request->session()->put('admin_id', $admin->admin_id);
        return redirect()->route('admin.dashboard');
        Admin::append_activity([
          'ac_title' => 'Login at ' . Carbon::now(),
          'ac_desc' => 'Login activity by Device: ' . Agent::device(),
          'ac_icon' => 'check',
          'ac_link' => route('admin.profile'),
          'ac_admin' => Admin::id()
        ]);
      } else {
        session()->flash('msg', 'No such admin with this data!');
      }
    } else {
      session()->flash('msg', 'No such admin with this data!');
    }
    return view('admin.login');
  }

  public function profile() {
    return view('admin.profile.profile')->with([
      'last_article' => Admin::last_admin_articles(Admin::id()),
      'last_course' => Admin::last_admin_courses(Admin::id()),
      'last_step' => Admin::last_admin_steps(Admin::id()),
    ]);
  }

  public function change_password_index() {
    return view('admin.profile.change-password');
  }
  public function change_password_action(Request $r) {
    $r->validate([
      'new_password' => 'required|min:8|max:255',
      'old_password' => 'required'
    ]);
    if (Hash::check($r->input('old_password'), Admin::admin()->admin_password)) {
      session()->flash('msg', 'Password has been changed successfully!');
      Admin::where('admin_id', Admin::id())->update([
        'admin_password' => Hash::make($r->input('new_password'))
      ]);
      Admin::append_activity([
        'ac_title' => 'Password has been changed successfully at ' . Carbon::now(),
        'ac_desc' => 'Password was changed from ' . Agent::device(),
        'ac_link' => route('admin.change.password'),
        'ac_icon' => 'user-lock',
        'ac_admin' => Admin::id()
      ]);
    }
    session()->flash('msg', 'Old password does not match your current password');
    return redirect()->route('admin.change.password');
  }

  public function change_info_index() {
    return view('admin.profile.change-info');
  }
  public function change_info_action(Request $request) {
    $request->validate([
      'admin_username' => 'required|min:4|max:20',
      'admin_firstname' => 'required|min:4|max:20',
      'admin_lastname' => 'required|min:4|max:20',
      'admin_phone' => 'required|min:4|integer',
      'admin_email' => 'required|min:4|max:20|email',
    ]);
    Admin::where('admin_id', Admin::id())->update([
      'admin_username' => $request->input('admin_username'),
      'admin_firstname' => $request->input('admin_firstname'),
      'admin_lastname' => $request->input('admin_lastname'),
      'admin_phone' => $request->input('admin_phone'),
      'admin_email' => $request->input('admin_email'),
    ]);
    Admin::append_activity([
      'ac_title' => 'Account personal information has been updated at ' . Carbon::now(),
      'ac_desc' => 'Personal information has been updated from ' . Agent::device(),
      'ac_link' => route('admin.change.info'),
      'ac_icon' => 'check',
      'ac_admin' => Admin::id()
    ]);
    session()->flash('msg', 'Your personal data has been updated successfully!');
    return redirect()->route('admin.change.info');
  }

  public function change_picture_index() {
    return view('admin.profile.change-picture');
  }
  public function change_picture_action(Request $r) {
    $r->validate([
      'new_picture' => 'required|mimes:jpg,png,gif,jpeg'
    ]);
    $file = $r->file('new_picture');
    $file_name = time() . '_' . Admin::username() . '.' . $file->getClientOriginalExtension();
    $file->move('uploads/admin_pics/', $file_name);
    Admin::find(Admin::id())->update([
      'admin_picture' => 'uploads/admin_pics/' . $file_name
    ]);
    Admin::append_activity([
      'ac_title' => 'Personal Picture has been updated at ' . Carbon::now(),
      'ac_desc' => 'Profile picture has been updated ' . Agent::device(),
      'ac_link' => route('admin.change.picture'),
      'ac_icon' => 'check',
      'ac_admin' => Admin::id()
    ]);
    session()->flash('msg', 'New Picture has been applied!');
    return redirect()->route('admin.profile');
  }

  public function admin_activity_index() {
    return view('admin.profile.activity')->with([
      'activities' => AdminActivity::current_admin_activity_pag()
    ]);
  }

  ##### Admin Controlling Another Admins ######
  public function find_admin($id) {
    return Admin::find($id)->exists();
  }

  public function admins_index() {
    return view('admin.admins.index');
  }

  public function add_index() {
    return view('admin.admins.add');
  }
  public function add_action(Request $request) {
    $request->validate([
      'admin_username' => 'required|min:5|max:20|unique:admins',
      'admin_firstname' => 'required|min:4|max:50',
      'admin_lastname' => 'required|min:4|max:50',
      'admin_email' => 'required|email|unique:admins',
      'admin_password' => 'required|min:8|max:255',
    ]);
    Admin::create([
      'admin_username' => $request->input('admin_username'),
      'admin_firstname' => $request->input('admin_firstname'),
      'admin_lastname' => $request->input('admin_lastname'),
      'admin_email' => $request->input('admin_email'),
      'admin_password' => Hash::make($request->input('admin_password')),
    ]);
    session()->flash('msg', 'Admin has been added successfully!');
    return redirect()->route('admin.admins');
  }

  public function update_index($id) {
    if ($this->find_admin($id) && Admin::id() !== $id && $id !== 1) {
      return view('admin.admins.update')->with('admin', Admin::get_admin($id));
    } else {
      return view('errors.404');
    }
  }
  public function update_action($id, Request $request) {
    $request->validate([
      'admin_username' => 'required|min:5|max:20',
      'admin_firstname' => 'required|min:4|max:50',
      'admin_lastname' => 'required|min:4|max:50',
      'admin_email' => 'required|email'
    ]);
    Admin::where('admin_id', $id)->update([
      'admin_username' => $request->input('admin_username'),
      'admin_firstname' => $request->input('admin_firstname'),
      'admin_lastname' => $request->input('admin_lastname'),
      'admin_email' => $request->input('admin_email'),
      'admin_role' => $request->has('admin_role') ? 2 : 1,
    ]);
    session()->flash('msg', 'Admin has been updated successfully!');
    return redirect()->route('admin.admins');
  }

  public function delete_index($id) {
    if ($this->find_admin($id) && Admin::id() !== $id && $id !== 1) {
      return view('admin.admins.delete')->with('admin', Admin::get_admin($id));
    } else {
      abort(404);
      return view('errors.404');
    }
  }
  public function delete_action($id) {
    session()->flash('msg', 'Admin has been deleted successfully.');
    Admin::find($id)->delete();
    return redirect()->route('admin.admins');
  }

  public function website_settings_view() {
    return view('admin.settings');
  }

}
