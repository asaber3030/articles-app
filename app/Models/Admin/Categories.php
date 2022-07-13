<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
  use HasFactory;
  protected $table = 'categories';
  public static function all_categories() {
    return self::all();
  }
}
