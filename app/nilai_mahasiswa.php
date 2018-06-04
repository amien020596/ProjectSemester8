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
  public function kriteriainput(){
    return $this->hasOne('App\kriteria');
  }
  public function mahasiswainput(){
    return $this->hasOne('App\datamahasiswa');
  }
}
