<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hasilbobot extends Model
{
  protected $fillable = [
      'nilai', 'nim'
  ];
  protected $dates = ['deleted_at'];
  
  public function datamahasiswa(){
    return $this->hasOne('App\datamahasiswa','nim','nim');
  }
}
