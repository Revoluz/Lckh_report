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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Dokumen</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Dokumen</li>
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
                                <h3 class="card-title">Edit Dokumen</h3>
                            </div>
                            <form action="{{ route('document.update', ['document' => $document->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body d-flex flex-wrap">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama">Nama User</label>
                                            <select class="form-control select2bs4 @error('nama')is-invalid @enderror"
                                                value="{{ old('nama') }}" style="width: 100%" name="nama"
                                                id="nama">
                                                @foreach ($users as $user)
                                                    @if ($user->id == $document->user_id)
                                                        <option selected="selected" value="{{ $user->id }}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                        <label for="nama_dokumen">Nama Dokumen </label>
                                        <input type="text" value="{{ old('nama_dokumen', $document->name) }}"
                                            class="form-control @error('nama_dokumen') is-invalid @enderror"
                                            id="nama_dokumen" name="nama_dokumen" placeholder="Nama Dokumen" />
                                        @error('nama_dokumen')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label for="tipe_dokumen">Tipe Dokumen</label>
                                            <select
                                                class="form-control select2bs4 @error('tipe_dokumen')is-invalid @enderror"
                                                value="{{ old('tipe_dokumen') }}" style="width: 100%" name="tipe_dokumen"
                                                id="tipe_dokumen">
                                                @foreach ($document_types as $document_type)
                                                    @if ($document_type->id == $document->document_type_id)
                                                        <option selected="selected" value="{{ $document_type->id }}">
                                                            {{ $document_type->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $document_type->id }}">
                                                            {{ $document_type->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('tipe_dokumen')
                                                <div id="validationServer04Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="dokumen_bulan">Dokumen Bulan</label>
                                        <input type="month" value="{{ old('dokumen_bulan', $nama_bulan) }}"
                                            class="form-control @error('dokumen_bulan') is-invalid @enderror"
                                            id="dokumen_bulan" name="dokumen_bulan" />
                                        @error('dokumen_bulan')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="upload_dokumen">Upload Dokumen</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input  @error('upload_dokumen') is-invalid @enderror"
                                                    id="upload_dokumen" name="upload_dokumen" />
                                                <label class="custom-file-label" for="upload_dokumen">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        @error('upload_dokumen')
                                            <div id="validationServer04Feedback" class="invalid-feedback d-block">
                                                <p> {{ $message }}</p>
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
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $(".select2bs4").select2({
                theme: "bootstrap4",
            });
        });
    </script>
@endsection
