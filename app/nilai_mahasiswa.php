<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nilai_mahasiswa extends Model
{
  public function userinput(){
    return $this->hasOne('App\users');
  }
  public function kriteriainput(){
    return $this->hasOne('App\kriteria');
  }
  public function mahasiswainput(){
    return $this->hasOne('App\datamahasiswa');
  }
}
