<?php

namespace App\Http\Livewire\Admin\Steps;

use App\Models\Admin\Courses;
use App\Models\Admin\Steps;
use Livewire\Component;

class DisplaySteps extends Component
{
  public $search = '';
  public $col_order = 'h_id';
  public $order_type = 'DESC';
  public $orders = [
    'id' => 'ASC',
    'name' => 'ASC',
  ];

  public function render() {
    if (isset($_GET['search'])) $this->search = htmlspecialchars_decode($_GET['search']);
    return view('livewire.admin.steps.display-steps')->with([
      'steps' => Steps::all_steps_by_title($this->search, 10, $this->col_order, $this->order_type)
    ]);
  }
  public function change_order($col) {
    if ($col == 'id' && $this->orders['id'] == 'ASC') {
      $this->col_order = 'h_id';
      $this->orders['id'] = 'DESC';
      $this->order_type = 'DESC';
    } elseif ($col == 'id' && $this->orders['id'] == 'DESC') {
      $this->col_order = 'h_id';
      $this->orders['id'] = 'ASC';
      $this->order_type = 'ASC';
    }
    if ($col == 'name' && $this->orders['name'] == 'ASC') {
      $this->col_order = 'h_title';
      $this->orders['name'] = 'DESC';
      $this->order_type = 'DESC';
    } elseif ($col == 'name' && $this->orders['name'] == 'DESC') {
      $this->col_order = 'h_title';
      $this->orders['name'] = 'ASC';
      $this->order_type = 'ASC';
    }
  }
}
