<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class datamahasiswa extends Model
{
  protected $primaryKey = 'nim';
  public $incrementing = false;
  use SoftDeletes;
  protected $dates = ['deleted_at'];

  protected $fillable = [
      'nim', 'nama', 'id_fakultas','id_jurusan','id_user'
  ];
  public function fakultas1(){
    return $this->hasOne('App\datafakultas');
  }
  public function jurusan(){
    return $this->hasOne('App\datajurusan');
  }
  public function nilaiMahasiswa(){
    return $this->hasMany('App\nilai_mahasiswa','nim');
  }

}
