<?php

namespace App\Http\Controllers\Back;

use App\Exports\PpdbExamScoreStudent;
use App\Exports\PpdbRegistrationPath;
use App\Exports\PpdbUser as ExportsPpdbUser;
use App\Http\Controllers\Controller;
use App\Imports\ImportPpdbExamMultipleChoice;
use App\Models\PpdbContact;
use App\Models\PpdbExam;
use App\Models\PpdbExamAnswer;
use App\Models\PpdbExamQuestion;
use App\Models\PpdbExamQuestionMultipleChoice;
use App\Models\PpdbExamSchedule;
use App\Models\PpdbExamScheduleUser;
use App\Models\PpdbExamSession;
use App\Models\PpdbInformation;
use App\Models\PpdbPath;
use App\Models\PpdbRegistrationUser;
use App\Models\PpdbUser;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function pathReviewStudent(Request $request, $path_id, $registration_id)
    {
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

    public function pathKickStudent($registration_id)
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

    public function studentChangePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
        ], [
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PpdbUser::find($id)->update([
            'password' => bcrypt($request->password),
        ]);

        Alert::success('Berhasil', 'Password berhasil diubah');
        return redirect()->back();
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

    public function exam(Request $request)
    {
        $data = [
            'title' => 'Ujian',
            'menu' => 'PPDB',
            'list_exam' => PpdbExam::latest()->get(),
            'list_school_year' => SchoolYear::latest()->get(),
        ];
        return view('back.pages.ppdb.exam.index', $data);
    }

    public function examStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'duration' => 'required',
            'school_year_id' => 'required|integer',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'description.nullable' => 'Deskripsi harus berupa teks',
            'duration.required' => 'Durasi harus diisi',
            'school_year_id.required' => 'Tahun ajaran harus diisi',
            'school_year_id.integer' => 'Tahun ajaran harus berupa angka',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PpdbExam::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'school_year_id' => $request->school_year_id,
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function examSetting($id)
    {
        $exam = PpdbExam::find($id);
        $data = [
            'title' => $exam->name,
            'menu' => 'PPDB',
            'sub_menu' => 'Ujian',
            'exam' => $exam,
            'list_school_year' => SchoolYear::all(),
        ];
        return view('back.pages.ppdb.exam.detail-setting', $data);
    }

    public function examSettingUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'duration' => 'required',
            'school_year_id' => 'required|integer',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'description.nullable' => 'Deskripsi harus berupa teks',
            'duration.required' => 'Durasi harus diisi',
            'school_year_id.required' => 'Tahun ajaran harus diisi',
            'school_year_id.integer' => 'Tahun ajaran harus berupa angka',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PpdbExam::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'school_year_id' => $request->school_year_id,
        ]);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function examDestroy($id)
    {
        PpdbExam::find($id)->delete();
        Alert::success('Berhasil', 'Ujian berhasil dihapus');
        return redirect()->route('back.ppdb.exam.exam');
    }

    public function examQuestion($id)
    {
        $exam = PpdbExam::find($id);
        $data = [
            'title' => 'Soal ' . $exam->name,
            'menu' => 'PPDB',
            'sub_menu' => 'Ujian',
            'exam' => $exam,
            'list_exam_question' => PpdbExamQuestion::where('ppdb_exam_id', $id)->get(),
        ];
        return view('back.pages.ppdb.exam.detail-question', $data);
    }

    public function examQuestionImport($id)
    {
        $validator = Validator::make(request()->all(), [
            'file' => 'required|mimes:xlsx,xls',
        ], [
            'file.required' => 'File wajib diisi',
            'file.mimes' => 'Format file tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = request()->file('file');
        try {
            Excel::import(new ImportPpdbExamMultipleChoice($id), $file);
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

        Alert::success('Success', 'Data berhasil diimport');
        return redirect()->back();
    }

    public function examQuestionReset($id)
    {
        $exam_question = PpdbExamQuestion::where('ppdb_exam_id', $id)->get();

        foreach ($exam_question as $question) {
            $question->multipleChoice()->delete();
            $question->examAnswer()->delete();
            $question->delete();
        }

        Alert::success('Success', 'Data berhasil direset');
        return redirect()->back();
    }

    public function examQuestionDestroy($question_id)
    {

        $question = PpdbExamQuestion::find($question_id);
        $exam_id = $question->ppdb_exam_id;
        $question->multipleChoice()->delete();
        $question->examAnswer()->delete();
        $question->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('back.ppdb.exam.question', $exam_id);
    }

    //TODO: EXAM QUESTION MULTIPLE CHOICE
    public function examQuestionMultipleChoice($id)
    {
        $data = [
            'title' => 'Tambah Soal Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',
            'exam_id' => $id,

            'exam' => PpdbExam::with('schoolYear')->find($id),
        ];

        return view('back.pages.ppdb.exam.create.multiple-choice', $data);
    }

    public function examQuestionStoreMultipleChoice(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question_text' => 'nullable',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'question_score' => 'required|numeric',
            'choices' => 'required|array|min:2',
            'choices.*.choice_text' => 'nullable',
            'choices.*.choice_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_correct' => 'required'
        ], [
            // 'question_text.required' => 'Pertanyaan wajib diisi',
            'question_image.image' => 'Pertanyaan harus berupa gambar',
            'question_image.mimes' => 'Format gambar tidak valid',
            'question_image.max' => 'Ukuran gambar terlalu besar',
            'choices.required' => 'Pilihan jawaban wajib diisi',
            'choices.array' => 'Pilihan jawaban harus berupa array',
            'choices.min' => 'Pilihan jawaban minimal 2',
            // 'choices.*.choice_text.required' => 'Pilihan jawaban wajib diisi',
            'choices.*.choice_image.image' => 'Pilihan jawaban harus berupa gambar',
            'choices.*.choice_image.mimes' => 'Format gambar tidak valid',
            'choices.*.choice_image.max' => 'Ukuran gambar terlalu besar',
            'is_correct.required' => 'Pilih salah satu jawaban yang benar',
            'question_score.required' => 'Skor soal wajib diisi',
            'question_score.numeric' => 'Skor soal harus berupa angka',
        ]);

        // dd($request->all());

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $question = PpdbExamQuestion::create([
            'ppdb_exam_id' => $id,
            'question_type' => 'pilihan ganda',
            'question_text' => $request->question_text ?? "",
            'question_image' => $request->hasFile('question_image') ? $request->file('question_image')->storeAs('exam/question', Str::random(16) . '.' . $request->file('question_image')->getClientOriginalExtension(), 'public') : null,
            'question_score' => $request->question_score,
        ]);

        foreach ($request->choices as $index => $choice) {
            PpdbExamQuestionMultipleChoice::create([
                'ppdb_exam_question_id' => $question->id,
                'choice_text' => $choice['choice_text'] ?? "",
                'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                    ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                    : null,
                'is_correct' => $index == $request->is_correct ? 1 : 0, // Bandingkan dengan is_correct dari request
            ]);
        }


        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('back.ppdb.exam.question', $id);
    }

    public function examQuestionEditMultipleChoice($id, $question_id)
    {
        $data = [
            'title' => 'Edit Soal Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',
            'exam_id' => $id,

            'exam' => PpdbExam::with('schoolYear')->find($id),
            'question' => PpdbExamQuestion::with('multipleChoice')->find($question_id),
        ];

        return view('back.pages.ppdb.exam.edit.multiple-choice', $data);
    }

    public function examQuestionUpdateMultipleChoice(Request $request, $id, $questionId)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'question_text' => 'nullable',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'question_score' => 'required|numeric',
            'choices' => 'required|array|min:2',
            'choices.*.choice_text' => 'nullable',
            'choices.*.choice_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_correct' => 'required',  // Tambahkan ini
        ], [
            // 'question_text.required' => 'Pertanyaan wajib diisi',
            'question_image.image' => 'Pertanyaan harus berupa gambar',
            'question_image.mimes' => 'Format gambar tidak valid',
            'question_image.max' => 'Ukuran gambar terlalu besar',
            'choices.required' => 'Pilihan jawaban wajib diisi',
            'choices.array' => 'Pilihan jawaban harus berupa array',
            'choices.min' => 'Pilihan jawaban minimal 2',
            'choices.*.choice_text.required' => 'Pilihan jawaban wajib diisi',
            'choices.*.choice_image.image' => 'Pilihan jawaban harus berupa gambar',
            'choices.*.choice_image.mimes' => 'Format gambar tidak valid',
            'choices.*.choice_image.max' => 'Ukuran gambar terlalu besar',
            'is_correct.required' => 'Pilih salah satu jawaban yang benar',
            'question_score.required' => 'Skor soal wajib diisi',
            'question_score.numeric' => 'Skor soal harus berupa angka',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Pastikan bahwa `is_correct` dikirim
        if (!isset($request->is_correct)) {
            return back()->withErrors(['is_correct' => 'Pilih salah satu jawaban yang benar'])->withInput();
        }

        // Update soal
        $question = PpdbExamQuestion::findOrFail($questionId);
        $question->update([
            'question_text' => $request->question_text,
            'question_image' => $request->hasFile('question_image')
                ? $request->file('question_image')->storeAs('exam/question', Str::random(16) . '.' . $request->file('question_image')->getClientOriginalExtension(), 'public')
                : $question->question_image,
            'question_score' => $request->question_score,
        ]);

        // Update atau buat pilihan jawaban
        foreach ($request->choices as $index => $choice) {
            // Cek apakah pilihan ditandai sebagai dihapus
            if (isset($choice['is_deleted']) && $choice['is_deleted'] == '1') {
                if (isset($choice['id'])) {
                    // Jika item sudah ada di database, hapus
                    PpdbExamQuestionMultipleChoice::where('id', $choice['id'])->delete();
                }
                continue;
            }

            // Jika item baru (belum ada id), maka buat item baru
            if (!isset($choice['id'])) {
                PpdbExamQuestionMultipleChoice::create([
                    'ppdb_exam_question_id' => $question->id,
                    'choice_text' => $choice['choice_text'],
                    'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                        ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                        : null,
                    'is_correct' => $index == $request->is_correct ? 1 : 0,
                ]);
            } else {
                // Update item yang ada
                $multipleChoice = PpdbExamQuestionMultipleChoice::findOrFail($choice['id']);
                $multipleChoice->update([
                    'choice_text' => $choice['choice_text'],
                    'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                        ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                        : $multipleChoice->choice_image,
                    'is_correct' => $index == $request->is_correct ? 1 : 0,
                ]);
            }
        }

        Alert::success('Success', 'Data berhasil diperbarui');
        return redirect()->back();
    }

    public function examSchedule($id)
    {
        $exam = PpdbExam::find($id);
        $data = [
            'title' => 'Jadwal Ujian ' . $exam->name,
            'menu' => 'PPDB',
            'sub_menu' => 'Ujian',
            'exam' => $exam,
            'list_exam_schedule' => PpdbExamSchedule::where('ppdb_exam_id', $id)->with('scheduleUser.ppdbUser')->get(),
            'list_user_ppdb' => PpdbUser::whereNotExists(function ($query) use ($id) {
                $query->select(DB::raw(1))
                    ->from('ppdb_exam_schedule_user')
                    ->join('ppdb_exam_schedule', 'ppdb_exam_schedule.id', '=', 'ppdb_exam_schedule_user.ppdb_exam_schedule_id')
                    ->where('ppdb_exam_schedule.ppdb_exam_id', $id)
                    ->whereColumn('ppdb_exam_schedule_user.ppdb_user_id', 'ppdb_user.id'); // Perbaikan di sini
            })->get(),
            'list_user_ppdb_all' => PpdbUser::all(),
        ];
        // return response()->json($data);
        return view('back.pages.ppdb.exam.detail-schedule', $data);
    }

    public function examScheduleStore(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'location' => 'required',
            'ppdb_user_id' => 'required|array|min:1',
        ], [
            'start_time.required' => 'Waktu mulai harus diisi',
            'start_time.date' => 'Waktu mulai harus berupa tanggal',
            'end_time.required' => 'Waktu selesai harus diisi',
            'end_time.date' => 'Waktu selesai harus berupa tanggal',
            'location.required' => 'Lokasi harus diisi',
            'ppdb_user_id.required' => 'Peserta ujian wajib diisi',
            'ppdb_user_id.array' => 'Peserta ujian harus berupa array',
            'ppdb_user_id.min' => 'Peserta ujian minimal 1',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $examSchedule = PpdbExamSchedule::create([
            'ppdb_exam_id' => $id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
        ]);

        foreach ($request->ppdb_user_id as $user) {
            $examSchedule->scheduleUser()->create([
                'ppdb_user_id' => $user,
            ]);
        }

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('back.ppdb.exam.schedule', $id);
    }

    public function examScheduleUpdate(Request $request, $id, $schedule_id)
    {
        // dd($request->ppdb_user_id);
        $validator = Validator::make($request->all(), [
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'location' => 'required',
            'ppdb_user_id' => 'required|array|min:1',
        ], [
            'start_time.required' => 'Waktu mulai harus diisi',
            'start_time.date' => 'Waktu mulai harus berupa tanggal',
            'end_time.required' => 'Waktu selesai harus diisi',
            'end_time.date' => 'Waktu selesai harus berupa tanggal',
            'location.required' => 'Lokasi harus diisi',
            'ppdb_user_id.required' => 'Peserta ujian wajib diisi',
            'ppdb_user_id.array' => 'Peserta ujian harus berupa array',
            'ppdb_user_id.min' => 'Peserta ujian minimal 1',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $examSchedule = PpdbExamSchedule::find($schedule_id);
        $examSchedule->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
        ]);

        $examSchedule->scheduleUser()->delete();

        foreach ($request->ppdb_user_id as $user) {
            $examSchedule->scheduleUser()->create([
                'ppdb_user_id' => $user,
            ]);
        }

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->route('back.ppdb.exam.schedule', $id);
    }

    public function examStudent($id)
    {
        $exam = PpdbExam::find($id);
        $data = [
            'title' => 'Peserta Ujian ' . $exam->name,
            'menu' => 'PPDB',
            'sub_menu' => 'Ujian',
            'exam' => $exam,
        ];
        // return response()->json($data);
        return view('back.pages.ppdb.exam.detail-student', $data);
    }

    public function examStudentDatatable(Request $request, $id)
    {
        $search = $request->search;

        $student = PpdbExamScheduleUser::leftJoin('ppdb_exam_schedule', 'ppdb_exam_schedule.id', '=', 'ppdb_exam_schedule_user.ppdb_exam_schedule_id')
            ->leftJoin('ppdb_exam', 'ppdb_exam.id', '=', 'ppdb_exam_schedule.ppdb_exam_id')
            ->where('ppdb_exam.id', $id)
            ->leftJoin('ppdb_user', 'ppdb_user.id', '=', 'ppdb_exam_schedule_user.ppdb_user_id')
            ->leftJoin('ppdb_exam_session', 'ppdb_exam_session.ppdb_user_id', '=', 'ppdb_exam_schedule_user.ppdb_user_id')
            ->where('ppdb_user.name', 'like', '%' . $search . '%')
            ->select('ppdb_exam_schedule.id as schedule_id', 'ppdb_exam_schedule_user.id as schedule_user_id', 'ppdb_exam_schedule_user.ppdb_user_id', 'ppdb_user.name', 'ppdb_user.nisn',   'ppdb_exam_session.id as session_id', 'ppdb_exam_session.score', 'ppdb_exam_session.start_time', 'ppdb_exam_session.end_time', 'ppdb_exam_schedule_user.created_at', 'ppdb_exam_schedule_user.updated_at')
            ->get();

        // return response()->json($student);

        return datatables()->of($student)
            ->addColumn('index', function ($row) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" />
            </div>';
            })
            ->addColumn('siswa', function ($row) {
                return '
                        <div class="d-flex flex-column">
                            <a href="#"
                                class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</a>
                            <span> NISN.' . $row->nisn . '</span>
                        </div>
                ';
            })
            ->addColumn('nilai', function ($row) {
                if ($row->start_time === null) {
                    return '<span class="fw-bold text-danger">Belum Ujian</span>';
                } elseif ($row->score === null) {
                    return '<span class="fw-bold text-warning">Sedang Ujian</span>';
                } else {
                    return '<span class="fw-bold text-success fs-2">' . $row->score . '</span>';
                }
            })
            ->addColumn('action', function ($row) {
                if ($row->start_time === null) {
                    return '-';
                } elseif ($row->score === null) {
                    return '<a href=" ' . route('back.ppdb.exam.student.finish', $row->session_id) . '"
                                class="btn btn-icon btn-light-youtube me-2"
                                data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Selesaikan Paksa ujian?">
                                <i class="fa-solid fa-xmark fs-4"></i>
                            </a>';
                } else {
                    return '<a href=" ' . route('back.ppdb.exam.student.reset', $row->session_id) . '"
                                class="btn btn-icon btn-light-linkedin me-2"
                                data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Buka Akses Kembali, dan reset waktu">
                                <i class="ki-duotone ki-delete-files fs-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    </i>
                            </a>
                            <a href=" ' . route('back.ppdb.exam.student.analysis', $row->session_id) . '"
                                class="btn btn-icon btn-light-info me-2"
                                data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Analisis Siswa">
                                    <i class="ki-duotone ki-chart-pie-3 fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                            </a>';
                }
            })
            ->rawColumns(['index', 'siswa', 'nilai', 'action'])
            ->make(true);
    }

    public function examStudentForceEnd($id)
    {
        $examSession = PpdbExamSession::find($id);
        $total_score = PpdbExamAnswer::where('ppdb_exam_session_id', $id)->sum('score');
        $examSession->update([
            'end_time' => now(),
            'score' => $total_score,
        ]);

        Alert::success('Success', 'Ujian berhasil diakhiri');
        return redirect()->back();
    }

    public function examStudentReset($id)
    {
        $examSession = PpdbExamSession::find($id);
        $examSession->update([
            'start_time' => now(),
            'end_time' => null,
            'score' => null,
        ]);

        Alert::success('Success', 'Ujian berhasil direset');
        return redirect()->back();
    }

    public function examStudentAnalysis(Request $request, $session_id)
    {
        $examSession = PpdbExamSession::find($session_id);
        $question_id = $request->question_id;
        $exam_question_number = "";
        if ($question_id) {
            $exam_question_number = PpdbExamQuestion::with([
                'multipleChoice',
                'examAnswer' => function ($query) use ($session_id) {
                    $query->where('ppdb_exam_session_id', $session_id);
                }
            ])
                ->where('ppdb_exam_id', $examSession->ppdb_exam_id)
                ->where('id', $question_id)
                ->first();
        } else {
            $exam_question_number = PpdbExamQuestion::with([
                'multipleChoice',
                'examAnswer' => function ($query) use ($session_id) {
                    $query->where('ppdb_exam_session_id', $session_id);
                }
            ])
                ->where('ppdb_exam_id', $examSession->ppdb_exam_id)
                ->first();
        }
        $exam_answer_analysis = PpdbExamQuestion::with(['examAnswer'])->when($question_id, function ($query) use ($question_id) {
            $query->where('id', $question_id);
        })->where('ppdb_exam_id', $examSession->ppdb_exam_id)->first()->examAnswer;
        $data = [
            'title' => 'Analisis Siswa',
            'menu' => 'PPDB',
            'sub_menu' => 'Ujian',
            'exam_session' => $examSession,
            'exam_question_number' => $exam_question_number,
            'exam_answer_analysis' => $exam_answer_analysis,
            'exam_question_n_answer' => PpdbExamQuestion::with([
                'multipleChoice',
                'examAnswer' => function ($query) use ($session_id) {
                    $query->where('ppdb_exam_session_id', $session_id);
                }
            ])
                ->where('ppdb_exam_id', $examSession->ppdb_exam_id)
                ->get(),
        ];
        // return response()->json($data);
        return view('back.pages.ppdb.exam.detail-analysis', $data);
    }

    public function examStudentExport(Request $request, $id)
    {
        $search = $request->search;

        return Excel::download(new PpdbExamScoreStudent($id, $search), 'nilai-ujian-ppdb-' . now() . '.xlsx');
    }
}
