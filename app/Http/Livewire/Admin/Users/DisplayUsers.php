<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Admin\Users;
use Livewire\Component;

class DisplayUsers extends Component {
  public $search = '';
  public function render() {
    if (isset($_GET['search'])) {
      $this->search = htmlspecialchars_decode($_GET['search']);
    }
    return view('livewire.admin.users.display-users')->with([
      'users' => Users::filter_users($this->search),
    ]);
  }
}
