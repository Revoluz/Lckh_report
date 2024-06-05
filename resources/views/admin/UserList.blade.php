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
            <span class="brand-text font-weight-bold"><b>e-Dok Kepegawaian</b></span>
        </a>
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data User</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data User
                            </li>
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
                                <h3 class="card-title">
                                    Data User
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="{{ route('userAdmin.create') }}">
                                    <button type="button" class="btn btn-success mb-2 ml-auto">
                                        Tambah User
                                        <i class="ml-1 fas fa-plus"></i>
                                    </button>
                                </a>
                                <button type="button" class="btn btn-primary mb-2 ml-auto" data-toggle="modal"
                                    data-target="#modal-import-user">
                                    Tambah User Excel File
                                    <i class="ml-1 fas fa-plus"></i>
                                </button>
                                @if ($errors->all())
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                {{ $dataTable->table() }}
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
    <!-- Modal -->
    <div class="modal fade" id="modal-import-user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masukan File Excel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('userAdmin.import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="user">File Excle User</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('file') is-invalid @enderror"
                                        required id="file" name="file" />
                                    <label class="custom-file-label" for="file">Choose
                                        file</label>
                                </div>
                            </div>
                            @error('file')
                                <div id="validationServer04Feedback" class="invalid-feedback d-block">
                                    <p> {{ $message }}</p>
                                </div>
                            @enderror
                            <p class=" mb-0 text-danger">pastikan tidak ada header pada row excel</p>
                            <a href="{{ asset('example-excel/user-example-excel.ods') }}" download="user-test-excel.ods"
                                class=" d-block text-md m-0">contoh format file excel</a>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary button-submit">Submit</button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('plugins')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
    {{-- <script>
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
    </script> --}}
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            $(function() {
                bsCustomFileInput.init();
            });
            //Initialize Select2 Elements
        });
    </script>
@endsection
