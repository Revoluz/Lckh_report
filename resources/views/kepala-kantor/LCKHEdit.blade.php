@extends('layout.main')
@section('head')
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
        @include('partials.kepala-kantor.sidebar')

        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Upload LCKH</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Upload LCKH</li>
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
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Upload LCKH</h3>
                            </div>
                            <form action="{{ route('lckhKepalaKantor.update', ['lckh' => $lckh->id]) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="card-body d-flex flex-wrap">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <select class="form-control select2bs4  @error('nama')is-invalid @enderror"
                                                value="{{ old('nama') }}" style="width: 100%" name="nama"
                                                id="nama">
                                                Masukan Nama
                                                </option>
                                                @foreach ($users as $user)
                                                    @if ($user->id == $lckh->user_id)
                                                        <option selected value="{{ $user->id }}">{{ $user->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $user->id }}">{{ $user->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('nama')
                                                <div id="validationServer04Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="laporan_bulan">Laporan Bulan</label>
                                        <input type="month" value="{{ old('laporan_bulan', $monthly_report) }}"
                                            class="form-control @error('laporan_bulan') is-invalid @enderror"
                                            id="laporan_bulan" name="laporan_bulan" />
                                        @error('laporan_bulan')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="upload_document">Upload Dokumen</label>
                                        <input type="text" value="{{ old('upload_document', $lckh->upload_document) }}"
                                            class="form-control @error('upload_document') is-invalid @enderror"
                                            id="upload_document" placeholder="Masukan Link Google Drive"
                                            name="upload_document" />
                                        <small id="documentHelp" class="form-text text-gray text-bold">Masukan link dokumen
                                            yang telah di upload di google
                                            drive</small>
                                        @error('upload_document')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
@section('plugins')
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
