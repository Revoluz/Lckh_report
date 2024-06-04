@extends('layout.main')

@section('head')
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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah User</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah User
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
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah User</h3>
                            </div>
                            <form action="{{ route('status.update') }}" method="POST">
                                @csrf
                                <div class="card-body d-flex flex-wrap">
                                    <div class="form-group col-lg-6 select2-purple">
                                        </select>
                                        <label for="nama">Nama Pegawai:</label>
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
                                    <div class="form-group col-lg-6">
                                        <label for="status">Status</label>
                                        <select class="custom-select" name="status" required id="status">
                                            <option selected disabled @readonly(true)>-- Pilih Status --</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
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
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>


    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        function previewImage(input) {
            var preview = document.getElementById("imagePreview");
            preview.innerHTML = "";

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("img-fluid");

                    var deleteButton = document.createElement("button");
                    deleteButton.classList.add(
                        "btn",
                        "btn-danger",
                        "btn-sm",
                        "mt-1",
                        "w-100"
                    );
                    deleteButton.type = "button";
                    deleteButton.innerHTML =
                        '<i class="fas fa-trash"></i> Hapus';
                    // deleteButton.textContent = "Hapus";

                    deleteButton.addEventListener("click", function() {
                        // Hapus gambar
                        preview.innerHTML = "";

                        // Reset input file
                        input.value = "";

                        // Reset label
                        var label = input.nextElementSibling;
                        label.textContent = "Choose file";
                    });

                    preview.appendChild(img);
                    preview.appendChild(deleteButton);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

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
                                    text: item.name + ' - ' + item.nip,
                                }
                            })
                        }
                    }
                }
            });
        });
    </script>
@endsection
