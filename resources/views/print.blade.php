<table style="width:100%">
  <tr>
    <th>NIM</th>
    <th>Nilai</th>
    <th>Rank</th>
  </tr>
  @foreach ($id as $key => $nim)
  <tr>
    <td>{{$nim->nim}}</td>
    <td>{{$nim->nilai}}</td>
    <td>{{$loop->iteration}}</td>
  </tr>
  @endforeach
  </table>
