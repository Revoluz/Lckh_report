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
                                            <select class="form-control select2User @error('nama')is-invalid @enderror"
                                                value="{{ old('nama') }}" style="width: 100%" name="nama"
                                                id="nama">
                                                        <option selected="selected" value="{{ $document->user_id }}">
                                                            {{ $document->user->name }}
                                                        </option>

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
                                                class="form-control select2DocumentType @error('tipe_dokumen')is-invalid @enderror"
                                                value="{{ old('tipe_dokumen') }}" style="width: 100%" name="tipe_dokumen"
                                                id="tipe_dokumen">
                                                        <option selected="selected" value="{{ $document->document_type->id }}">
                                                            {{ $document->document_type->name }}
                                                        </option>
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
                                    <div class="form-group col-lg-12">
                                        <label for="deskripsi">Deskripsi</label>
                                        <div class="input-group">
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                                aria-label="With textarea">{{ old('deskripsi', $document->description) }}</textarea>
                                        </div>
                                        @error('deskripsi')
                                            <div id="validationServer04Feedback" class="invalid-feedback d-block">
                                                <p> {{ $message }}</p>
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
        });
    </script>
    <script>
        $(document).ready(function() {
            //Initialize Select2 Elements

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
            $(".select2DocumentType").select2({
                theme: "bootstrap4",
                placeholder: 'Tipe Dokumen',
                ajax: {
                    url: "{{ route('select2.dataDocumentType') }}",
                    processResults: function({
                        data
                    }) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        }
                    }
                }
            });
        });
    </script>
@endsection
