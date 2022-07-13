<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
  use HasFactory;
  protected $table = 'admin_activity';
  protected $primaryKey = 'ac_id';
  protected $fillable = [
    'ac_admin',
    'ac_title',
    'ac_desc',
    'ac_icon',
    'ac_link'
  ];
  public $timestamps = false;

  public static function current_admin_activity() {
    return self::where('ac_admin', Admin::id())->orderBy('ac_id', 'ASC')->get();
  }
  public static function current_admin_activity_pag($pag = 5) {
    return self::where('ac_admin', Admin::id())->orderBy('ac_id', 'desc')->paginate($pag);
  }
  public static function latest_current_admin_activity($limit = 3) {
    return self::where('ac_admin', Admin::id())
      ->orderBy('ac_id', 'DESC')
      ->take($limit)
      ->get();
  }
}
