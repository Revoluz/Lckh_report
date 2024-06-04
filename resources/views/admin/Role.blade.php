@extends('layout.main')
@section('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
        <style>
        .select2.select2-container .select2-selection__choice,
        .select2-selection__choice__remove {
            background-color: #007bff;
            color: #fff !important;
            font-size: 18px;
        }

        .select2-selection__choice__remove {
            font-size: 20px !important;

        }
    </style>
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Role</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
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
                                <h3 class="card-title">Role</h3>
                                <br>
                                @if (Route::is('role.index'))
                                    <button type="button" class="btn btn-primary mb-2 ml-auto" data-toggle="modal"
                                        data-target="#modal-edit-role-user">
                                        Edit Role User <i class="ml-1 fas fa-edit"></i>
                                    </button>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
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
    <!-- /.content-wrapper -->
    <!-- /.modal -->
    {{-- modal edit tempat Tugas user --}}
    @if (Route::is('role.index'))
        <div class="modal fade" id="modal-edit-role-user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Role User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('role.editUser') }}" method="POST">
                        @csrf
                        <div class="card-body ">
                            <div class="form-group ">
                                </select>
                                <label for="nama">Nama User:</label>
                                <select class="custom-select select2User @error('nama') is-invalid @enderror"
                                    data-dropdown-css-class="select2-purple" multiple="multiple" id="nama"
                                    name="nama[]" multiple required>
                                </select>
                                @error('nama')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="role">User Role</label>
                                <select
                                    class="custom-select @error('role')
                                            is-invalid
                                        @enderror"
                                    name="role" id="role">
                                    <option selected disabled @readonly(true)>-- Pilih Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-md button-submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif

@endsection
@section('plugins')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <!-- Select2 -->
    @if (Route::is('role.index'))
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                //Initialize Select2 Elements
                $(".select2User").select2({
                    theme: "bootstrap4",
                    placeholder: 'Masukan Nama',
                    ajax: {
                        url: "{{ route('select2.dataUser') }}",
                        processResults: function({
                            data
                        }) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id,
                                        text: item.name + ' - ' + item.nip,
                                    }
                                })
                            }
                        }
                    }
                });
            });
        </script>
    @endif

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
