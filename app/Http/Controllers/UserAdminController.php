<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Status;
use App\Models\Work_place;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {

        // return view('admin.UserList', ['users' => User::all()]);
        return $dataTable->render('admin.UserList');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.UserCreate', [
            // 'work_places' => Work_place::all(),
            'roles' => Role::all(),
            'statuses' => Status::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lakukan validasi data input
        $rules = [
            'nip' => 'required|numeric|unique:users,nip',
            'nama' => 'required',
            'email' => 'nullable|email|unique:users',
            'tempat_tugas' => 'required',
            'role' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|min:8|confirmed',
        ];

        $messages = [
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'tempat_tugas.required' => 'Tempat tugas wajib diisi.',
            'role.required' => 'Role wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'image.required' => 'Gambar wajib diupload.',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'File gambar harus dalam format JPEG, PNG, JPG, atau GIF.',
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'password.confirmed' => 'Password tidak cocok.',
        ];

        $validateData = $request->validate($rules, $messages);

        // Simpan image
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/images/user', $imageName);

        // Simpan data user menggunakan User::create()
        $user = User::create([
            'name' => $validateData['nama'],
            'nip' => $validateData['nip'],
            'email' => $validateData['email'],
            'work_place_id' => $validateData['tempat_tugas'],
            'status_id' => $validateData['status'],
            'role_id' => $validateData['role'],
            'password' => Hash::make($validateData['password']),
            'image' => $imageName,
        ]);
        // dd($user);
        // Jika data user berhasil disimpan, tampilkan pesan berhasil
        if ($user) {
            return redirect()->route('userAdmin.index')->with('success', 'User berhasil ditambahkan!');
        } else {
            // Jika data user gagal disimpan, tampilkan pesan gagal
            return redirect()->back()->with('error', 'User gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($nip)
    {
        // dd($nip);
        $user = User::where('nip', $nip)->first();
        $id = Auth::id();
        // dd($user);

        return view('admin.UserShow', [
            'user' => $user,
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nip)
    {
        $user = User::where('nip', $nip)->get();
        // dd($user)
        return view('admin.UserEdit', [
            'user' => $user[0],
            // 'work_places' => Work_place::all(),
            'roles' => Role::all(),
            'statuses' => Status::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'nama' => 'required',
            'tempat_tugas' => 'required',
            'role' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ];
        if ($request->nip != $user->nip) {
            $rules['nip'] =  'required|numeric|unique:users,nip';
        }
        if ($request->email != $user->email) {
            $rules['email'] =  'required|unique:users';
        }


        $validateData = $request->validate($rules);
        // dd($validateData);
        if ($request->nip != $user->nip) {
            # code...
            $user->nip = $validateData['nip'];
        }
        if ($request->email != $user->email) {
            # code...
            $user->email = $validateData['email'];
        }
        if (!$request->password == null) {
            # code...
            $user->password = Hash::make($validateData['password']);
        }
        if ($request->file('image')) {
            // Simpan image
            if ($user->image) {
                Storage::delete('public/images/user/' . $user->image);
            }
            $image = $request->file('image');
            // dd($request->file('image'));
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images/user', $imageName);
            $user->image = $imageName;
        }
        $user->name = $validateData['nama'];
        $user->work_place_id = $validateData['tempat_tugas'];
        $user->status_id = $validateData['status'];
        $user->role_id = $validateData['role'];
        if ($user->update()) {
            return redirect()->route('userAdmin.index')->with('success', 'User berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'User gagal diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Storage::exists('public/images/user/' . $user->image)) {
            Storage::delete('public/images/user/' . $user->image);
        }
        User::destroy($user->id);
        $user->delete();
        return redirect()->route('userAdmin.index')->with('success', 'Berhasil Menghapus data User');
    }

    public function updateProfileUser(Request $request, User $user)
    {

        $rules = [
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email',
        ];
        if ($request->email != $user->email) {
            $rules['email'] =  'required|unique:users';
        }

        $validateData = $request->validate($rules);
        if ($request->email != $user->email) {
            # code...
            $user->email = $validateData['email'];
        }
        // dd($validateData);
        // $user->password = Hash::make($validateData['password']);
        // $user->save();
        if ($request->file('image')) {
            // Simpan image
            if ($user->image) {
                Storage::delete('public/images/user/' . $user->image);
            }
            $image = $request->file('image');
            // dd($request->file('image'));
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images/user', $imageName);
            $user->image = $imageName;
        }
        if ($user->update()) {
            return redirect()->back()->with('success', 'Profile berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Profile gagal diubah!');
        }
    }
    public function profile()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403);
        }
        return view('admin.Profile', [
            'user' => $user,
        ]);
    }
    public function userImportExcel(Request $request)
    {
        $excel = $request->file('file');
        // dd($request->file('file'));
        $excelName = time() . '_' . $excel->getClientOriginalName();
        $excel->storeAs('public/excels/', $excelName);
        $import = new UserImport;
        $import->import(public_path('storage/excels/' . $excelName));
        if ($import->failures()) {
        $duplicates = [];
        $uniqueIdentifier = [];
        foreach ($import->failures() as $failure) {
            array_push($uniqueIdentifier, $failure->row());
            $duplicates = array_unique($uniqueIdentifier);
        }
        $duplicateCount = count($duplicates);

        // dd($duplicateCount);
        if ($duplicateCount > 0) {
            return back()->withErrors('Terdapat ' . $duplicateCount . ' data yang gagal di import.');
        }
        }
        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }
}
