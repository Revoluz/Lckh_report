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
                                <h3 class="card-title">Update User</h3>
                            </div>
                            <form action="{{ route('userAdmin.update', ['user' => $user->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="card-body d-flex flex-wrap">
                                    <div class="form-group col-lg-6">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" placeholder="Masukan NIP" name="nip"
                                            value="{{ old('nip', $user->nip) }}" />
                                        @error('nip')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" placeholder="Masukan Nama" name="nama"
                                            value="{{ old('nama', $user->name) }}" />
                                        @error('nama')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" placeholder="Masukan Email"
                                            name="email"value="{{ old('email', $user->email) }}" />
                                        @error('email')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="tempat_tugas">Tempat Tugas</label>
                                        <select class="custom-select @error('tempat_tugas') is-invalid @enderror "
                                            name="tempat_tugas" id="tempat_tugas">

                                            @foreach ($work_places as $work_place)
                                                @if ($work_place->id == $user->work_place_id)
                                                    <option selected value="{{ $work_place->id }}">
                                                        {{ $work_place->work_place }}
                                                    </option>
                                                @else
                                                    <option value="{{ $work_place->id }}">
                                                        {{ $work_place->work_place }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('tempat_tugas')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="role">User Role</label>
                                        <select
                                            class="custom-select @error('role')
                                            is-invalid
                                        @enderror"
                                            name="role" id="role">

                                            @foreach ($roles as $role)
                                                @if ($role->id == $user->role_id)
                                                    <option selected value="{{ $role->id }}">
                                                        {{ $role->role }}
                                                    </option>
                                                @else
                                                    <option value="{{ $role->id }}">
                                                        {{ $role->role }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="status">Status</label>
                                        <select class="custom-select" name="status" id="status">
                                            @foreach ($statuses as $status)
                                                @if ($status->id == $user->status_id)
                                                    <option selected value="{{ $status->id }}">
                                                        {{ $status->status }}
                                                    </option>
                                                @else
                                                    <option value="{{ $status->id }}">
                                                        {{ $status->status }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="image">Pas Foto</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input  @error('image') is-invalid @enderror"
                                                    id="image" name="image" onchange="previewImage(this)"
                                                    accept="image/*" />
                                                <label class="custom-file-label" for="image">Choose file</label>

                                            </div>

                                        </div>
                                        @error('image')
                                            <div id="validationServer04Feedback" class="invalid-feedback d-block">
                                                <p> {{ $message }}</p>
                                            </div>
                                        @enderror
                                        <div class="mt-2" style="width: 100px" id="imagePreview"></div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Password" name="password" value="{{ old('password') }}" />
                                        @error('password')
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Konfiramsi Password" />
                                        @error('password_confirmation')
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
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


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
@endsection
