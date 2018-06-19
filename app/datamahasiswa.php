<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datamahasiswa extends Model
{
  protected $primaryKey = 'nim';
  public $incrementing = false;

  protected $fillable = [
      'nim', 'nama', 'id_fakultas','id_jurusan'
  ];
  public function fakultas1(){
    return $this->hasOne('App\datafakultas');
  }
  public function jurusan(){
    return $this->hasOne('App\datajurusan');
  }
  public function mahasiswainput(){
    return $this->belongsTo('App\nilai_mahasiswa');
  }
}
