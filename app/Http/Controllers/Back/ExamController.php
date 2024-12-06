<?php

namespace App\Http\Controllers\Back;

use App\Exports\ExamScoreStudent;
use App\Http\Controllers\Controller;
use App\Imports\ImportExamMatchingPairImport;
use App\Imports\ImportExamMultipleChoiceComplexImport;
use App\Imports\ImportExamMultipleChoiceImport;
use App\Models\Classroom;
use App\Models\ClassroomStudent;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamClassroom;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionMatchingPair;
use App\Models\ExamQuestionMultipleChoice;
use App\Models\ExamQuestionMultipleChoiceComplex;
use App\Models\ExamSession;
use App\Models\LogLoginElearning;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function index()
    {
        $list_exam = [];

        $list_exam = Exam::with('teacher', 'schoolYear')->where('teacher_id', Auth::user()->teacher->id)->get();

        $data = [
            'title' => 'Ujian yang ditugaskan',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'list_exam' => $list_exam,
            'list_school_year' => SchoolYear::all(),


        ];

        return view('back.pages.exam.index', $data);
    }

    public function proktor()
    {
        $list_exam = Exam::with('teacher', 'schoolYear')->get();


        $data = [
            'title' => 'Proktor Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'list_exam' => $list_exam,

            'list_subject' => Subject::all(),
            'list_school_year' => SchoolYear::all(),
            'list_teacher' => Teacher::where('type', 'tenaga pendidik')->get(),


        ];

        return view('back.pages.exam.proktor_index', $data);
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
            'semester' => 'required',
        ], [
            'subject_id.required' => 'Mata pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'duration.required' => 'Durasi wajib diisi',
            'teacher_id.required' => 'Guru wajib diisi',
            'type.required' => 'Jenis Ujian wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
            'semester.required' => 'Semester wajib diisi',
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
            'semester' => 'required',
        ], [
            'subject_id.required' => 'Mata pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'duration.required' => 'Durasi wajib diisi',
            'teacher_id.required' => 'Guru wajib diisi',
            'type.required' => 'Jenis Ujian wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
            'semester.required' => 'Semester wajib diisi',
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
        $examData = Exam::find($id);

        $examData->examClassroom()->delete();
        $examData->examQuestion()->delete();
        $examData->examSession()->delete();
        $examData->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('back.exam.index');
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

    public function classroomDestroy($id, $classroom_id)
    {
        ExamClassroom::find($classroom_id)->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function student($id)
    {
        $data = [
            'title' => 'Siswa Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
            'list_classroom' => ExamClassroom::where('exam_id', $id)->with('classroom')->get(),
        ];
        // return response()->json($data);

        return view('back.pages.exam.detail-student', $data);
    }

    public function studentDatatable(Request $request, $id)
    {
        $search = $request->search;
        $classroom_id = $request->classroom_id;


        $student = ExamClassroom::where('exam_classroom.exam_id', $id)
        ->when($classroom_id, function ($query) use ($classroom_id) {
            $query->where('exam_classroom.classroom_id', $classroom_id);
        })
        ->leftJoin('classroom', 'classroom.id', '=', 'exam_classroom.classroom_id')
        ->leftJoin('school_year', 'school_year.id', '=', 'classroom.school_year_id')
        ->leftJoin('classroom_student', function ($join) {
            $join->on('classroom_student.classroom_id', '=', 'exam_classroom.classroom_id');
        })
        ->leftJoin('student', function ($join) {
            $join->on('student.id', '=', 'classroom_student.student_id');
        })

        ->when($search, function ($query) use ($search) {
            $query->where('student.name', 'like', '%' . $search . '%')
                ->orWhere('student.nisn', 'like', '%' . $search . '%');
        })
        ->leftJoin('exam_session', function ($join) use ($id) {
            $join->on('exam_session.student_id', '=', 'student.id')
                ->where('exam_session.exam_id', $id);
        })
        ->leftJoin('log_login_elearning', function ($join) {
            $join->on('log_login_elearning.user_id', '=', 'student.user_id')
                ->on('log_login_elearning.created_at', '>=', DB::raw('COALESCE(exam_session.start_time, log_login_elearning.created_at)'))
                ->on('log_login_elearning.created_at', '<=', DB::raw('COALESCE(exam_session.end_time, log_login_elearning.created_at)'));
        })
        ->select(
            'student.id as student_id',
            'student.name',
            'student.nisn',
            'student.nik',
            'student.photo',
            'classroom.id as classroom_id',
            'classroom.name as classroom_name',
            'exam_session.id as session_id',
            'exam_session.start_time',
            'exam_session.end_time',
            'exam_session.score',
            'school_year.start_year as school_year_start',
            'school_year.end_year as school_year_end',
            DB::raw('count(log_login_elearning.id) as login_count')
        )
        ->groupBy(
            'student.id',
            'student.name',
            'student.nisn',
            'student.nik',
            'student.photo',
            'classroom.id',
            'classroom.name',
            'exam_session.id',
            'exam_session.start_time',
            'exam_session.end_time',
            'exam_session.score',
            'school_year.start_year',
            'school_year.end_year'
        )
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
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="#">
                                <div class="symbol-label">
                                    <img src="' . ($row->photo == null ? asset('img_ext/anonim_person.png') : asset('storage/' . $row->photo)) . '"
                                        alt="' . $row->name . '" class="h-75"
                                        width="50px" />
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#"
                                class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</a>
                            <span> NISN.' . $row->nisn . '</span>
                            <span> NIK.' . $row->nik . '</span>
                        </div>
                ';
            })
            ->addColumn('kelas', function ($row) {
                return '<span class="fw-bold">' . $row->classroom_name . '</span> <br> <span>' . $row->school_year_start . '/' . $row->school_year_end . '</span>';
            })
            ->addColumn('login', function ($row) {
                    return '<span class="fw-bold">' . $row->login_count . '</span>';

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
                    return '<a href=" ' . route('back.exam.student.finish', $row->session_id) . '"
                                class="btn btn-icon btn-light-youtube me-2"
                                data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Selesaikan Paksa ujian?">
                                <i class="fa-solid fa-xmark fs-4"></i>
                            </a>';
                } else {
                    return '<a href=" ' . route('back.exam.student.reset', $row->session_id) . '"
                                class="btn btn-icon btn-light-linkedin me-2"
                                data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Buka Akses Kembali, dan reset waktu">
                                <i class="ki-duotone ki-delete-files fs-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    </i>
                            </a>
                            <a href=" ' . route('back.exam.student.analysis', $row->session_id) . '"
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
            ->rawColumns(['index', 'siswa', 'kelas','login', 'nilai', 'action'])
            ->make(true);
    }

    public function studentExport(Request $request, $id)
    {
        $search = $request->search;
        $classroom_id = $request->classroom_id;

        return Excel::download(new ExamScoreStudent($id, $classroom_id, $search), 'nilai-ujian-' . now() . '.xlsx');
    }

    public function studentExamResetAll(Request $request, $id)
    {

        $classroom_id = $request->classroom_id;

        $exam_session = ExamSession::where('exam_id', $id)->get();
        foreach ($exam_session as $session) {
            if ($session->start_time !== null) {
                $session->update([
                    'start_time' => now(),
                    'end_time' => null,
                    'score' => null,
                ]);
            }
        }

        Alert::success('Success', 'Data berhasil direset');
        return redirect()->back();
    }

    public function studentExamReset($session_id)
    {
        $exam_session = ExamSession::find($session_id);
        $exam_session->update([
            'start_time' => now(),
            'end_time' => null,
            'score' => null,
        ]);

        Alert::success('Success', 'Data berhasil direset');
        return redirect()->back();
    }

    public function studentExamForceEnd($session_id)
    {
        $total_score = ExamAnswer::where('exam_session_id', $session_id)
            ->where('is_correct', true)
            ->join('exam_question', 'exam_question.id', '=', 'exam_answer.exam_question_id')
            ->sum('exam_question.question_score');

        ExamSession::find($session_id)->update([
            'end_time' => now(),
            'score' => $total_score,
        ]);

        Alert::success('Success', 'Ujian telah selesai');
        return redirect()->back();
    }


    public function studentExamAnalysis(Request $request, $session_id)
    {

        $question_id = $request->question_id;

        $exam_session = ExamSession::with('Exam', 'Student')->find($session_id);
        $exam_question_number = "";
        if ($question_id) {
            $exam_question_number = ExamQuestion::with([
                'multipleChoice',
                'examAnswer' => function ($query) use ($session_id) {
                    $query->where('exam_session_id', $session_id);
                }
            ])
                ->where('exam_id', $exam_session->exam_id)
                ->where('id', $question_id)
                ->first();
        } else {
            $exam_question_number = ExamQuestion::with([
                'multipleChoice',
                'examAnswer' => function ($query) use ($session_id) {
                    $query->where('exam_session_id', $session_id);
                }
            ])
                ->where('exam_id', $exam_session->exam_id)
                ->first();
        }
        $exam_answer_analysis = ExamQuestion::with(['examAnswer'])->when($question_id, function ($query) use ($question_id) {
            $query->where('id', $question_id);
        })->where('exam_id', $exam_session->exam_id)->first()->examAnswer;
        $data = [
            'title' => 'Analisis Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',

            'exam_session' => $exam_session,
            'login_count' => LogLoginElearning::where('user_id', $exam_session->Student?->user_id)
                ->where('created_at', '>=', $exam_session->start_time)->when($exam_session->end_time, function ($query) use ($exam_session) {
                    $query->where('created_at', '<=', $exam_session->end_time);
                })
                ->count(),
            'exam_answer_analysis' => $exam_answer_analysis,
            'exam_answer_analysis_perkelas' => ExamAnswer::leftJoin('exam_session', 'exam_session.id', '=', 'exam_answer.exam_session_id')
                ->leftJoin('student', 'student.id', '=', 'exam_session.student_id')
                ->leftJoin('exam', 'exam.id', '=', 'exam_session.exam_id')
                ->leftJoin('exam_classroom', 'exam_classroom.exam_id', '=', 'exam.id')
                ->leftJoin('classroom', 'classroom.id', '=', 'exam_classroom.classroom_id')
                ->where('exam.id', $exam_session->exam_id)
                ->select('exam_answer.*', 'exam.id as exam_id', 'exam_classroom.classroom_id', 'classroom.name as classroom_name', 'student.name as student_name')
                ->orderBy('exam_answer.exam_question_id')
                ->get(),
            'exam_question_number' => $exam_question_number,
            'exam_question_n_answer' => ExamQuestion::with([
                'multipleChoice',
                'examAnswer' => function ($query) use ($session_id) {
                    $query->where('exam_session_id', $session_id);
                }
            ])
                ->where('exam_id', $exam_session->exam_id)
                ->get(),

        ];

        // return response()->json($data);
        return view('back.pages.exam.detail-analysis', $data);
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

    public function questionImport($id, Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'question_type' => 'required',
            'file' => 'required|mimes:xlsx,xls',
        ], [
            'file.required' => 'File wajib diisi',
            'file.mimes' => 'Format file tidak valid',
            'question_type.required' => 'Tipe soal wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = request()->file('file');
        try {
            if ($request->question_type == 'pilihan ganda') {
                Excel::import(new ImportExamMultipleChoiceImport($id), $file);
            } elseif ($request->question_type == 'pilihan ganda kompleks') {
                Excel::import(new ImportExamMultipleChoiceComplexImport, $file);
            } elseif ($request->question_type == 'menjodohkan') {
                // Excel::import(new ExamQuestionMatching, $file);
            } else {
                Alert::error('Error', 'Tipe soal tidak valid');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

        Alert::success('Success', 'Data berhasil diimport');
        return redirect()->back();
    }

    public function questionReset($id)
    {
        $exam_question = ExamQuestion::where('exam_id', $id)->get();

        foreach ($exam_question as $question) {
            $question->multipleChoice()->delete();
            $question->multipleChoiceComplex()->delete();
            $question->matchingPair()->delete();
            $question->examAnswer()->delete();
            $question->delete();
        }

        Alert::success('Success', 'Data berhasil direset');
        return redirect()->back();
    }

    public function questionDestroy($question_id)
    {

        $question = ExamQuestion::find($question_id);
        $exam_id = $question->exam_id;
        $question->multipleChoice()->delete();
        $question->multipleChoiceComplex()->delete();
        $question->matchingPair()->delete();
        $question->examAnswer()->delete();
        $question->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('back.exam.question', $exam_id);
    }


    //TODO: EXAM QUESTION MULTIPLE CHOICE
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

        $question = ExamQuestion::create([
            'exam_id' => $id,
            'question_type' => 'pilihan ganda',
            'question_text' => $request->question_text ?? "",
            'question_image' => $request->hasFile('question_image') ? $request->file('question_image')->storeAs('exam/question', Str::random(16) . '.' . $request->file('question_image')->getClientOriginalExtension(), 'public') : null,
            'question_score' => $request->question_score,
        ]);

        foreach ($request->choices as $index => $choice) {
            ExamQuestionMultipleChoice::create([
                'exam_question_id' => $question->id,
                'choice_text' => $choice['choice_text'] ?? "",
                'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                    ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                    : null,
                'is_correct' => $index == $request->is_correct ? 1 : 0, // Bandingkan dengan is_correct dari request
            ]);
        }


        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('back.exam.question', $id);
    }

    public function questionEditMultipleChoice($id, $question_id)
    {
        $data = [
            'title' => 'Edit Soal Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',
            'exam_id' => $id,

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
            'question' => ExamQuestion::with('multipleChoice')->find($question_id),
        ];

        return view('back.pages.exam.edit.multiple-choice', $data);
    }

    public function questionUpdateMultipleChoice(Request $request, $id, $questionId)
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
        $question = ExamQuestion::findOrFail($questionId);
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
                    ExamQuestionMultipleChoice::where('id', $choice['id'])->delete();
                }
                continue;
            }

            // Jika item baru (belum ada id), maka buat item baru
            if (!isset($choice['id'])) {
                ExamQuestionMultipleChoice::create([
                    'exam_question_id' => $question->id,
                    'choice_text' => $choice['choice_text'],
                    'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                        ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                        : null,
                    'is_correct' => $index == $request->is_correct ? 1 : 0,
                ]);
            } else {
                // Update item yang ada
                $multipleChoice = ExamQuestionMultipleChoice::findOrFail($choice['id']);
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

    //TODO: EXAM QUESTION MULTIPLE CHOICE COMPLEX
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
            'question_score' => 'required|numeric',
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
            'question_score.required' => 'Skor soal wajib diisi',
            'question_score.numeric' => 'Skor soal harus berupa angka',

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
            'question_score' => $request->question_score,
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

    public function questionEditMultipleChoiceComplex($id, $question_id)
    {
        $data = [
            'title' => 'Edit Soal Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',
            'exam_id' => $id,

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
            'question' => ExamQuestion::with('multipleChoiceComplex')->find($question_id),
        ];

        return view('back.pages.exam.edit.multiple-choice-complex', $data);
    }

    public function questionUpdateMultipleChoiceComplex(Request $request, $exam_id, $question_id)
    {
        // dd($request->all());
        // Validasi data yang diterima dari form
        $validator = Validator::make($request->all(), [
            'question_text' => 'required',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'question_score' => 'required|numeric',
            'choices' => 'required|array|min:2',
            'choices.*.choice_text' => 'required',
            'choices.*.choice_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'choices.*.is_correct' => 'nullable'
        ], [
            'question_text.required' => 'Pertanyaan wajib diisi',
            'question_image.image' => 'Pertanyaan harus berupa gambar',
            'question_image.mimes' => 'Format gambar tidak valid',
            'question_image.max' => 'Ukuran gambar terlalu besar',
            'question_score.required' => 'Skor soal wajib diisi',
            'question_score.numeric' => 'Skor soal harus berupa angka',
            'choices.required' => 'Pilihan jawaban wajib diisi',
            'choices.array' => 'Pilihan jawaban harus berupa array',
            'choices.min' => 'Pilihan jawaban minimal 2',
            'choices.*.choice_text.required' => 'Pilihan jawaban wajib diisi',
            'choices.*.choice_image.image' => 'Pilihan jawaban harus berupa gambar',
            'choices.*.choice_image.mimes' => 'Format gambar tidak valid',
            'choices.*.choice_image.max' => 'Ukuran gambar terlalu besar',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update soal
        $question = ExamQuestion::findOrFail($question_id);
        $question->update([
            'question_text' => $request->question_text,
            'question_image' => $request->hasFile('question_image')
                ? $request->file('question_image')->storeAs('exam/question', Str::random(16) . '.' . $request->file('question_image')->getClientOriginalExtension(), 'public')
                : $question->question_image,
            'question_score' => $request->question_score,
        ]);

        // Update atau buat pilihan jawaban
        foreach ($request->choices as $index => $choice) {

            if (isset($choice['is_deleted']) && $choice['is_deleted'] == '1') {
                if (isset($choice['id'])) {
                    // Jika item sudah ada di database, hapus
                    ExamQuestionMultipleChoiceComplex::where('id', $choice['id'])->delete();
                    // dd($choice['id']);
                }
                continue;
            }

            if (isset($choice['id']) && $choice['id']) {
                // Jika ID ada, update pilihan yang ada
                $choiceRecord = ExamQuestionMultipleChoiceComplex::find($choice['id']);
                $choiceRecord->update([
                    'choice_text' => $choice['choice_text'],
                    'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                        ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                        : $choiceRecord->choice_image, // Tidak mengubah jika tidak ada gambar baru
                    'is_correct' => isset($choice['is_correct']) ? 1 : 0,
                ]);
            } else {
                // Jika tidak ada ID, berarti ini pilihan baru
                ExamQuestionMultipleChoiceComplex::create([
                    'exam_question_id' => $question->id,
                    'choice_text' => $choice['choice_text'],
                    'choice_image' => isset($choice['choice_image']) && is_file($choice['choice_image'])
                        ? $choice['choice_image']->storeAs('exam/choice', Str::random(16) . '.' . $choice['choice_image']->getClientOriginalExtension(), 'public')
                        : null,
                    'is_correct' => isset($choice['is_correct']) ? 1 : 0,
                ]);
            }
        }

        Alert::success('Success', 'Data berhasil diperbarui');
        return redirect()->back();
    }

    //TODO: EXAM QUESTION MATCHING PAIR

    public function questionMatchingPair($id)
    {
        $data = [
            'title' => 'Tambah Soal Ujian',
            'menu' => 'E-Learning',
            'sub_menu' => 'Ujian',
            'exam_id' => $id,

            'exam' => Exam::with('teacher', 'schoolYear')->find($id),
        ];

        return view('back.pages.exam.create.matching-pair', $data);
    }

    public function questionStoreMatchingPair(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question_text' => 'required',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'question_score' => 'required|numeric',
            'pairs' => 'required|array|min:2',
            'pairs.*.pair_text' => 'required',
            'pairs.*.pair_match' => 'required',
        ], [
            'question_text.required' => 'Pertanyaan wajib diisi',
            'question_image.image' => 'Pertanyaan harus berupa gambar',
            'question_image.mimes' => 'Format gambar tidak valid',
            'question_image.max' => 'Ukuran gambar terlalu besar',
            'pairs.required' => 'Pasangan jawaban wajib diisi',
            'pairs.array' => 'Pasangan jawaban harus berupa array',
            'pairs.min' => 'Pasangan jawaban minimal 2',
            'pairs.*.pair_text.required' => 'Pasangan jawaban wajib diisi',
            'pairs.*.pair_match.required' => 'Pasangan jawaban wajib dipasangkan',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $question = ExamQuestion::create([
            'exam_id' => $id,
            'question_type' => 'menjodohkan',
            'question_text' => $request->question_text,
            'question_image' => $request->hasFile('question_image') ? $request->file('question_image')->storeAs('exam/question', Str::random(16) . '.' . $request->file('question_image')->getClientOriginalExtension(), 'public') : null,
            'question_score' => $request->question_score,
        ]);

        foreach ($request->pairs as $pair) {
            ExamQuestionMatchingPair::create([
                'exam_question_id' => $question->id,
                'pair_text' => $pair['pair_text'],
                'pair_match' => $pair['pair_match'],
            ]);
        }

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('back.exam.question', $id);
    }
}
