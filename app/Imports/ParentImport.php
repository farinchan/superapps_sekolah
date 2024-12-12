<?php

namespace App\Imports;

use App\Models\ParentStudent;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ParentImport implements ToModel, WithHeadingRow, WithValidation
{
    public function __construct()
    {
        HeadingRowFormatter::default('none');
    }

    public function model(array $row)
    {

        $student = Student::where('NISN', $row['NISN'])->first();

        $user = new User([
            'password' => Hash::make($row['NIK']),
        ]);

        $user->save();
        $user->assignRole('siswa');

        $parent = new ParentStudent([
            'name' => $row['NAMA'],
            'nik' => $row['NIK'],
            'gender' => $row['JENIS_KELAMIN'],
            'no_telp' => $row['NOMOR_TELEPON'],
            'email' => $row['EMAIL'],
            'kebutuhan_khusus' => $row['PROFESSION'],
            'user_id' => $user->id,
            'student_id' => $student->id,
        ]);

        return $parent;
    }

    public function rules(): array
    {
        return [
            'NAMA' => 'required',
            'NIK' => 'required|unique:parent_student,NIK',
            'JENIS_KELAMIN' => 'nullable',
            'NOMOR_TELEPON' => 'nullable',
            'EMAIL' => 'nullable|email',
            'PROFESSION' => 'nullable',
            'NISN' => 'required|exists:student,NISN',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'NAMA.required' => 'Nama tidak boleh kosong',
            'NIK.required' => 'NIK tidak boleh kosong',
            'NIK.unique' => 'NIK sudah terdaftar',
            'JENIS_KELAMIN.required' => 'Jenis Kelamin tidak boleh kosong',
            'NOMOR_TELEPON.required' => 'Nomor Telepon tidak boleh kosong',
            'EMAIL.required' => 'Email tidak boleh kosong',
            'EMAIL.email' => 'Email tidak valid',
            'PROFESSION.required' => 'Profesi tidak boleh kosong',
            'NISN.required' => 'NISN Siswa tidak boleh kosong',
            'NISN.exists' => 'NISN Siswa tidak terdaftar',
        ];
    }

}
