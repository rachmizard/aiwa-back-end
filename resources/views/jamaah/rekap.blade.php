<!DOCTYPE html>
<html lang=en>
<head>
	<meta charset="UTF-8">
	<title>Rekap Closing Jamaah</title>
</head>
<body>
        <table border='1'>
            <tr>
            <td>KODE</td>
            <td>NAMA MARKETING</td>
            <td>TOTAL</td>
            @foreach ($jadwal as $value) 
                <td> {{ Carbon\Carbon::parse($value->tgl_berangkat)->format('d-M-Y') }}</td>
            @endforeach
            </tr>
        @foreach ($list_agen as $value) 
            <tr>
            <td> {{ $value->id }}</td>
            <td> {{ $value->nama }}</td>
            <td> {{ App\Jamaah::where('marketing', $value->id)->where('periode', $this_periode)->count() }}</td>    
            @foreach($jadwal as $in)
            	<td> {{ App\Jamaah::where('marketing', $value->id)->where('tgl_berangkat', $in->tgl_berangkat)->where('periode', $this_periode)->count() }}</td>    
            @endforeach
        @endforeach
            </tr>
        </table>
</body>
</html>