<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel,WithHeadingRow,WithValidation,SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'=> $row['nama'],
            'nip' => $row['nip'],
            'email' => $row['email'],
            'work_place_id' => $row['id_tempat_kerja'],
            'status_id' => 1,
            'role_id' => $row['id_role'],
            'password' => Hash::make($row['password']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    public function rules(): array
    {
        return [
            'nama'=>'required',
            'nip'=> 'required|numeric|unique:users,nip',
            'email' => 'nullable|email|unique:users',
            'id_tempat_kerja' => 'required|numeric',
            'id_role'=> 'required|numeric',
            'password' => 'required|min:8',

        ];
    }

}
