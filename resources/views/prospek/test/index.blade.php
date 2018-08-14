<table>
	<tr>
		<td>Nama</td>
		<td>Device Token</td>
	</tr>
	@foreach($prospeks as $on)
	<tr>
		<td>{{$on->nama}}</td>
		<td>{{$on->device_token}}</td>
	</tr>
	@endforeach
</table>
