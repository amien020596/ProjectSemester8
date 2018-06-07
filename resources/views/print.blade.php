<hr style="border-style:inset;border-width:2px;">
<br>
<table style="width:100%">
  <tr>
    <th style="font-size:18px;border:1px;text-align:center; ">NIM</th>
    <th style="font-size:18px;border:1px;text-align:center;">Nilai</th>
    <th style="font-size:18px;border:1px;text-align:center;">Rank</th>
    <th style="font-size:18px;border:1px;text-align:center;">Rank</th>
    <th style="font-size:18px;border:1px;text-align:center;">Rank</th>
  </tr>
  @foreach ($id as $key => $nim)
  <tr>
    <td style="font-size:14px;border:5px;text-align:center;">{{$nim->nim}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$nim->nilai}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$loop->iteration}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$loop->iteration}}</td>
    <td style="font-size:14px;border:5px;text-align:center;">{{$loop->iteration}}</td>
  </tr>
  @endforeach
  </table>
