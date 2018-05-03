<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datajurusan extends Model
{
    public function fakultas(){
      return $this->belongsTo('App\datafakultas');
    }
    public function mahasiswa(){
      return $this->belongsTo('App\datamahasiswa');
    }
}
