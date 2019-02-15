<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Jamaah;

class DownloadJamaahFiltered implements FromView, ShouldQueue
{

	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $periode;

    protected $nama_jamaah;

    protected $id_umrah;

    protected $id_jamaah;

    protected $marketing;

    protected $koordinator;

    public function __construct($periode, $nama_jamaah, $id_umrah, $id_jamaah, $marketing, $koordinator)
    {
    	$this->periode = $periode;

    	$this->nama_jamaah = $nama_jamaah;

    	$this->id_umrah = $id_umrah;

    	$this->id_jamaah = $id_jamaah;

    	$this->marketing = $marketing;

    	$this->koordinator = $koordinator;
    }

    public function view(): View
    {
        $query = Jamaah::select('*');

                if ($this->periode) {
                    $query->where('periode', $this->periode );
                }

                if ($this->nama_jamaah) {
                    $query->where('nama', 'LIKE', '%' . $this->nama_jamaah . '%');
                }

                if ($this->marketing) {
                    $query->where(function($q) {
                        $q->where('marketing', 'LIKE', '%' . $this->marketing . '%')
                            ->orWhereHas('anggota', function($q){
                                $q->where('nama', 'LIKE', '%' . $this->marketing . '%');
                            });
                    });
                }

                if ($this->id_umrah) {
                    $query->where('id_umrah', '=', $this->id_umrah);
                }

                if ($this->id_jamaah) {
                    $query->where('id_jamaah', '=', $this->id_jamaah);
                }

                if ($this->koordinator) {
                    $query->whereHas('koordinatorJamaah', function($q){
                        $q->where('id', '=', $this->koordinator);
                    });
                }

               return view('jamaah.export-table-by-filter', compact('query'));
    }
}
