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
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('assets') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: 0.8" />
            <span class="brand-text font-weight-light">AdminLTE 3</span>
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
                        <h1 class="m-0">Tempat Tugas</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tempat Tugas</li>
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
                                <h3 class="card-title">Tempat Tugas</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <button type="button" class="btn btn-success mb-2 ml-auto" data-toggle="modal"
                                    data-target="#modal-tambah-tempat-tugas">
                                    Tambah Tempat Tugas <i class="ml-1 fas fa-plus"></i>
                                </button>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tempat Tugas</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($workPlaces as $workPlace)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $workPlace->work_place }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a
                                                            href="{{ route('workPlace.show', ['work_place' => $workPlace->id]) }}">
                                                            <button type="button" class="btn btn-info">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                                            data-target="#modal-edit-tempat-tugas{{ $workPlace->id }}">
                                                            <i class="fas fa-edit text-white"></i>
                                                        </button>
                                                        <form
                                                            action="{{ route('workPlace.destroy', ['work_place' => $workPlace->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tempat Tugas</th>
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
    <!-- modal  tambah tempat tugas-->
    <div class="modal fade" id="modal-tambah-tempat-tugas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masukan Tempat Tugas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('workPlace.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="tempat_tugas">Tempat Tugas</label>
                            <input type="text" name="tempat_tugas"
                                class="form-control @error('tempat_tugas')
                                is-invalid
                            @enderror"value="{{ old('tempat_tugas') }}"
                                id="tempat_tugas" placeholder="Masukan Tempat Tugas" />
                            @error('tempat_tugas')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- modal edit tempat tugas -->
    @foreach ($workPlaces as $workPlace)
        <div class="modal fade" id="modal-edit-tempat-tugas{{ $workPlace->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Masukan Tempat Tugas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('workPlace.update', ['work_place' => $workPlace->id]) }}" method="POST">
                        <div class="modal-body">
                            @method('put')
                            @csrf

                            <div class="form-group">
                                <label for="tempat_tugas">Edit Tempat Tugas</label>
                                <input type="text" name="tempat_tugas"
                                    class="form-control @error('tempat_tugas')
                                is-invalid
                            @enderror"value="{{ old('tempat_tugas', $workPlace->work_place) }}"
                                    id="tempat_tugas" placeholder="Masukan Tempat Tugas" />
                                @error('tempat_tugas')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>


                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach

    <!-- /.modal -->
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
