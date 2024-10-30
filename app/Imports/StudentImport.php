<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class StudentImport implements ToModel, WithHeadingRow, WithValidation
{

    public function __construct()
    {
        HeadingRowFormatter::default('none');
    }

    public function model(array $row)
    {
        $user = new User([
            'password' => Hash::make($row['NISN']),
        ]);

        $user->save();
        $user->assignRole('siswa');

        $student = new Student([
            'name' => $row['NAMA'],
            'nisn' => $row['NISN'],
            'nik' => $row['NIK'],
            'birth_place' => $row['TEMPAT_LAHIR'],
            'birth_date' => $row['TANGGAL_LAHIR'],
            'gender' => $row['JENIS_KELAMIN'],
            'address' => $row['ALAMAT'],
            'no_telp' => $row['NOMOR_TELEPON'],
            'email' => $row['EMAIL'],
            'kebutuhan_khusus' => $row['KEBUTUHAN_KHUSUS'],
            'disabilitas' => $row['DISABILITAS'],
            'father_name' => $row['NAMA_AYAH'],
            'mother_name' => $row['NAMA_IBU'],
            'user_id' => $user->id,
        ]);

        return $student;
    }

    public function rules(): array
    {
        return [
            'NAMA' => 'required',
            'NISN' => 'required|unique:student,NISN',
            'NIK' => 'nullable|unique:student,NIK',
            'TEMPAT_LAHIR' => 'nullable',
            'TANGGAL_LAHIR' => 'nullable',
            'JENIS_KELAMIN' => 'nullable',
            'ALAMAT' => 'nullable|max:255',
            'NO_TELP' => 'nullable',
            'EMAIL' => 'nullable|email',
            'KEBUTUHAN_KHUSUS' => 'nullable',
            'DISABILITAS' => 'nullable',
            'NAMA_AYAH' => 'nullable',
            'NAMA_IBU' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'NAMA.required' => 'Nama tidak boleh kosong',
            'NISN.required' => 'NISN tidak boleh kosong',
            'EMAIL.email' => 'Email ada yang tidak valid',
            'NISN.unique' => 'NISN sudah ada yang sudah terdaftar',
            'NIK.unique' => 'NIK sudah ada yang sudah terdaftar',
        ];
    }
}
