<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Steps extends Model
{
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

  public static function apply_search($search) {
    return self::where('h_title', 'LIKE', '%' . $search . '%')
      ->orWhere('h_keywords', 'LIKE', '%' . $search . '%')
      ->get();
  }

  public function user() {
    return $this->belongsTo(User::class, 'h_user', 'h_id');
  }

  public function inner_steps() {
    return $this->hasMany(InnerSteps::class, 'belongs_to', 'h_id');
  }

}
