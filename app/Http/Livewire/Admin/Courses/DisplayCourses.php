<?php

namespace App\Http\Livewire\Admin\Courses;

use App\Models\Admin\Courses;
use Livewire\Component;

class DisplayCourses extends Component
{
  public $search = '';
  public $col_order = 'course_id';
  public $order_type = 'ASC';
  public $orders = [
    'id' => 'ASC',
    'name' => 'ASC',
  ];

  public function render() {
    if (isset($_GET['search'])) $this->search = htmlspecialchars_decode($_GET['search']);
    return view('livewire.admin.courses.display-courses')->with([
      'courses' => Courses::all_courses_by_title($this->search, 10, $this->col_order, $this->order_type)
    ]);
  }
  public function change_order($col) {
    if ($col == 'id' && $this->orders['id'] == 'ASC') {
      $this->col_order = 'course_id';
      $this->orders['id'] = 'DESC';
      $this->order_type = 'DESC';
    } elseif ($col == 'id' && $this->orders['id'] == 'DESC') {
      $this->col_order = 'course_id';
      $this->orders['id'] = 'ASC';
      $this->order_type = 'ASC';
    }
    if ($col == 'name' && $this->orders['name'] == 'ASC') {
      $this->col_order = 'course_title';
      $this->orders['name'] = 'DESC';
      $this->order_type = 'DESC';
    } elseif ($col == 'name' && $this->orders['name'] == 'DESC') {
      $this->col_order = 'course_title';
      $this->orders['name'] = 'ASC';
      $this->order_type = 'ASC';
    }
  }
}
