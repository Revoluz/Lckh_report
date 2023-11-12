@extends('layout.main')
@section('head')
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
                        <h1 class="m-0">Profile</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
            <div class="container-fluid pb-4">
                <div class="row flex-norow-reverse">
                    <!-- content-->
                    <div class="col-lg-7">
                        <!-- /.card -->
                        <div class="card h-100 card-primary">
                            <div class="card-header">
                                <h3 class="card-title">User Image</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="mt-3 pb-3 mb-3 d-flex flex-column">
                                    <div class="mx-2 my-2 text-center">
                                        <h5 class="m-0 text-center">Dokumen {{ $document->name }}</h5>
                                    </div>
                                    <div class="w-100 p-0 text-center">
                                        <iframe src="{{ $file }}" width="100%" height="750px"
                                            allow="autoplay"></iframe>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-primary h-100">
                            <div class="card-header d-flex align-items-center">
                                <h3 class="card-title">Informasi LCKH</h3>
                            </div>
                            <div class="card-body d-flex flex-wrap align-content-start">
                                <div class="form-group col-lg-6">
                                    <h5><b>Nama : </b></h5>
                                    <h5>{{ $document->name }}
                                    </h5>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5><b>Dokumen Bulan : </b></h5>
                                    <h5>{{ $nama_bulan }}
                                    </h5>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5><b>Tipe Dokumen : </b></h5>
                                    <h5>{{ $document->document_type->name }}
                                    </h5>
                                </div>
                            </div>
                        </div>
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
    <script>
        // Ambil semua elemen iframe pada halaman
        var iframes = document.querySelectorAll("iframe");

        // Iterasi melalui setiap iframe
        iframes.forEach(function(iframe) {
            // Ambil atribut src dari iframe
            var src = iframe.getAttribute("src");

            // Cek apakah link berisi '/view?'
            if (src && src.includes("/view")) {
                // Ganti '/view?' dengan '/preview?' pada link
                var newSrc = src.replace("/view", "/preview");

                // Setel kembali atribut src dengan link yang telah diubah
                iframe.setAttribute("src", newSrc);
            }
        });
    </script>
@endsection
