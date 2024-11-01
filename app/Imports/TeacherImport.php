<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Teacher;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class TeacherImport implements ToModel, WithHeadingRow, WithValidation
{

    public function __construct()
    {
        HeadingRowFormatter::default('none');
    }

    public function model(array $row)
    {
        $user = new User([
            'password' => Hash::make($row['NIP']),
        ]);

        $user->save();
        $user->assignRole('guru');

        $teacher = new Teacher([
            'name' => $row['NAMA'],
            'nip' => $row['NIP'],
            'nik' => $row['NIK'],
            'birth_place' => $row['TEMPAT_LAHIR'],
            'birth_date' => $row['TANGGAL_LAHIR'],
            'gender' => $row['JENIS_KELAMIN'],
            'no_telp' => $row['NOMOR_TELEPON'],
            'email' => $row['EMAIL'],
            'address' => $row['ALAMAT'],
            'position' => $row['POSISI'],
            'type' => $row['TYPE'],
            'user_id' => $user->id,
        ]);

        return $teacher;
    }

    public function rules(): array
    {
        return [
            'NAMA' => 'required',
            'NIP' => 'required|unique:teacher,NIP',
            'NIK' => 'nullable|unique:teacher,NIK',
            'TEMPAT_LAHIR' => 'nullable',
            'TANGGAL_LAHIR' => 'nullable',
            'JENIS_KELAMIN' => 'nullable',
            'NOMOR_TELEPON' => 'nullable',
            'EMAIL' => 'nullable',
            'ALAMAT' => 'nullable|max:255',
            'POSISI' => 'nullable',
            'TYPE' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'NAMA.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah terdaftar',
            'NIK.unique' => 'NIK sudah terdaftar',
            'ALAMAT.max' => 'Alamat maksimal 255 karakter',
        ];
    }
}
