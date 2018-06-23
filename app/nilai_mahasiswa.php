<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nilai_mahasiswa extends Model
{
  protected $fillable = [
      'id_kriteria', 'nilai', 'id_user', 'nim'
  ];

  public function userinput(){
    return $this->hasOne('App\users');
  }

  public function mahasiswainput(){
    return $this->belongsTo('App\datamahasiswa','nim','id');
  }

  public function kearahkriteria(){
    return $this->belongsTo('App\kriteria');
  }
}
