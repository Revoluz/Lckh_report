<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Lckh_reports;
use App\Models\RecapDataLCKH;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RecapDataLCKHDataTable extends DataTable
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
            ->addColumn('date', function ($data) {
                return  $data->date = ucfirst(Carbon::parse($data->date)->locale('id')->isoFormat('MMMM YYYY'));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lckh_reports $model): QueryBuilder
    {
        return  $model->whereNotNull('monthly_report')
            ->select(DB::raw('date(monthly_report) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date','desc')
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('recapdatalckh-table')
            ->columns($this->getColumns())
            ->minifiedAjax(route('recapData.lckh'))
            ->dom('lBfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('date')->title('Upload Bulan'),
            Column::make('count')->title('Jumlah Upload LCKH'),
            // Column::make('monthly_report'),
            // Column::make('id'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'RecapDataLCKH_' . date('YmdHis');
    }
}
