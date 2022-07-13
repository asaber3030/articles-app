<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
  use HasFactory;

  protected $table = 'articles';
  protected $primaryKey = 'article_id';
  protected $fillable = [
    'article_title',
    'article_content',
    'article_admin',
    'article_user',
    'article_keywords',
    'article_tags',
    'views',
  ];

  public static function apply_search($search) {
    return self::where('article_title', 'LIKE', '%' . $search . '%')
      ->orWhere('article_keywords', 'LIKE', '%' . $search . '%')
      ->get();
  }

  public function get_views() {
    return $this->hasMany(ArticleViews::class, 'view_article', 'article_id');
  }

  public function user() {
    return $this->belongsTo(User::class, 'article_user', 'article_id');
  }
}
