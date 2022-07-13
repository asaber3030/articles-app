<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class CoursesAll extends Component
{
  public $search;
  public $order = 'ASC';
  public $status = true;
  public function render() {
    $courses = User::find(id())->courses()
      ->where('course_title', 'LIKE', '%' . $this->search . '%')
      ->orderBy('course_id', $this->order)->paginate(10);;
    return view('livewire.user.courses-all')->with('courses', $courses);
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
