<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
  use HasFactory;
  protected $fillable = [
    'ac_title',
    'ac_desc',
    'ac_icon',
    'ac_user',
    'ac_link',
  ];
  protected $primaryKey = 'ac_id';
  protected $table = 'user_activity';
  public $timestamps = false;

  public static function add_activity($title, $desc, $link, $icon) {
    return self::create([
      'ac_user' => auth()->id(),
      'ac_title' => $title,
      'ac_desc' => $desc,
      'ac_link' => $link,
      'ac_icon' => $icon
    ]);
  }

  public function user() {
    return $this->belongsTo(User::class, 'ac_user', 'ac_id');
  }

}
