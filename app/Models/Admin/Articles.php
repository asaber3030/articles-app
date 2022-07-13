<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Articles extends Model
{
  use HasFactory;
  protected $table = 'articles';
  protected $primaryKey = 'article_id';
  protected $hidden = ['article_user'];
  protected $fillable = [
    'article_title',
    'article_content',
    'article_admin',
    'article_user',
    'article_keywords',
    'article_tags',
    'views',
  ];

  public static function all_articles_by_title(string $searchByTitle = '', int $paginate = 10) {
    return self::join('users', 'articles.article_user', 'users.id')
      ->select('users.username', 'users.id', 'articles.*', 'admins.admin_username', 'admins.admin_id')
      ->join('admins', 'articles.article_admin', 'admins.admin_id')
      ->where('articles.article_title', 'LIKE', '%' . $searchByTitle . '%')
      ->paginate($paginate);
  }

  public static function article($id) {
    return self::join('users', 'articles.article_user', 'users.id')
      ->join('admins', 'articles.article_admin', 'admins.admin_id')
      ->select('users.username', 'users.id', 'articles.*', 'admins.admin_username', 'admins.admin_id')
      ->where('articles.article_id', $id)
      ->get()
      ->first();
  }

  public static function set_status(int $id, int $status) {
    return self::where('article_id', $id)->update([
      'status' => $status
    ]);
  }
  public static function restore_all() {
    return self::where('status', 0)->update([
      'status' => 1
    ]);
  }
  public static function delete_all() {
    return self::where('status', 1)->update([
      'status' => 0
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
