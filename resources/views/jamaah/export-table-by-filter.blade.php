<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Export View Jamaah</title>
</head>
<body>
	<table border="1" class="table table-striped table-bordered">
      <thead>
        <tr>
            <th>id</th>
            <th>tgl_daftar</th>
            <th>id_umrah</th>
            <th>id_jamaah</th>
            <th>nama</th>
            <th>tgl_berangkat</th>
            <th>tgl_pulang</th>
            <th>nama_marketing</th>
            <th>marketing</th>
            <th>staff</th>
            <th>no_telp</th>
            <th>marketing_fee</th>
            <th>diskon_marketing</th>
            <th>koordinator</th>
            <th>koordinator_fee</th>
            <th>top</th>
            <th>top_fee</th>
            <th>status</th>
            <th>tgl_transfer</th>
            <th>periode</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($query))
          @foreach($query->get() as $jamaah)
          <tr>
            <td>{{ $jamaah->id }}</td>
            <td>{{ $jamaah->tgl_daftar }}</td>
            <td>{{ $jamaah->id_umrah }}</td>
            <td>{{ $jamaah->id_jamaah }}</td>
            <td>{{ $jamaah->nama }}</td>
            <td>{{ $jamaah->tgl_berangkat }}</td>
            <td>{{ $jamaah->tgl_pulang }}</td>
            <td>{{ $jamaah['anggota']['nama'] }}</td>
            <td>{{ $jamaah->marketing }}</td>
            <td>{{ $jamaah->staff }}</td>
            <td>{{ $jamaah->no_telp }}</td>
            <td>{{ $jamaah->marketing_fee }}</td>
            <td>{{ $jamaah->diskon_marketing }}</td>
            <td>{{ $jamaah->koordinator }}</td>
            <td>{{ $jamaah->koordinator_fee }}</td>
            <td>{{ $jamaah->top }}</td>
            <td>{{ $jamaah->top_fee }}</td>
            <td>{{ $jamaah->status }}</td>
            <td>{{ $jamaah->tgl_transfer }}</td>                                    
            <td>{{ $jamaah->periode }}</td>                                       
          </tr>
          @endforeach
          @endif
      </tbody>
    </table>
</body>
</html>