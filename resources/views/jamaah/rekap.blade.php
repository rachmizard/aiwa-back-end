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
            @foreach ($unique_data as $value) 
                <td> {{ Carbon\Carbon::parse($value)->format('d-M-Y') }}</td>
            @endforeach
            </tr>
        @foreach ($list_agen as $value) 
        <?php  $total_by_periode = App\Jamaah::where('marketing', $value->anggota->id)->where('periode', $this_periode)->whereBetween('tgl_berangkat', [$start, $end])->count();  ?>
            <tr>
            <td> {{ $value->anggota->id }}</td>
            <td> {{ $value->anggota->nama }}</td>
            <td> {{ $total_by_periode }}</td> 
            @foreach($unique_data as $in)
                @if (App\Jamaah::where('marketing', $value->anggota->id)->where('tgl_berangkat', $in)->where('periode', $this_periode)->count() == 0) 
                    <td></td>
                @else
                    <td> {{ App\Jamaah::where('marketing', $value->anggota->id)->where('tgl_berangkat', $in)->where('periode', $this_periode)->count() }}</td>
                @endif
            @endforeach
        @endforeach
            </tr>
            <tr>
                <td colspan="2">GRAND TOTAL</td>
                <td>{{ $total_by_between }}</td>    
            @foreach($unique_data as $on)
                @if(App\Jamaah::where('tgl_berangkat', $on)->where('periode', $this_periode)->count() == 0)
                    <td></td>
                @else
                    <td>{{ App\Jamaah::where('tgl_berangkat', $on)->where('periode', $this_periode)->count() }}</td>
                @endif
            @endforeach
            </tr>
        </table>
</body>
</html>