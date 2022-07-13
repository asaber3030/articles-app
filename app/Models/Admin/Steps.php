<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Steps extends Model {
  use HasFactory;
  protected $table = 'howto';
  protected $primaryKey = 'h_id';
  protected $fillable = [
    'h_title',
    'h_keywords',
    'h_content',
    'h_tags',
    'h_user',
    'h_admin',
  ];

  public static function all_steps_by_title(string $searchByTitle = '', int $paginate = 10, string $col = 'h_id', string $type = 'DESC') {
    return self::join('users', 'howto.h_user', 'users.id')
      ->join('admins', 'howto.h_admin', 'admins.admin_id')
      ->select('users.username', 'users.id', 'howto.*', 'admins.admin_username', 'admins.admin_id')
      ->where('howto.h_title', 'LIKE', '%' . $searchByTitle . '%')
      ->orderBy($col, $type)
      ->paginate($paginate);
  }

  public static function howto($id) {
    return self::join('users', 'howto.h_user', 'users.id')
      ->join('admins', 'howto.h_admin', 'admins.admin_id')
      ->select('users.username', 'users.id', 'howto.*', 'admins.admin_username', 'admins.admin_id')
      ->where('howto.h_id', $id)
      ->get()
      ->first();
  }

  public static function set_status(int $id, int $status) {
    return self::where('h_id', $id)->update([
      'h_status' => $status
    ]);
  }
  public static function restore_all() {
    return self::where('h_status', 1)->update([
      'h_status' => 0
    ]);
  }
  public static function delete_all() {
    return self::where('h_status', 0)->update([
      'h_status' => 1
    ]);
  }

  public static function last_5_articles($limit = 5) {
    return self::join('users', 'articles.article_user', 'users.id')
      ->select('users.username', 'users.id', 'articles.*', 'admins.admin_picture', 'admins.admin_username', 'admins.admin_id')
      ->join('admins', 'articles.article_admin', 'admins.admin_id')
      ->orderBy('articles.article_id', 'desc')
      ->take($limit)
      ->get();
  }

  public static function highest_views($limit = 3) {
    return self::join('users', 'articles.article_user', 'users.id')
      ->select('users.username', 'users.id', 'articles.*', 'admins.admin_picture', 'admins.admin_username', 'admins.admin_id')
      ->join('admins', 'articles.article_admin', 'admins.admin_id')
      ->take($limit)
      ->orderBy('articles.views', 'desc')
      ->get();
  }

  public static function highest_views_article() {
    return self::select('*')->orderBy('views', 'DESC')->first();
  }

  public static function longest_article() {
    return DB::select('select * from articles ORDER BY LENGTH(`article_content`) DESC LIMIT 1')[0];
  }

  public static function count_deleted() {
    return self::where('status', 0)->count();
  }
  public static function count_available() {
    return self::where('status', 1)->count();
  }

  public static function count_articles_by_user() {
    return self::where('article_admin', 1)->count();
  }
  public static function count_articles_by_admin() {
    return self::where('article_user', 1)->count();
  }
}
