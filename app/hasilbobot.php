<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hasilbobot extends Model
{
  protected $fillable = [
      'nilai', 'nim'
  ];
  public function datamahasiswa(){
    return $this->hasOne('App\datamahasiswa','nim','nim');
  }
}
