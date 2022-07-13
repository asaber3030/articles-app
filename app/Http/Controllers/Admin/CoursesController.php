<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Articles;
use App\Models\Admin\CourseLectures;
use App\Models\Admin\Courses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CoursesController extends Controller
{
  public function index() {
    return view('admin.courses.index');
  }

  public function add_index() {
    return view('admin.courses.add');
  }
  public function add_action(Request $request) {
    $request->validate([
      'title' => 'required|min:3|max:255',
      'content' => 'required|min:10|max:1000',
      'main_link' => 'required|max:255|url',
    ]);
    Courses::create([
      'course_title' => $request->input('title'),
      'course_content' => $request->input('content'),
      'course_category' => $request->input('category'),
      'course_user' => 1,
      'course_admin' => Admin::id(),
      'course_main_link' => $request->input('main_link'),
      'is_private' => $request->input('status'),
    ]);
    session()->flash('msg', 'Course has been added successfully!');
    return redirect()->route('admin.courses');
  }

  public function add_video_index($course_id) {
    return view('admin.courses.add-lecture')->with([
      'course' => Courses::course($course_id)
    ]);
  }
  public function add_video_action($course_id, Request $request) {
    $request->validate([
      'lecture_title' => 'required|min:5|max:255',
      'lecture_content' => 'required|min:255',
      'youtube_link' => 'required|max:255|url',
      'lecture_video' => 'required|max:10240|mimes:avi,wmv,mp4,flv',
      'lecture_file' => 'required|max:10240|mimes:pdf,docx,csv',
    ]);
    $file = $request->file('lecture_file');
    $file_name = time() . '_' . str_replace(' ', '', $request->input('lecture_title')) . '_' . strtolower(str_replace(' ', '', $file->getClientOriginalName()));
    $file_des = 'uploads/lecture_files/';

    $video = $request->file('lecture_video');
    $video_name = time() . '_' . str_replace(' ', '', $request->input('lecture_title')) . '_' . strtolower(str_replace(' ', '', $video->getClientOriginalName()));
    $video_des = 'uploads/lecture_videos/';

    $file->move($file_des, $file_name);
    $video->move($video_des, $video_name);

    CourseLectures::create([
      'lecture_title' => $request->input('lecture_title'),
      'lecture_content' => $request->input('lecture_content'),
      'lecture_youtube' => $request->input('youtube_link'),
      'lecture_video' => $video_des . $video_name,
      'lecture_file' => $file_des . $file_name,
    ]);

    session()->flash('msg', 'Video has been uploaded successfully!');
    return redirect()->route('admin.courses');
  }

  public function update_lecture_index($course_id, $lecture_id) {
    return view('admin.courses.update-lecture')->with([
      'course' => Courses::course($course_id),
      'lecture' => CourseLectures::lecture_info($course_id, $lecture_id)->first()
    ]);
  }
  public function update_lecture_action($course_id, $lecture_id, Request $request) {
    $request->validate([
      'lecture_title' => 'required|min:5|max:255',
      'lecture_content' => 'required|min:255',
      'youtube_link' => 'required|max:255|url',
      'lecture_video' => 'max:10240|mimes:avi,wmv,mp4,flv',
      'lecture_file' => 'max:10240|mimes:pdf,docx,csv',
    ]);
    $lecture = CourseLectures::lecture_info($course_id, $lecture_id)->first();

    if ($request->hasFile('lecture_file') || $request->hasFile('lecture_video')) {
      $file = $request->file('lecture_file');
      $file_des = 'uploads/lecture_files/';
      $file_name = time() . '.' . $file->getClientOriginalExtension();

      $video = $request->file('lecture_video');
      $video_des = 'uploads/lecture_videos/';
      $video_name = time() . '.' . $video->getClientOriginalExtension();

      $file->move($file_des, $file_name);
      $video->move($video_des, $video_name);

      $file_name = $file_des . $file_name;
      $video_name = $video_des . $video_name;

    } else {
      $file_name = $lecture->lecture_file;
      $video_name = $lecture->lecture_video;
    }


    CourseLectures::where('lecture_id', $lecture_id)->update([
      'lecture_title' => $request->input('lecture_title'),
      'lecture_content' => $request->input('lecture_content'),
      'lecture_youtube' => $request->input('youtube_link'),
      'lecture_video' => $video_name,
      'lecture_file' => $file_name,
    ]);

    session()->flash('msg', 'Lecture has been updated successfully!');
    return redirect()->route('admin.courses.view', $course_id);
  }

  public function delete_lecture_index($lecture_id) {
    return view('admin.courses.delete-lecture')->with('id', $lecture_id);
  }
  public function delete_lecture_action($lecture_id) {
    $lecture = CourseLectures::find($lecture_id);
    File::delete($lecture->lecture_video);
    File::delete($lecture->lecture_file);
    $lecture->delete();
    session()->flash('msg', 'Lecture has been deleted !');
    return redirect()->route('admin.courses');
  }

  public function update_index($id) {
    if (Courses::where('course_id', $id)->exists()) {
      return view('admin.courses.update')->with('course', Courses::course($id));
    } else {
      return view('errors.404');
    }
  }
  public function update_action($id, Request $request) {
//    dd($request->all());
    $errors = $request->validate([
      'title' => 'required|min:3|max:255',
      'content' => 'required|min:10|max:1000',
      'main_link' => 'required|max:255|url',
    ]);

    Courses::where('course_id', $id)->update([
      'course_title' => $request->input('title'),
      'course_content' => $request->input('content'),
      'course_category' => $request->input('category'),
      'course_user' => 1,
      'course_admin' => 1,
      'course_main_link' => $request->input('main_link'),
      'is_private' => $request->input('status'),
    ]);
    session()->flash('msg', 'Course has been updated successfully!');
    return redirect()->route('admin.courses');
  }

  public function view_index($id) {
    if (Courses::where('course_id', $id)->exists()) {
      return view('admin.courses.view')->with('course', Courses::course($id));
    } else {
      return view('errors.404');
    }
  }

  public function lectures_index($id) {
    if (Courses::where('course_id', $id)->exists()) {
      return view('admin.courses.lectures')->with([
        'course' => Courses::course($id),
        'lectures' => CourseLectures::course_lectures_titles($id),
        'first_lecture' => CourseLectures::course_lectures_titles($id)->first()
      ]);
    } else {
      return view('errors.404');
    }
  }
  public function lecture_view_index($course_id, $lecture_id) {
    if (Courses::where('course_id', $course_id)->exists() && CourseLectures::lecture_info($course_id, $lecture_id)) {
      return view('admin.courses.lecture-view')->with([
        'course' => Courses::course($course_id),
        'lectures' => CourseLectures::course_lectures_titles($course_id),
        'lecture' => CourseLectures::lecture_info($course_id, $lecture_id)->first()
      ]);
    } else {
      return view('errors.404');
    }
  }

  public function stats_index() {
    return view('admin.courses.stats')->with([
      'last_5_courses' => Articles::last_5_courses(4),
      'highest_views_article' => Articles::highest_views_article(),
      'longest_article' => Articles::longest_article(),
      'deleted_count' => Articles::count_deleted(),
      'available_count' => Articles::count_available(),
      'count_courses_by_user' => Articles::count_courses_by_user(),
      'count_courses_by_admin' => Articles::count_courses_by_admin(),
    ]);
  }

  public function delete_index($id) {
    if (Courses::where('course_id', $id)->exists()) {
      return view('admin.courses.delete')->with('course', Courses::course($id));
    } else {
      return view('errors.404');
    }
  }
  public function delete_action($id) {
    session()->flash('msg', 'Course has been deleted successfully! You can restore it again.');
    Courses::set_status($id, 1);
    return redirect()->route('admin.courses');
  }

  public function restore_index($id) {
    if (Courses::where('course_id', $id)->exists()) {
      return view('admin.courses.restore')->with('course', Courses::course($id));
    } else {
      return view('errors.404');
    }
  }
  public function restore_action($id) {
    session()->flash('msg', 'Course has been restored successfully.');
    Courses::set_status($id, 0);
    return redirect()->route('admin.courses');
  }

  public function restore_all_index() {
    return view('admin.courses.restore-all');
  }
  public function restore_all_action() {
    session()->flash('msg', 'All Courses has been restored successfully!');
    Courses::restore_all();
    return redirect()->route('admin.courses');
  }

  public function delete_all_index() {
    return view('admin.courses.delete-all');

  }
  public function delete_all_action() {
    session()->flash('msg', 'All Courses has been deleted successfully!');
    Courses::delete_all();
    return redirect()->route('admin.courses');
  }
}
