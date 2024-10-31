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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DisciplineStudentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Discipline Student',
            'menu' => 'Discipline Student',
            'sub_menu' => '',

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
        $start_date = request()->start_date;
        if ($start_date != null) {
            $start_date = date('Y-m-d', strtotime($start_date));
        }
        $end_date = request()->end_date;
        if ($end_date != null) {
            $end_date = date('Y-m-d', strtotime($end_date));
        }

        $disciplines = DisciplineStudent::with('students', 'rules', 'teachers')
            ->whereHas('students', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('rules', function ($query) use ($search) {
                $query->where('rule', 'like', '%' . $search . '%');
            })
            ->orWhereHas('teachers', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->whereHas('students.classroomStudent', function ($query) use ($class_id) {
                $query->when($class_id, function ($query) use ($class_id) {
                    $query->where('classroom_id', $class_id);
                });
            })
            ->whereHas('students.classroomStudent.classroom.schoolYear', function ($query) use ($school_year_id) {
                $query->when($school_year_id, function ($query) use ($school_year_id) {
                    $query->where('id', $school_year_id);
                });
            })
            ->where(function ($query) use ($start_date, $end_date) {
                if ($start_date != null && $end_date != null) {
                    $query->whereBetween('date', [$start_date, $end_date]);
                }
            })
            ->orderBy('date', 'desc')
            ->get();

        //  return   response()->json($disciplines);

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
            ->addColumn('point', function ($row) {
                return '<span class="fw-bold">+' . $row->rules->point . ' Point</span>';
            })
            ->addColumn('action', function ($row) {
                return '<a href="#" class="btn btn-icon btn-light-youtube me-2"
                            data-bs-toggle="modal" data-bs-target="#delete' . $row->id . '"
                            data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Hapus Pelanggaran?">
                            <i class="fa-solid fa-xmark fs-4"></i>
                        </a>';
            })
            ->rawColumns(['index', 'siswa', 'pelanggaran', 'point', 'action'])
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
            'description' => 'required|string',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'integer' => ':attribute harus berupa angka',
            'date' => ':attribute harus berupa tanggal',
            'string' => ':attribute harus berupa teks',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        DisciplineStudent::create([
            'student_id' => $request->student_id,
            'discipline_rule_id' => $request->discipline_rule_id,
            'date' => $request->date,
            'description' => $request->description,
            'teacher_id' => Auth::user()->teacher->id,
        ]);

        Alert::success('Success', 'Discipline student sukses ditambahkan');
        return redirect()->route('discipline.index');
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
        return redirect()->route('discipline.index');
    }

    public function destroy($id)
    {
        DisciplineStudent::where('id', $id)->delete();

        Alert::success('Success', 'Discipline student sukses dihapus');
        return redirect()->route('discipline.index');
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
}
