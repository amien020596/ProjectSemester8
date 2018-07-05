<hr style="border-style:inset;border-width:2px;">
<br>
<table style="width:100%">
  <tr>
    <th style="font-size:18px;border:1px;text-align:center; ">NIM</th>
    <th style="font-size:18px;border:1px;text-align:center;">Nama</th>
    <th style="font-size:18px;border:1px;text-align:center;">Nilai</th>
    <th style="font-size:18px;border:1px;text-align:center;">jurusan</th>
    <th style="font-size:18px;border:1px;text-align:center;">Fakultas</th>
    <th style="font-size:18px;border:1px;text-align:center;">Rank</th>
  </tr>
  @foreach ($id as $key => $nim)
  <tr>
    <td style="font-size:14px;border:5px;text-align:center;">{{$nim->nim}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$nim->datamahasiswa->nama}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$nim->nilai}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$nim->datamahasiswa->jurusan->jurusan}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$nim->datamahasiswa->fakultas->fakultas}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$loop->iteration}}</td>
  </tr>
  @endforeach
  </table>
