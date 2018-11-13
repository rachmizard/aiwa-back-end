<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rekap Closing Jamaah</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<td>Nama Marketing</td>
				<td>TOTAL</td>
				@foreach($jadwals as $jadwal)
					<td>{{ $jadwal['tgl_berangkat'] }}</td>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach($agents as $agent)
			<tr>
				<td>{{ $agent['nama'] }}</td>
			@endforeach
			@foreach($count as $key => $value)
			<td>{{ json_encode($value, true) }}</td>
			@endforeach
			</tr>
		</tbody>
	</table>
</body>
</html>