@extends('layout.main')
@section('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
@endsection
@section('content')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link d-flex align-items-center ">
            <div class=" bg-white d-flex rounded justify-content-center align-items-center mr-2"
                style=" width:35px;height:35px">
                <i class="fab fa-dochub " style="color: #343a40"></i>
            </div>
            <span class="brand-text font-weight-bold"><b>e-Dok LCKH</b></span>
        </a>
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">List Upload Dokumen</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">List Upload Dokumen</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- content-->
                    <div class="col-12">
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Filter Dokumen</h3>
                                <br />
                                <form method="get" action="{{ route('document.filter') }}">
                                    @csrf
                                    <div class="d-md-flex" style="gap: 8px">
                                        <div class="flex-grow-1 form-group">
                                            <label for="tahun">Tahun:</label>
                                            <input type="number" min="2023" class="form-control" id="tahun"
                                                name="tahun" />
                                        </div>
                                        <div class="flex-grow-2 form-group">
                                            <label for="bulan">Bulan:</label>
                                            <select class="custom-select select2bs4" id="bulan" name="bulan">
                                                <option value="" selected>Bulan</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="flex-grow-2 form-group">
                                            <label for="tempat_tugas">Tempat Tugas:</label>
                                            <select class="custom-select select2bs4" id="tempat_tugas" name="tempat_tugas">
                                                <option @readonly(true) selected value="0">Tempat Tugas</option>
                                                @foreach ($work_places as $work_place)
                                                    <option value="{{ $work_place->id }}">{{ $work_place->work_place }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex-grow-1 form-group">
                                            <label for="nama">Nama Pegawai:</label>
                                            <select class="custom-select select2bs4" id="nama" name="nama">
                                                <option @readonly(true) value="0">Nama</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex-grow-1 form-group">
                                            <label for="tipe_dokumen">Tipe Dokumen:</label>
                                            <select class="custom-select select2bs4" id="tipe_dokumen" name="tipe_dokumen">
                                                <option @readonly(true) value="0">Tipe Dokumen</option>
                                                @foreach ($document_types as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            Filter
                                        </button>
                                        <a href="{{ route('document.index') }}">
                                            <button type="button" class="btn btn-primary">
                                                Reset
                                            </button>
                                        </a>
                                    </div>
                                </form>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <h3 class="card-title">List Upload LCKH</h3>
                                <br />
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama User</th>
                                            <th>Nama Dokumen</th>
                                            <th>Jenis Dokumen</th>
                                            <th>Dokumen Bulan</th>
                                            <th>Tanggal Upload</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($documents as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->user->name }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->document_type->name }}</td>
                                                <td>{{ $data->tanggal_upload }}</td>
                                                <td class="date">{{ $data->created_at }}</td>

                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('document.show', ['document' => $data->id]) }}">
                                                            <button type="button" class="btn btn-info">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('document.edit', ['document' => $data->id]) }}">
                                                            <button type="button" class="btn btn-warning">
                                                                <i class="fas fa-edit text-white"></i>
                                                            </button>
                                                        </a>
                                                        <form
                                                            action="{{ route('document.destroy', ['document' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        <a
                                                            href="{{ route('document.download', ['document' => $data->id]) }}">
                                                            <button type="button" class="btn btn-success">
                                                                <i class="fas fa-download text-white"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>No Data</p>
                                        @endforelse

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama User</th>
                                            <th>Nama Dokumen</th>
                                            <th>Jenis Dokumen</th>
                                            <th>Dokumen Bulan</th>
                                            <th>Tanggal Upload</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('plugins')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1")
                .DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    paging: true,
                    pageLength: 10, // menentukan jumlah data per halaman
                    pagingType: 'simple_numbers', // menambahkan panah navigasi
                    buttons: ["copy", "csv", "excel", "pdf", "print"],

                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");
            $("#example2").DataTable({
                lengthChange: false,
                searching: false,
                ordering: true,
                autoWidth: false,
                responsive: true,
            });
        });
    </script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Initialize Select2 Elements
            $(".select2bs4").select2({
                theme: "bootstrap4",
            });

        });
    </script>
@endsection
