<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\LCKH;
use App\Models\Lckh_reports;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class LCKHDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('monthly_report', function ($data) {

                $nama_bulan = ucfirst(Carbon::parse($data->monthly_report)->locale('id')->isoFormat('MMMM YYYY'));
                return $nama_bulan;
            })
            ->editColumn('created_at', function ($data) {

                $tanggal_upload = ucfirst(Carbon::parse($data->upload_date)->locale('id')->isoFormat('DD MMMM YYYY'));
                return $tanggal_upload;
            })
            ->editColumn('id', function ($data) {
                return view('partials.datatable.CRUD-LCKH', ['data' => $data]);
                // return $data->id;
            })
            ->addColumn('nip', function ($data) {
                return $data->user->nip;
            })
            ->addColumn('name', function ($data) {
                return $data->user->name;
            })
            ->addColumn('work_place', function ($data) {
                return $data->user->work_place->work_place;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lckh_reports $model): QueryBuilder
    {
        return $model->where('user_id', $this->user->id)->orderBy('monthly_report', 'desc')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('lckh-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->responsive(true)
            ->autoWidth(false)
            // ->lengthChange(true)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('reset'),
                Button::make('reload')
            ])->pageLength(10);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('nip')->title('NIP'),
            Column::make('name')->title('Name'),
            Column::make('work_place')->title('Tempat Tugas'),
            Column::make('monthly_report')->title('Laporan Bulan'),
            Column::make('created_at')->title('Tanggal Upload'),
            Column::make('upload_document')->title('Link Dokumen'),
            Column::make('id')->title('Action')->searchable(false)->orderable(false),
            // Column::make('user_id')->title('Action')->orderable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LCKH_' . date('YmdHis');
    }
}