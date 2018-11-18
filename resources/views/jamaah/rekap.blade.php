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
        {{ $total_by_periode = App\Jamaah::where('marketing', $value->anggota->id)->where('periode', $this_periode)->whereBetween('tgl_berangkat', [$start, $end])->count() }}
            <tr>
            <td> {{ $value->anggota->id }}</td>
            <td> {{ $value->anggota->nama }}</td>
            <td> {{ $total_by_periode }}</td> 
            @foreach($jadwal as $in)
                @if (App\Jamaah::where('marketing', $value->anggota->id)->where('tgl_berangkat', $in->tgl_berangkat)->where('periode', $this_periode)->count() == 0) 
                    <td></td>
                @else
                    <td> {{ App\Jamaah::where('marketing', $value->anggota->id)->where('tgl_berangkat', $in->tgl_berangkat)->where('periode', $this_periode)->count() }}</td>
                @endif
            @endforeach
        @endforeach
            </tr>
            <tr>
                <td colspan="2">GRAND TOTAL</td>
                <td>{{ $total_by_between }}</td>    
            @foreach($jadwal as $on)
                @if(App\Jamaah::where('tgl_berangkat', $on->tgl_berangkat)->where('periode', $this_periode)->count() == 0)
                    <td></td>
                @else
                    <td>{{ App\Jamaah::where('tgl_berangkat', $on->tgl_berangkat)->where('periode', $this_periode)->count() }}</td>
                @endif
            @endforeach
            </tr>
        </table>
</body>
</html>