<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamClassroom;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionMultipleChoice;
use App\Models\ExamQuestionMultipleChoiceComplex;
use App\Models\SchoolYear;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'list_exam' => Exam::with('teacher', 'schoolYear')->get(),

            'list_subject' => Subject::all(),
            'list_school_year' => SchoolYear::all(),
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->get(),


        ];

        return view('back.pages.exam.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required|numeric',
            'teacher_id' => 'required',
            'type' => 'required',
            'school_year_id' => 'required',
        ], [
            'subject_id.required' => 'Mata pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'duration.required' => 'Durasi wajib diisi',
            'teacher_id.required' => 'Guru wajib diisi',
            'type.required' => 'Jenis Ujian wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Exam::create($request->all());

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function setting($id)
    {
        $data = [
            'title' => 'Setting Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
            'list_subject' => Subject::all(),
            'list_school_year' => SchoolYear::all(),
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->get(),
        ];

        return view('back.pages.exam.detail-setting', $data);
    }

    public function settingUpdate(Request $request, $id)
    {
        // if (!Auth::user()->hasRole('admin')) {
        //     Alert::error('Error', 'Anda tidak memiliki akses untuk mengubah data, silahkan hubungi admin');
        //     return redirect()->back();
        // }

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required|numeric',
            'teacher_id' => 'required',
            'type' => 'required',
            'school_year_id' => 'required',
        ], [
            'subject_id.required' => 'Mata pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'duration.required' => 'Durasi wajib diisi',
            'teacher_id.required' => 'Guru wajib diisi',
            'type.required' => 'Jenis Ujian wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Exam::find($id)->update($request->all());

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function settingDestroy($id)
    {
        Exam::find($id)->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function classroom($id)
    {
        $data = [
            'title' => 'Kelas Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
            'list_exam_classroom' => ExamClassroom::where('exam_id', $id)->with('classroom')->get(),
            'list_classroom' => Classroom::with('schoolYear')->get(),
        ];

        return view('back.pages.exam.detail-classroom', $data);
    }

    public function classroomStore(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'classroom_id' => 'required',
        ], [
            'classroom_id.required' => 'Kelas wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->classroom_id as $classroom_id) {
            ExamClassroom::create([
                'exam_id' => $id,
                'classroom_id' => $classroom_id,
            ]);
        }

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('back.exam.classroom', $id);
    }

    public function classroomDestroy($id)
    {
        ExamClassroom::find($id)->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function question($id)
    {
        $data = [
            'title' => 'Soal Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
            'list_exam_question' => ExamQuestion::where('exam_id', $id)->get(),
        ];

        return view('back.pages.exam.detail-question', $data);
    }

    public function questionMultipleChoice($id)
    {
        $data = [
            'title' => 'Tambah Soal Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',
            'exam_id' => $id,

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
        ];

        return view('back.pages.exam.create.multiple-choice', $data);
    }

    public function questionStoreMultipleChoice(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question_text' => 'required',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'choices' => 'required|array|min:2',
            'choices.*.choice_text' => 'required',
            'choices.*.choice_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_correct' => 'required'
        ], [
            'question_text.required' => 'Pertanyaan wajib diisi',
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
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $question = ExamQuestion::create([
            'exam_id' => $id,
            'question_type' => 'pilihan ganda',
            'question_text' => $request->question_text,
            'question_image' => $request->hasFile('question_image') ? $request->file('question_image')->storeAs('exam/question', Str::random(16) . '.' . $request->file('question_image')->getClientOriginalExtension(), 'public') : null,
        ]);

        foreach ($request->choices as $index => $choice) {
            ExamQuestionMultipleChoice::create([
                'exam_question_id' => $question->id,
                'choice_text' => $choice['choice_text'],
                'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                    ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                    : null,
                'is_correct' => $index == $request->is_correct ? 1 : 0, // Bandingkan dengan is_correct dari request
            ]);
        }


        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('back.exam.question', $id);
    }

    public function questionMultipleChoiceComplex($id)
    {
        $data = [
            'title' => 'Tambah Soal Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',
            'exam_id' => $id,

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
        ];

        return view('back.pages.exam.create.multiple-choice-complex', $data);
    }

    public function questionStoreMultipleChoiceComplex(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question_text' => 'required',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'choices' => 'required|array|min:2',
            'choices.*.choice_text' => 'required',
            'choices.*.choice_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'choices.*.is_correct' => 'nullable'
        ], [
            'question_text.required' => 'Pertanyaan wajib diisi',
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
            'choices.*.is_correct.required' => 'Pilih salah satu jawaban yang benar',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $question = ExamQuestion::create([
            'exam_id' => $id,
            'question_type' => 'pilihan ganda kompleks',
            'question_text' => $request->question_text,
            'question_image' => $request->hasFile('question_image') ? $request->file('question_image')->storeAs('exam/question', Str::random(16) . '.' . $request->file('question_image')->getClientOriginalExtension(), 'public') : null,
        ]);

        foreach ($request->choices as $index => $choice) {
            ExamQuestionMultipleChoiceComplex::create([
                'exam_question_id' => $question->id,
                'choice_text' => $choice['choice_text'],
                'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                    ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                    : null,
                'is_correct' => isset($choice['is_correct']) ? 1 : 0,
            ]);
        }

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('back.exam.question', $id);
    }
}
