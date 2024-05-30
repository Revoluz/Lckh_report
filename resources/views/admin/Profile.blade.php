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
                <div class="row">
                    <!-- content-->
                    <div class="col-lg-5">
                        <!-- /.card -->
                        <div class="card h-100 card-primary">
                            <div class="card-header">
                                <h3 class="card-title">User Image</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="mt-3 pb-3 mb-3 d-flex flex-column">
                                    <div class="w-100 p-0 text-center">
                                        <img src="{{ $user->avatar() }}" class="rounded w-25 shadow-lg" alt="User Image " />
                                    </div>
                                    <div class="mx-2 my-2 text-center">
                                        <h5 class="m-0 text-center">{{ $user->name }}</h5>
                                        <p class="my-1 text-center btn btn-success">
                                            <b>{{ $user->role->role }} </b>
                                        </p>
                                        <h5>{{ $user->nip }}</h5>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-lg-7 mt-3 mt-lg-0">
                        <div class="card card-primary h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h3 class="card-title">Informasi User</h3>
                                @if (auth()->user()->role->role == 'Administrator')
                                    <a href="{{ route('userAdmin.edit', ['nip' => $user->nip]) }}" class="ml-auto">
                                        <button type="button" class="btn btn-success mb-0  text-white light">
                                            Edit Profile <i class="fas fa-edit  mx-2"></i>
                                        </button>
                                    </a>
                                @else
                                    <button type="button" class="btn btn-success mb-0 ml-auto" data-toggle="modal"
                                        data-target="#modal-edit-profile">
                                        Edit Profile <i class="fas fa-edit mx-2"></i>
                                    </button>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-wrap align-content-start">
                                <div class="form-group col-lg-6">
                                    <h5><b>NIP : </b></h5>
                                    <h5>{{ $user->nip }}</h5>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5><b>Nama : </b></h5>
                                    <h5>{{ $user->name }}</h5>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5><b>Email : </b></h5>
                                    <h5>{{ $user->email }}</h5>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5><b>Tempat Tugas : </b></h5>
                                    <h5>{{ $user->work_place->work_place }}</h5>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5><b>Status : </b></h5>
                                    <h5>{{ $user->status->status }}</h5>
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
    <!-- modal edit password -->
    <div class="modal fade" id="modal-edit-profile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masukan Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('update.profile', ['user' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="password">Edit Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror id="email"
                                placeholder="Edit Email" />
                            @error('email')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Edit Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror id="password"
                                placeholder="Edit Password" />
                            @error('password')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="image">Pas Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('image') is-invalid @enderror "
                                        id="image" name="image"  onchange="previewImage(this)"
                                        required />
                                    <label class="custom-file-label" for="image">Choose file</label>

                                </div>

                            </div>
                            @error('image')
                                <div id="validationServer04Feedback" class="invalid-feedback d-block">
                                    <p> {{ $message }}</p>
                                </div>
                            @enderror
                            <div class="mt-2" style="width: 200px" id="imagePreview"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary button-submit">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
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
@endsection
