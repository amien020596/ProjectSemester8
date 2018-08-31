<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_profile extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];

  protected $fillable = [
      'firstname', 'lastname', 'address','user_id','picture'
  ];

  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
