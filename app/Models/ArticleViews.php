<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleViews extends Model
{
  use HasFactory;
  protected $primaryKey = 'view_id';
  protected $table = 'article_views';
  protected $fillable = ['view_article', 'view_user'];
  public $timestamps = false;

  public static function count_views_of_article($article_id) {
    return self::where('view_article', $article_id)->count();
  }

  public function article() {
    return $this->belongsTo(Articles::class, 'view_article', 'view_id');
  }
}
