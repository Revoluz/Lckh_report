<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Documents;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class DocumentsDataTable extends DataTable
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
            ->addColumn('name-user', function ($data) {
                return $data->user->name;
            })->addColumn('nip', function ($data) {
            $nip = $data->user->nip;
            return "$nip" ;
            })->editColumn('document_date', function ($data) {
                $tanggal_upload = ucfirst(Carbon::parse($data->document_date)->locale('id')->isoFormat('MMMM YYYY'));
                return $tanggal_upload;
            })->editColumn('created_at', function ($data) {
                $tanggal_upload = ucfirst(Carbon::parse($data->created_at)->locale('id')->isoFormat('DD MMMM YYYY'));
                return $tanggal_upload;
            })->editColumn('id', function ($data) {
            return view('partials.datatable.CRUD-Document', ['data' => $data]);
            // return $data->id;
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Documents $model): QueryBuilder
    {
        $userRole = auth()->user()->role->role;
        if ($userRole == 'User' || $userRole == 'Kepala kantor' || $userRole == 'Pengawas') {
            // $documents =  auth()->user()->documents;
            return $model->where('user_id', auth()->user()->id)->orderByDesc('document_date')->newQuery();
        }
        return $model->orderByDesc('document_date')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('documents-table')
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
            Column::make('name-user')->title('Nama User'),
            Column::make('nip')->title('NIP'),
            Column::make('name')->title('Nama Dokumen'),
            Column::make('document_type.name')->title('Tipe Dokumen'),
            Column::make('document_date')->title('Dokumen Bulan'),
            Column::make('created_at')->title('Tanggal Upload'),
            Column::make('id')->title('Action')->searchable(false)->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Documents_' . date('YmdHis');
    }
}
