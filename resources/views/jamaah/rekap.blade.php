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
            <td> {{ $value->anggota->id }}</td>
            <td> {{ $value->anggota->nama }}</td>
            <td> {{ $value->total }}</td>    
            @foreach($jadwal as $in)
            	<td> {{ App\Jamaah::where('marketing', $value->anggota->id)->where('tgl_berangkat', $in->tgl_berangkat)->where('periode', $this_periode)->count() }}</td>    
            @endforeach
        @endforeach
            </tr>
            <tr>
                <td colspan="3">GRAND TOTAL</td>
                <td colspan="3">{{ $sum_total }}</td>
            </tr>
        </table>
</body>
</html>