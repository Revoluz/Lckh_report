<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->editColumn('id', function ($data) {
                return view('partials.datatable.CRUD-User', ['user' => $data]);
                // return $data;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->responsive(true)
            ->autoWidth(false)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('reset'),
                Button::make('reload'),
            ])
            ->lengthChange(true)
            ->paging(true)
            ->pageLength(10);
        // ->parameters([
        //     'dom'          => 'Bfrtip',
        //     'buttons'      => ['excel', 'csv'],
        // ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false),
            Column::make('nip')->title('NIP'),
            Column::make('name')->title('Nama'),
            Column::make('work_place.work_place')->title('Tempat Tugas'),
            Column::make('email')->title('Email'),
            Column::make('status.status')->title('Status'),
            Column::make('id')->title('Action')->orderable(false)->searchable(false)->exportable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
