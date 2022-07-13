<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin\Admin;
use App\Models\Admin\Users;
use Livewire\Component;

class DisplayAdmins extends Component {
  public $search = '';
  public $col_order = 'admin_id';
  public $order_type = 'ASC';
  public $orders = [
    'id' => 'ASC',
    'name' => 'ASC',
  ];
  public function render() {
    if (isset($_GET['search'])) {
      $this->search = htmlspecialchars_decode($_GET['search']);
    }
    return view('livewire.admin.admins.display-admins')->with([
      'admins' => Admin::filter_admins($this->search, $this->col_order, $this->order_type),
    ]);
  }
  public function change_order($col) {
    if ($col == 'id' && $this->orders['id'] == 'ASC') {
      $this->col_order = 'admin_id';
      $this->orders['id'] = 'DESC';
      $this->order_type = 'DESC';
    } elseif ($col == 'id' && $this->orders['id'] == 'DESC') {
      $this->col_order = 'admin_id';
      $this->orders['id'] = 'ASC';
      $this->order_type = 'ASC';
    }
    if ($col == 'name' && $this->orders['name'] == 'ASC') {
      $this->col_order = 'admin_username';
      $this->orders['name'] = 'DESC';
      $this->order_type = 'DESC';
    } elseif ($col == 'name' && $this->orders['name'] == 'DESC') {
      $this->col_order = 'admin_username';
      $this->orders['name'] = 'ASC';
      $this->order_type = 'ASC';
    }
  }
}
