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
    public function index(){
        $data = [
            'title' => 'Discipline Student',
            'menu' => 'Discipline Student',
            'sub_menu' => '',

            'list_discipline' => DisciplineStudent::orderBy('date', 'desc')->get(),
            'list_school_year' => SchoolYear::orderBy('start_year', 'desc')->get(),

        ];

        return view('back.pages.discipline.index', $data);
    }


    public function create(){
        $data = [
            'title' => 'Add Discipline Student',
            'menu' => 'Discipline Student',
            'sub_menu' => '',

            'list_classroom' => Classroom::with('classroomStudent.student')->orderBy('name', 'asc')->get(),
            'list_discipline_rule' => DisciplineRule::orderBy('point', 'asc')->get(),
        ];

        return view('back.pages.discipline.create', $data);
    }



    public function store(Request $request){
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

    public function update(Request $request){
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

    public function destroy($id){
        DisciplineStudent::where('id', $id)->delete();

        Alert::success('Success', 'Discipline student sukses dihapus');
        return redirect()->route('discipline.index');
    }

    public function apiStudent(){
        $classroom_id = request()->class_id;
        $students = Classroom::find($classroom_id)->classroomStudent->map(function($item){
            return [
                'id' => $item->student->id,
                'name' => $item->student->name,
                'nisn' => $item->student->nisn,
            ];
        });

        return response()->json($students);
    }


    public function apiClassroom(){
        $school_year_id = request()->school_year_id;
        $classrooms = Classroom::where('school_year_id', $school_year_id)->with('classroomStudent.student')->orderBy('name', 'asc')->get();

        return response()->json($classrooms);
    }
}
