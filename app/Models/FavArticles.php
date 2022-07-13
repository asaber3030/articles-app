<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavArticles extends Model
{
  use HasFactory;
  protected $table = 'fav_articles';
  protected $primaryKey = 'fa_id';
  protected $fillable = [
    'fa_article',
    'fa_user'
  ];
  public $timestamps = false;

  public static function is_added_before($article_id, $user_id) {
    return self::where([
      ['fa_article', $article_id],
      ['fa_user', $user_id]
    ])->exists();
  }

  public static function store_favourite_article($article_id, $user_id) {
    return self::create([
      'fa_article' => $article_id,
      'fa_user' => $user_id
    ]);
  }
}
