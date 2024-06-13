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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">List Upload LCKH</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">List Upload LCKH</li>
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
                                <h3 class="card-title">Filter LCKH</h3>
                                <br />
                                <form method="get" action="{{ route('listlckh.filter') }}">
                                    <div class="d-md-flex" style="gap: 8px">
                                        <div class="flex-grow-1 form-group">
                                            <label for="tahun">Tahun:</label>
                                            <input type="number" class="form-control" id="tahun"
                                                name="tahun" />
                                        </div>
                                        <div class="flex-grow-2 form-group">
                                            <label for="bulan">Bulan:</label>
                                            <select class="custom-select select2" id="bulan" name="bulan">
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
                                        @if (auth()->user()->role->role != 'Pengawas')
                                            <div class="w-50 form-group">
                                                <label for="tempat_tugas">Tempat Tugas:</label>
                                                <select class="custom-select select2WorkPlace" id="tempat_tugas"
                                                    name="tempat_tugas">

                                                </select>
                                            </div>
                                        @endif

                                        <div class="w-50 form-group">
                                            <label for="nama">Nama Pegawai:</label>
                                            <select class="custom-select select2User" id="nama" name="nama">
                                            </select>
                                        </div>

                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            Filter
                                        </button>
                                        <a href="{{ route('listlckh.index') }}">
                                            <button type="button" class="btn btn-primary">
                                                Reset
                                            </button></a>
                                    </div>
                                </form>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <h3 class="card-title">List Upload LCKH</h3>
                                <br />
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
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            //Initialize Select2 Elements
            $(".select2").select2({
                theme: "bootstrap4",
            });

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
                                    text: item.name + ' - ' + item.nip
                                }
                            })
                        }
                    }
                }
            });
                        $(".select2WorkPlace").select2({
                theme: "bootstrap4",
                placeholder:'Tempat Tugas',
                ajax: {
                    url: "{{route('select2.dataWorkPlace')}}",
                    processResults : function({data}){
                        return{
                            results : $.map(data,function (item) {
                                return{
                                    id:item.id,
                                    text:item.work_place
                                }
                            })
                        }
                    }
                }
            });
        });
    </script>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endsection
