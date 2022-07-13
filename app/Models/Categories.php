<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
  use HasFactory;
  protected $table = 'categories';
  protected $primaryKey = 'category_id';

  public static function category_name($id) {
    return self::find($id)->category_name;
  }
}
