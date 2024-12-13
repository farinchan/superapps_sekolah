<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\DisciplineRule;
use App\Models\DisciplineStudent;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class DisciplineStudentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kedisiplinan',
            'menu' => 'Pelanggaran Siswa',
            // 'sub_menu' => '',

            'list_discipline' => DisciplineStudent::orderBy('date', 'desc')->get(),
            'list_school_year' => SchoolYear::orderBy('start_year', 'desc')->get(),

        ];

        return view('back.pages.discipline.index', $data);
    }

    public function datatableAjax()
    {
        $search = request()->search;
        $school_year_id = request()->school_year_id;
        $class_id = request()->class_id;
        $start_date = request()->start_date ? date('Y-m-d', strtotime(request()->start_date)) : null;
        $end_date = request()->end_date ? date('Y-m-d', strtotime(request()->end_date)) : null;

        $disciplines = DisciplineStudent::with('students', 'rules', 'teachers')

            // Filter berdasarkan nama siswa, NISN, dan NIK
            ->whereHas('students', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('nisn', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%');
            })

            // Filter berdasarkan tahun ajaran
            ->when($school_year_id, function ($query) use ($school_year_id) {
                $query->whereHas('students.classroomStudent.classroom.schoolYear', function ($query) use ($school_year_id) {
                    $query->where('school_year_id', $school_year_id);
                });
            })

            // Filter berdasarkan kelas
            ->when($class_id, function ($query) use ($class_id) {
                $query->whereHas('students.classroomStudent', function ($query) use ($class_id) {
                    $query->where('classroom_id', $class_id);
                });
            })

            // Filter berdasarkan tanggal
            ->when($start_date, function ($query) use ($start_date) {
                $query->where('date', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                $query->where('date', '<=', $end_date);
            })

            ->orderBy('date', 'desc')
            ->get();

        // Return datatables response
        return datatables()->of($disciplines)
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
                                    <img src="' . $row->students->getPhoto() . '"
                                        alt="' . $row->students->name . '" class="h-75"
                                        width="50px" />
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="#"
                                class="text-gray-800 text-hover-primary mb-1">' . $row->students->name . '</a>
                            <span> NISN.' . $row->students->nisn . '</span>
                            <span> NIK.' . $row->students->nik . '</span>
                        </div>
                ';
            })
            ->addColumn('pelanggaran', function ($row) {
                if ($row->rules->category == 'ringan') {
                    $html = '<span class="fw-bold mb-1" style="color: #1BC5BD">Pelanggaran Ringan</span>';
                } elseif ($row->rules->category == 'sedang') {
                    $html = '<span class="fw-bold mb-1" style="color: #ffe600">Pelanggaran Sedang</span>';
                } elseif ($row->rules->category == 'berat') {
                    $html = '<span class="fw-bold mb-1" style="color: #ff8d4b">Pelanggaran Berat</span>';
                } elseif ($row->rules->category == 'sangat berat') {
                    $html = '<span class="fw-bold mb-1" style="color: #f30000">Pelanggaran Sangat Berat</span>';
                }
                return '<div class="d-flex flex-column">
                            <span class="text-dark fw-bolder">' . $row->rules->rule . '</span>
                            ' . $html . '
                            <span>' . $row->rules->description . '</span>
                        </div>';
            })
            ->addColumn('image', function ($row) {
                return $row->image ? '
                    <a class="d-block overlay" data-fslightbox="lightbox-basic" href="' . asset('storage/' . $row->image) . '">
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-100px"
                            style="background-image:url(' . asset('storage/' . $row->image) . ')">
                        </div>
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                            <i class="bi bi-eye-fill text-white fs-3x"></i>
                        </div>
                        <!--end::Action-->
                    </a>
                ' : '-';
            })
            ->addColumn('date', function ($row) {
                return Carbon::parse($row->date)->translatedFormat('d F Y H:i');
            })
            ->addColumn('point', function ($row) {
                return '<span class="fw-bold text-danger">+' . $row->rules->point . ' Point</span>';
            })
            ->addColumn('action', function ($row) {
                if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('guru_bk')) {
                    return '<a href="#" class="btn btn-icon btn-light-youtube me-2"
                                data-bs-toggle="modal" data-bs-target="#delete' . $row->id . '"
                                data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Hapus Pelanggaran?">
                                <i class="fa-solid fa-xmark fs-4"></i>
                            </a>';
                } else {
                    return '-';
                }
            })
            ->rawColumns(['index', 'siswa', 'pelanggaran', 'image', 'point', 'action'])
            ->make(true);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Discipline Student',
            'menu' => 'Discipline Student',
            'sub_menu' => '',

            'list_classroom' => Classroom::with('classroomStudent.student')->orderBy('name', 'asc')->get(),
            'list_discipline_rule' => DisciplineRule::orderBy('point', 'asc')->get(),
        ];

        return view('back.pages.discipline.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'discipline_rule_id' => 'required|integer',
            'date' => 'required|date',
            'image' => 'nullable|image|max:6248',
            'description' => 'required|string',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'integer' => ':attribute harus berupa angka',
            'date' => ':attribute harus berupa tanggal',
            'string' => ':attribute harus berupa teks',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'max' => ':attribute tidak boleh lebih dari 6MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->storeAs('discipline', Str::random(16) . '.' . $image->getClientOriginalExtension(), 'public');
        } else {
            $image_path = null;
        }

        DisciplineStudent::create([
            'student_id' => $request->student_id,
            'discipline_rule_id' => $request->discipline_rule_id,
            'date' => $request->date,
            'image' => $image_path,
            'description' => $request->description,
            'teacher_id' => Auth::user()->teacher->id,
        ]);

        Alert::success('Success', 'Discipline student sukses ditambahkan');
        return redirect()->route('back.discipline.student.index');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'discipline_rule_id' => 'required|integer',
            'date' => 'required|date',
            'description' => 'required|string',
            'teacher_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        DisciplineStudent::where('id', $request->id)->update([
            'student_id' => $request->student_id,
            'discipline_rule_id' => $request->discipline_rule_id,
            'date' => $request->date,
            'description' => $request->description,
            'teacher_id' => $request->teacher_id,
        ]);

        Alert::success('Success', 'Discipline student sukses diubah');
        return redirect()->route('back.discipline.student.index');
    }

    public function destroy($id)
    {
        DisciplineStudent::where('id', $id)->delete();

        Alert::success('Success', 'Discipline student sukses dihapus');
        return redirect()->route('back.discipline.student.index');
    }

    public function apiStudent()
    {
        $classroom_id = request()->class_id;
        $students = Classroom::find($classroom_id)->classroomStudent->map(function ($item) {
            return [
                'id' => $item->student->id,
                'name' => $item->student->name,
                'nisn' => $item->student->nisn,
            ];
        });

        return response()->json($students);
    }

    public function apiClassroom()
    {
        $school_year_id = request()->school_year_id;
        $classrooms = Classroom::where('school_year_id', $school_year_id)->with('classroomStudent.student')->orderBy('name', 'asc')->get();

        return response()->json($classrooms);
    }

    public function myDiscipline()
    {
        $data = [
            'title' => 'Pelanggaran Saya',
            'menu' => 'Kedisiplinan',
            // 'sub_menu' => '',

            'list_discipline' => DisciplineStudent::orderBy('date', 'desc')->get(),
            'list_school_year' => SchoolYear::orderBy('start_year', 'desc')->get(),

        ];

        return view('back.pages.discipline.index-student', $data);
    }
}
