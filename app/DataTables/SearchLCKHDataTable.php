<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\User;
use App\Models\searchLCKH;
use App\Models\Lckh_reports;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SearchLCKHDataTable extends DataTable
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
        $tahun = request()->input('tahun');
        $bulan = request()->input('bulan');
        $tempat_tugas = request()->input('tempat_tugas');
        $nama = request()->input('nama');
        $query = $model->query();

        if (auth()->user()->role->role == 'Pengawas') {
            $tempat_tugas = '';
            $query = $query->where('work_place_id', auth()->user()->work_place->id);
        } else {
            // Filter by tempat_tugas if provided and user is not Pengawas
            if ($tempat_tugas) {
                $query = $query->whereHas('user', function ($userQuery) use ($tempat_tugas) {
                    $userQuery->where('work_place_id', $tempat_tugas);
                });
            }
        }

        if ($tahun) {
            $query->whereYear('monthly_report', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('monthly_report', $bulan);
        }


        if ($nama) {
            $query->where('user_id', $nama);
        }
        if(auth()->user()->role->role== 'Pengawas'){
            $user = auth()->user();
            $query->join('users', 'users.id', '=', 'lckh_reports.user_id',)
            ->where('work_place_id', $user->work_place->id)->select('lckh_reports.*')->get();
        }
        return $query->newQuery();
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
            ->lengthChange(true)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('reset'),
                Button::make('reload')
            ])->pageLength(2);
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
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'searchLCKH_' . date('YmdHis');
    }
}
