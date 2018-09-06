<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datafakultas extends Model
{
    public function jurusan(){
      return $this->hasMany('App\datajurusan');
    }
    public function mahasiswa(){
      return $this->hasMany('App\datamahasiswa','id_fakultas');
    }
}
