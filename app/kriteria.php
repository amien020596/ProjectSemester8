<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kriteria extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];

  protected $fillable = [
      'kriteria', 'bobot', 'jenis'
  ];

  public function kearahnilia_mahasiswa(){
    return $this->hasmany('App\nilai_mahasiswa','id_kriteria','id');
  }
}
