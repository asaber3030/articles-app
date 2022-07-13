<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InnerSteps extends Model
{
  use HasFactory;
  protected $table = 'howto_steps';
  protected $primaryKey = 'step_id';
  protected $fillable = [
    'belongs_to',
    'step_content',
    'step_title',
  ];

  public static function steps_of_article($h_id) {
    return self::join('howto', 'howto_steps.belongs_to', 'howto.h_id')
      ->where('howto_steps.belongs_to', $h_id)
      ->get();
  }

  public static function step($step_id) {
    return self::join('howto', 'howto_steps.belongs_to', 'howto.h_id')
      ->where('howto_steps.step_id', $step_id)
      ->get()
      ->first();
  }

  public static function delete_step($step_id) {
    return self::find($step_id)->delete();
  }


}
