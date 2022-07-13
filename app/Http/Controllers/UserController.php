<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\CourseLectures;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\InnerSteps;
use App\Models\Steps;
use App\Models\User;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
  public function profile() {
    return view('auth.profile')->with([
      'last_article' => User::last_article()->first(),
      'last_course' => User::last_course()->first(),
      'last_step' => User::last_step()->first(),
    ]);
  }

  public function my_articles() {
    return view('auth.articles.all')->with([
      'articles' => auth()->user()->articles()->orderBy('article_id', 'DESC')->paginate(3),
    ]);
  }

  public function my_courses() {
    $courses = User::where('id', auth()->id())
      ->with(
        'courses', function ($q) {
        $q->with('lectures');
        $q->with('enrolls', function ($q) {
          $q->with('user');
        });
      })
      ->get()->first();
    return view('auth.courses.all')->with('courses', $courses);
  }

  public function my_steps() {
    return view('auth.howto.all')->with([
      'steps' => auth()->user()->steps()->orderBy('h_id', 'DESC')->paginate(6),
    ]);
  }

  public function my_activity() {
    return view('auth.my-activity')->with([
      'activities' => auth()->user()->activities()->orderBy('ac_id', 'DESC')->paginate(4)
    ]);
  }

  public function my_enrolled_courses() {
    $my_enrolled = Enrollments::where('enroll_user', id())->get();
    return view('auth.my-enrolls')->with('enrolls', $my_enrolled);
  }

  public function my_bookmarks() {
    return view('auth.bookmarks');
  }

  public function delete_account_view() {
    return view('auth.delete-account');
  }
  public function delete_account_action(Request $request) {
    $request->validate([
      'password' => 'required',
      'username' => 'required'
    ]);
    if (username() === $request->input('username') && Hash::check($request->input('password'), auth()->user()->getAuthPassword())) {
      User::find(id())->delete();
      Session::flush();
      return redirect()->route('register');
    } else {
      dd('Not equall');
    }
    return view('auth.delete-account');
  }

  ############################################################################

  #### Profile Actions ####
  public function profile_picture_view() {
    return view('auth.change-picture');
  }
  public function profile_picture_action(Request $request) {
    $file = $request->file('new_picture');
    $file_name = rand(0,10000) . time() . '_' . username() . '.' . $file->getClientOriginalExtension();
    $path = 'uploads/user_pics/';
    $file->move($path, $file_name);
    User::where('id', auth()->id())->update([
      'picture' => $path . $file_name
    ]);
    UserActivity::add_activity(
      'New Profile Picture has added!',
      "Profile picture {$file->getFilename()} has been updated for profile!",
      route('profile.change.picture'),
      'image'
    );
    session()->flash('msg', 'Profile picture has been updated successfully!');
    return redirect()->route('profile');
  }

  public function profile_password_view() {
    return view('auth.change-password');
  }
  public function profile_password_action(Request $request) {
    $request->validate([
      'old_password' => 'required',
      'new_password' => 'required|min:8|max:20'
    ]);
    if (Hash::check($request->input('old_password'), auth()->user()->getAuthPassword())) {
      User::where('id', auth()->id())->update([
        'password' => Hash::make($request->input('new_password'))
      ]);
      UserActivity::add_activity(
        'Password has been changed!',
        "Password has been changed in " . time_formatter(Carbon::now()),
        route('profile.change.password'),
        'user-lock'
      );
      session()->flash('msg', 'Password has been changed successfully!');
      return redirect()->route('profile');
    } else {
      session()->flash('msg', 'Old password does not match records!');
      return redirect()->route('profile.change.password');
    }
  }

  public function profile_contact_view() {
    return view('auth.change-contact');
  }
  public function profile_contact_action(Request $request) {
    $request->validate([
      'email' => 'required|email|max:255|unique:users,email,' . id(),
      'phone' => 'integer|required',
      'website' => 'required|url'
    ]);
    User::where('id', id())->update([
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'website' => $request->input('website'),
    ]);
    UserActivity::add_activity(
      'Contact information has been changed',
      "E-mail, Phone and website have been changed in " . time_formatter(Carbon::now()),
      route('profile.change.contact'),
      'user-lock'
    );
    session()->flash('msg', 'Contact information has been changed successfully!');
    return redirect()->route('profile');
  }

  public function profile_personal_view() {
    return view('auth.change-personal');
  }
  public function profile_personal_action(Request $request) {
    $request->validate([
      'username' => 'required|min:4|max:255|unique:users,username,' . id(),
      'firstname' => 'required|max:20',
      'lastname' => 'required|max:20',
      'job_title' => 'required|max:100',
      'skills' => 'required|max:255',
      'bio' => 'required|max:255'
    ]);
    User::where('id', id())->update([
      'username' => $request->input('username'),
      'firstname' => $request->input('firstname'),
      'lastname' => $request->input('lastname'),
      'job_title' => $request->input('job_title'),
      'skills' => $request->input('skills'),
      'bio' => $request->input('bio'),
    ]);
    UserActivity::add_activity(
      'Personal information has been changed',
      "[Username, Full name, job title, skills, Bio] have been changed in " . time_formatter(Carbon::now()),
      route('profile.change.personal'),
      'user-lock'
    );
    session()->flash('msg', 'Personal information has been changed successfully!');
    return redirect()->route('profile');
  }

  ############################################################################

  #### Step Articles Actions ####

  #### Action: Add New Howto Article ####
  public function add_howto_view() {
    return view('auth.howto.add');
  }
  public function add_howto_action(Request $request) {
    $request->validate([
      'article_title' => 'required|min:10|max:255',
      'article_keywords' => 'required|max:255|min:10',
      'article_tags' => 'required|max:255',
      'article_content' => 'required|max:100000|min:1000',
    ]);
    Steps::create([
      'h_title' => $request->input('article_title'),
      'h_keywords' => $request->input('article_keywords'),
      'h_content' => $request->input('article_content'),
      'h_tags' => $request->input('article_tags'),
      'h_status' => $request->has('is_private') ? 1 : 0,
      'h_user' => id(),
      'h_admin' => 1,
    ]);
    UserActivity::add_activity(
      'New How to article has been added successfully!',
      "How to article: {$request->input('article_title')} has been published successfully and anyone can enroll onto it!",
      route('profile.howto.add'),
      'plus'
    );
    session()->flash('msg', 'Howto Article Has been published successfully!');
    return redirect()->route('profile');
  }

  #### Action: Add Lecture to Course ####
  public function add_step_view($howto_id) {
    $is_mine_article = Steps::where([
      ['h_id', $howto_id],
      ['h_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.howto.add-step')->with('article', $is_mine_article);
    }
    abort(404);
    return view('errors.404');
  }
  public function add_step_action($howto_id, Request $request) {
    $request->validate([
      'step_title' => 'required|min:10|max:255',
      'step_content' => 'required|min:50',
    ]);

    InnerSteps::create([
      'step_title' => $request->input('step_title'),
      'step_content' => $request->input('step_content'),
      'belongs_to' => $howto_id,
    ]);
    UserActivity::add_activity(
      'New Step has been added successfully!',
      "Step {$request->input('step_title')} has been added.",
      route('profile.howto.add.step', $howto_id),
      'plus'
    );
    session()->flash('msg', 'Step Has been published successfully!');
    return redirect()->route('profile.howto');
  }

  #### Action: Update Course of {ID} ####
  public function update_step_view($howto_id, $step_id) {
    $is_mine_article = Steps::where([
      ['h_id', $howto_id],
      ['h_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      $step = InnerSteps::find($step_id);
      return view('auth.howto.update-step')->with('step', $step);
    }
    abort(404);
    return view('errors.404');
  }
  public function update_step_action($howto_id, $step_id, Request $request) {
    $request->validate([
      'step_title' => 'required|min:10|max:255',
      'step_content' => 'required|min:50',
    ]);

    InnerSteps::where('step_id', $step_id)->update([
      'step_title' => $request->input('step_title'),
      'step_content' => $request->input('step_content'),
    ]);
    UserActivity::add_activity(
      'New Step has been updated successfully!',
      "Step {$request->input('step_title')} has been updated.",
      route('profile.howto.update.step', [$howto_id, $step_id]),
      'wrench'
    );
    session()->flash('msg', 'Step Has been updated successfully!');
    return redirect()->route('profile.howto');
  }

  #### Action: Update Course of {ID} ####
  public function delete_step_view($howto_id, $step_id) {
    $is_mine_article = Steps::where([
      ['h_id', $howto_id],
      ['h_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      $step = InnerSteps::find($step_id);
      return view('auth.howto.delete-step')->with('step', $step);
    }
    abort(404);
    return view('errors.404');
  }
  public function delete_step_action($howto_id, $step_id, Request $request) {
    InnerSteps::find($step_id)->delete();
    UserActivity::add_activity(
      'Step has been deleted successfully!',
      "Step has been updated at " . time_formatter(Carbon::now()),
      route('profile.howto'),
      'trash'
    );
    session()->flash('msg', 'Step Has been updated successfully!');
    return redirect()->route('profile.howto');
  }

  #### Action: Update howto article of {ID} ####
  public function update_howto_view($howto_id) {
    $is_mine_article = Steps::where([
      ['h_id', $howto_id],
      ['h_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.howto.update')->with('h', $is_mine_article);
    }
    return view('errors.404');
  }
  public function update_howto_action($howto_id, Request $request) {
    $request->validate([
      'article_title' => 'required|min:10|max:255',
      'article_keywords' => 'required|max:255|min:10',
      'article_tags' => 'required|max:255',
      'article_content' => 'required|min:1000',
    ]);
    Steps::where('h_id', $howto_id)->update([
      'h_title' => $request->input('article_title'),
      'h_keywords' => $request->input('article_keywords'),
      'h_content' => $request->input('article_content'),
      'h_tags' => $request->input('article_tags'),
      'h_status' => $request->has('is_private') ? 1 : 0,
      'h_user' => id(),
      'h_admin' => 1,
    ]);
    UserActivity::add_activity(
      'New How to article has been added successfully!',
      "How to article: {$request->input('article_title')} has been published successfully and anyone can enroll onto it!",
      route('profile.howto.add'),
      'wrench'
    );
    session()->flash('msg', 'Howto Article Has been published successfully!');
    return redirect()->route('profile');
  }

  #### Action: Delete Course of {ID} ####
  public function delete_howto_view($howto_id) {
    $is_mine_article = Steps::where([
      ['h_id', $howto_id],
      ['h_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.howto.delete')->with('h', $is_mine_article);
    }
    abort(404);
    return view('errors.404');
  }
  public function delete_howto_action($howto_id, Request $request) {
    Steps::find($howto_id)->delete();
    UserActivity::add_activity(
      'Article of ID: ' . $howto_id . ' Has been deleted successfully!',
      "Article has been deleted successfully at " . time_formatter(Carbon::now()) ." and you can't restore it again!",
      route('profile.howto'),
      'trash'
    );
    session()->flash('msg', 'How to Article Has been deleted successfully!');
    return redirect()->route('profile.howto');
  }

  #### Action: View Course of {ID} ####
  public function view_howto_view($howto_id) {
    $is_mine_article = Steps::where([
      ['h_id', $howto_id],
      ['h_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.howto.view')->with([
        'howto' => $is_mine_article,
        'steps' => Steps::find($howto_id)->inner_steps()->orderBy('step_id')->get()
      ]);
    }
    abort(404);
    return view('errors.404');
  }

  #### Action: View Lecture of Course {COURSE_ID} of Lecture {LECTURE_ID} ####
  public function view_step_view($course_id, $lecture_id) {
    $is_mine_course = Courses::where([
      ['course_id', $course_id],
      ['course_user', auth()->id()]
    ])->get()->first();
    $is_mine_lecture = CourseLectures::where([
      ['lecture_id', $lecture_id],
      ['lecture_course', $course_id]
    ])->get()->first();
    if ($is_mine_course && $is_mine_lecture) {
      return view('auth.courses.view-lecture')->with([
        'course' => $is_mine_course,
        'lecture' => $is_mine_lecture,
        'lectures' => Courses::find($course_id)->lectures,
      ]);
    }
    return view('errors.404');
  }

  ############################################################################

  #### Article Actions ####

  #### Action: Add New Article ####
  public function add_article_view() {
    return view('auth.articles.add');
  }
  public function add_article_action(Request $request) {
    $request->validate([
      'article_title' => 'required|min:10|max:255',
      'article_tags' => 'required|min:5|max:255',
      'article_keywords' => 'required|min:5|max:255',
      'article_content' => 'required|min:1000',
    ]);
    Articles::create([
      'article_title' => $request->input('article_title'),
      'article_tags' => $request->input('article_tags'),
      'article_keywords' => $request->input('article_keywords'),
      'article_content' => $request->input('article_content'),
      'article_user' => auth()->id(),
      'article_admin' => 1
    ]);
    UserActivity::add_activity(
      'New Article has been added successfully!',
      "Article {$request->input('article_title')} has been published successfully and anyone can see it!",
      route('profile.articles.add'),
      'plus'
    );
    session()->flash('msg', 'Article Has been published successfully!');
    return redirect()->route('profile.articles');
  }

  #### Action: Update Article ####
  public function update_article_view($article_id) {
    $is_mine_article = Articles::where([
      ['article_id', $article_id],
      ['article_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.articles.update')->with('article', $is_mine_article);
    }
    return auth()->id();
  }
  public function update_article_action($article_id, Request $request) {
    $request->validate([
      'article_title' => 'required|min:10|max:255',
      'article_tags' => 'required|min:5|max:255',
      'article_keywords' => 'required|min:5|max:255',
      'article_content' => 'required|min:1000',
    ]);
    Articles::where('article_id', $article_id)->update([
      'article_title' => $request->input('article_title'),
      'article_tags' => $request->input('article_tags'),
      'article_keywords' => $request->input('article_keywords'),
      'article_content' => $request->input('article_content'),
      'status' => $request->has('article_status') ? 0 : 1,
    ]);
    UserActivity::add_activity(
      'Article of ID: ' . $article_id . ' Has been updated successfully!',
      "Article {$request->input('article_title')} has been updated successfully and anyone can see it!",
      route('profile.articles.update', $article_id),
      'wrench'
    );
    session()->flash('msg', 'Article Has been Updated successfully!');
    return redirect()->route('profile.articles');
  }

  #### Action: Delete Article of {ID} ####
  public function delete_article_view($article_id) {
    $is_mine_article = Articles::where([
      ['article_id', $article_id],
      ['article_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.articles.delete')->with('article', $is_mine_article);
    }
    abort(404);
    return view('errors.404');
  }
  public function delete_article_action($article_id, Request $request) {
    Articles::find($article_id)->delete();
    UserActivity::add_activity(
      'Article of ID: ' . $article_id . ' Has been deleted successfully!',
      "Article has been deleted successfully and you can't restore it again!",
      route('profile.articles'),
      'trash'
    );
    session()->flash('msg', 'Article Has been deleted successfully!');
    return redirect()->route('profile.articles');
  }

  ############################################################################

  #### Course Actions ####

  #### Action: Add New Course ####
  public function add_course_view() {
    return view('auth.courses.add');
  }
  public function add_course_action(Request $request) {
    $request->validate([
      'course_title' => 'required|min:10|max:255',
      'course_content' => 'required|max:10000|min:1000',
      'course_main_link' => 'required|url|max:255',
    ]);
    Courses::create([
      'course_title' => $request->input('course_title'),
      'course_content' => $request->input('course_content'),
      'course_main_link' => $request->input('course_main_link'),
      'course_category' => $request->input('course_category'),
      'is_private' => $request->has('is_private') ? 1 : 0,
      'course_user' => id(),
      'course_admin' => 1,
    ]);
    UserActivity::add_activity(
      'New Course has been added successfully!',
      "Course {$request->input('course_title')} has been published successfully and anyone can enroll onto it!",
      route('profile.courses.add'),
      'plus'
    );
    session()->flash('msg', 'Course Has been published successfully!');
    return redirect()->route('profile.courses');
  }

  #### Action: Add Lecture to Course ####
  public function add_lecture_view($course_id) {
    $is_mine_article = Courses::where([
      ['course_id', $course_id],
      ['course_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.courses.add-lecture')->with('course', $is_mine_article);
    }
    return view('errors.404');
  }
  public function add_lecture_action($course_id, Request $request) {
    $course = Courses::find($course_id);
    $request->validate([
      'lecture_title' => 'required|min:10|max:255',
      'lecture_youtube_link' => 'required|url',
      'lecture_video' => 'required|mimes:mp4,avi,wmv|max:409600',
      'lecture_file' => 'required|mimes:pdf|max:10240',
      'lecture_content' => 'required|max:10000',
    ]);
    $video = $request->file('lecture_video');
    $file = $request->file('lecture_file');

    $video_path = 'uploads/lecture_videos/';
    $video_name = time() . rand(1000, 1000000) . $video->getFilename() . '.' . $video->getClientOriginalExtension();
    $video->move($video_path, $video_name);

    $file_path = 'uploads/lecture_files/';
    $file_name = time() . rand(1000, 1000000) . $file->getFilename() . '.' . $file->getClientOriginalExtension();
    $file->move($file_path, $file_name);

    CourseLectures::create([
      'lecture_title' => $request->input('lecture_title'),
      'lecture_youtube' => $request->input('lecture_youtube_link'),
      'lecture_content' => $request->input('lecture_content'),
      'lecture_course' => $course_id,
      'lecture_file' => $file_path . $file_name,
      'lecture_video' => $video_path . $video_name,
    ]);
    UserActivity::add_activity(
      'New Lecture has been added successfully!',
      "Lecture {$request->input('lecture_title')} has been added to Course {$course->course_title}",
      route('profile.courses.add.lecture', $course_id),
      'plus'
    );
    session()->flash('msg', 'Lecture Has been published successfully!');
    return redirect()->route('profile.courses');
  }

  #### Action: Update Course of {ID} ####
  public function update_course_view($course_id) {
    $is_mine_article = Courses::where([
      ['course_id', $course_id],
      ['course_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.courses.update')->with('course', $is_mine_article);
    }
    return view('errors.404');
  }
  public function update_course_action($course_id, Request $request) {
    $request->validate([
      'course_title' => 'required|min:10|max:255',
      'course_content' => 'required|max:10000|min:1000',
      'course_main_link' => 'required|url|max:255',
    ]);
    Courses::where('course_id', $course_id)->update([
      'course_title' => $request->input('course_title'),
      'course_content' => $request->input('course_content'),
      'course_main_link' => $request->input('course_main_link'),
      'course_category' => $request->input('course_category'),
      'is_private' => $request->has('is_private') ? 1 : 0,
    ]);
    UserActivity::add_activity(
      "Course {$request->input('course_title')} has been updated successfully!",
      "Course {$request->input('course_title')} has been updated successfully at " . time_formatter(Carbon::now()),
      route('profile.courses.update', $course_id),
      'wrench'
    );
    session()->flash('msg', 'Course Has been updated successfully!');
    return redirect()->route('profile.courses');
  }

  #### Action: Delete Course of {ID} ####
  public function delete_course_view($course_id) {
    $is_mine_article = Courses::where([
      ['course_id', $course_id],
      ['course_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.courses.delete')->with('course', $is_mine_article);
    }
    return view('errors.404');
  }
  public function delete_course_action($course_id, Request $request) {
    Courses::find($course_id)->delete();
    UserActivity::add_activity(
      'Course of ID: ' . $course_id . ' Has been deleted successfully!',
      "Course has been deleted successfully at " . time_formatter(Carbon::now()) ." and you can't restore it again!",
      route('profile.courses'),
      'trash'
    );
    session()->flash('msg', 'Course Has been deleted successfully!');
    return redirect()->route('profile.courses');
  }

  #### Action: View Course of {ID} ####
  public function view_course_view($course_id) {
    $is_mine_article = Courses::where([
      ['course_id', $course_id],
      ['course_user', auth()->id()]
    ])->get()->first();
    if ($is_mine_article) {
      return view('auth.courses.view')->with([
        'course' => $is_mine_article,
        'lectures' => Courses::find($course_id)->lectures,
        'enrolls' => count(Courses::find($course_id)->enrolls)
      ]);
    }
    return view('errors.404');
  }

  public function course_enrolled_users($course_id) {
    $enrolls = Courses::find($course_id)->enrolls;
    return view('auth.courses.enrolled-users')->with([
      'enrolls' => $enrolls,
      'course' => Courses::find($course_id)
    ]);
  }

  #### Action: View Lecture of Course {COURSE_ID} of Lecture {LECTURE_ID} ####
  public function view_lecture_view($course_id, $lecture_id) {
    $is_mine_course = Courses::where([
      ['course_id', $course_id],
      ['course_user', auth()->id()]
    ])->get()->first();
    $is_mine_lecture = CourseLectures::where([
      ['lecture_id', $lecture_id],
      ['lecture_course', $course_id]
    ])->get()->first();
    if ($is_mine_course && $is_mine_lecture) {
      return view('auth.courses.view-lecture')->with([
        'course' => $is_mine_course,
        'lecture' => $is_mine_lecture,
        'lectures' => Courses::find($course_id)->lectures,
      ]);
    }
    return view('errors.404');
  }

  #### Action: Delete Lecture Of {COURSE_ID} and {LECTURE_ID} ####
  public function delete_lecture_view($course_id, $lecture_id) {
    $is_mine_course = Courses::where([
      ['course_id', $course_id],
      ['course_user', auth()->id()]
    ])->get()->first();
    $is_mine_lecture = CourseLectures::where([
      ['lecture_id', $lecture_id],
      ['lecture_course', $course_id]
    ])->get()->first();
    if ($is_mine_course && $is_mine_lecture) {
      return view('auth.courses.delete-lecture')->with([
        'course' => $is_mine_course,
        'lecture' => $is_mine_lecture,
        'lectures' => Courses::find($course_id)->lectures,
      ]);
    }
    return view('errors.404');
  }
  public function delete_lecture_action($course_id, $lecture_id, Request $request) {
    CourseLectures::find($lecture_id)->delete();
    $course = Courses::find($course_id);
    UserActivity::add_activity(
      'Lecture of course: ' . $course->course_title . ' Has been deleted successfully!',
      "Lecture has been deleted successfully at " . time_formatter(Carbon::now()) ." and you can't restore it again!",
      route('profile.courses'),
      'trash'
    );
    session()->flash('msg', 'Lecture Has been deleted successfully!');
    return redirect()->route('profile.courses.view', $course_id);
  }

  public function article_views($article_id) {
    return view('auth.articles.article-views')->with([
      'article' => Articles::find($article_id),
      'views' => Articles::find($article_id)->get_views
    ]);
  }

}
