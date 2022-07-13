<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InnerSteps extends Model
{
  use HasFactory;
  protected $primaryKey = 'step_id';
  protected $table = 'howto_steps';
  protected $fillable = [
    'step_title',
    'step_content',
    'belongs_to'
  ];

  public function howto() {
    return $this->belongsTo(Steps::class, 'belongs_to', 'step_id');
  }

}
