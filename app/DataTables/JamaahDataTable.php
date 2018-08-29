<?php

namespace App\DataTables;

use App\Jamaah;
use Yajra\DataTables\Services\DataTable;

class JamaahDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'jamaah.index');
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Jamaah $model)
    {
        $jamaah = Jamaah::all();

        return $this->applyScopes($jamaah);
        // return $model->newQuery()->select('id', 'add-your-columns-here', 'created_at', 'updated_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    // ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    // ->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'tgl_daftar',
            'id_umrah',
            'id_jamaah',
            'nama',
            'tgl_berangkat',
            'tgl_pulang',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Jamaah_' . date('YmdHis');
    }
}
