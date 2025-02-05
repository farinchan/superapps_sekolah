<?php

namespace App\Http\Controllers\Back;

use App\Exports\PpdbRegistrationPath;
use App\Exports\PpdbUser as ExportsPpdbUser;
use App\Http\Controllers\Controller;
use App\Models\PpdbContact;
use App\Models\PpdbInformation;
use App\Models\PpdbPath;
use App\Models\PpdbRegistrationUser;
use App\Models\PpdbUser;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class PpdbController extends Controller
{

    public function informationSetting()
    {
        $data = [
            'title' => 'Informasi dan Pengaturan PPDB',
            'menu' => 'PPDB',
            'information' => PpdbInformation::first(),
        ];
        return view('back.pages.ppdb.information.index', $data);
    }

    public function informationSettingRegisterUpdate(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'registration_status' => 'nullable|boolean',
            'registration_message' => 'nullable',
        ], [
            'registration_status.required' => 'Status pendaftaran harus diisi',
            'registration_status.boolean' => 'Status pendaftaran harus berupa boolean',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PpdbInformation::updateOrCreate(
            ['id' => 1],
            ['registration_status' => $request->registration_status ? true : false, 'registration_message' => $request->registration_message]
        );

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function informationSettingUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'information' => 'required',
        ], [
            'information.required' => 'Informasi harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PpdbInformation::updateOrCreate(
            ['id' => 1],
            ['information' => $request->information]
        );

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function path()
    {
        $data = [
            'title' => 'Jalur Pendaftaran',
            'menu' => 'PPDB',
            'list_path' => PpdbPath::with(['schoolYear', 'registrationUsers'])->latest()->get(),
            'list_school_year' => SchoolYear::latest()->get(),
        ];
        // return response()->json($data);
        return view('back.pages.ppdb.path.index', $data);
    }

    public function pathStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'nullable',
            'wa_group' => 'nullable|url|max:255',
            'school_year_id' => 'required|integer',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'start_date.required' => 'Tanggal mulai harus diisi',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal',
            'end_date.required' => 'Tanggal selesai harus diisi',
            'end_date.date' => 'Tanggal selesai harus berupa tanggal',
            'wa_group.max' => 'Link Grup WA maksimal 255 karakter',
            'wa_group.url' => 'Link Grup WA harus berupa URL',
            'school_year_id.required' => 'Tahun ajaran harus diisi',
            'school_year_id.integer' => 'Tahun ajaran harus berupa angka',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PpdbPath::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'wa_group' => $request->wa_group,
            'school_year_id' => $request->school_year_id,
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function pathUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'nullable',
            'wa_group' => 'nullable|url|max:255',
            'school_year_id' => 'required|integer',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'start_date.required' => 'Tanggal mulai harus diisi',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal',
            'end_date.required' => 'Tanggal selesai harus diisi',
            'end_date.date' => 'Tanggal selesai harus berupa tanggal',
            'description.nullable' => 'Deskripsi harus berupa teks',
            'wa_group.nullable' => 'Link Grup WA harus berupa URL',
            'wa_group.max' => 'Link Grup WA maksimal 255 karakter',
            'school_year_id.required' => 'Tahun ajaran harus diisi',
            'school_year_id.integer' => 'Tahun ajaran harus berupa angka',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PpdbPath::find($id)->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'wa_group' => $request->wa_group,
            'school_year_id' => $request->school_year_id,
        ]);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function pathDestroy($id)
    {
        PpdbPath::find($id)->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function pathDetail($id)
    {
        $path = PpdbPath::with(['schoolYear', 'registrationUsers.user'])->find($id);
        $data = [
            'title' => $path->name,
            'menu' => 'PPDB',
            'sub_menu' => 'Jalur Pendaftaran',
            'list_school_year' => SchoolYear::latest()->get(),
            'path' => $path,
            'registration_users' => $path->registrationUsers,
        ];
        // return response()->json($data);
        return view('back.pages.ppdb.path.detail', $data);
    }

    public function pathReviewStudent(Request $request, $path_id, $registration_id){
        $data = [
            'title' => 'Review Calon Siswa',
            'menu' => 'PPDB',
            'sub_menu' => 'Jalur Pendaftaran',
            'path_id' => $path_id,
            'registration_id' => $registration_id,
            'registration_user' => PpdbRegistrationUser::with(['user.certificate', 'user.rapor', 'path'])->find($registration_id),

        ];
        // return response()->json($data);
        return view('back.pages.ppdb.path.review-student', $data);

    }

    public function pathReviewStudentUpdate(Request $request, $path_id, $registration_id)
    {
        $validator = Validator::make($request->all(), [
            'status_berkas' => 'required',
            'reason' => 'required',
        ], [
            'status.required' => 'Status harus diisi',
            'reason.required' => 'Tanggapan harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PpdbRegistrationUser::find($registration_id)->update([
            'status_berkas' => $request->status_berkas,
            'reason' => $request->reason,
        ]);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function pathExportStudent($path_id)
    {
        $path = PpdbPath::find($path_id);
        return Excel::download(new PpdbRegistrationPath($path_id), 'Data-pendaftar-' . Str::slug($path->name) . 'tahun-ajaran-' . $path->schoolYear->start_year . '-' . $path->schoolYear->end_year . '.xlsx');
    }

    public function pathKickStudent( $registration_id)
    {
        PpdbRegistrationUser::where('id', $registration_id)->delete();
        Alert::success('Berhasil', 'Calon siswa berhasil dihapus');
        return redirect()->back();
    }

    public function student()
    {
        $data = [
            'title' => 'Data Calon Siswa',
            'menu' => 'PPDB',
            'users' => PpdbUser::latest()->get(),
        ];
        return view('back.pages.ppdb.student.index', $data);
    }

    public function studentDetail($id)
    {
        $user = PpdbUser::with(['certificate', 'rapor'])->find($id);
        $data = [
            'title' => $user->name,
            'menu' => 'PPDB',
            'sub_menu' => 'Data Calon Siswa',
            'user' => $user,
        ];
        // return response()->json($data);
        return view('back.pages.ppdb.student.detail', $data);
    }

    public function studentDestroy($id)
    {
        PpdbUser::find($id)->delete();
        Alert::success('Berhasil', 'Calon siswa berhasil dihapus');
        return redirect()->back();
    }

    public function studentExport()
    {
        return Excel::download(new ExportsPpdbUser(), 'Data-pendaftar-PPDB.xlsx');
    }

    public function message()
    {
        $data = [
            'title' => 'Pesan',
            'menu' => 'PPDB',
            'list_message' => PpdbContact::latest()->get()
        ];
        return view('back.pages.ppdb.message.index', $data);
    }

    public function messageDestroy($id)
    {
        PpdbContact::find($id)->delete();
        Alert::success('Berhasil', 'Pesan berhasil dihapus');
        return redirect()->back();
    }
}
