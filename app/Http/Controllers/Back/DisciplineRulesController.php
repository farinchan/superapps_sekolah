<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\DisciplineRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class DisciplineRulesController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Discipline Rules',
            'menu' => 'Discipline Rules',
            'sub_menu' => '',

            'list_discipline_rules' => DisciplineRule::orderBy('point', 'asc')->get(),
        ];

        return view('back.pages.discipline.rule', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rule' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'point' => 'required|integer',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        DisciplineRule::create([
            'rule' => $request->rule,
            'description' => $request->description,
            'category' => $request->category,
            'point' => $request->point,
        ]);

        Alert::success('Success', 'Discipline rule sukses ditambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rule' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'point' => 'required|integer',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', $validator->errors()->all());
            return redirect()->back()->withInput();
        }

        DisciplineRule::where('id', $id)->update([
            'rule' => $request->rule,
            'description' => $request->description,
            'category' => $request->category,
            'point' => $request->point,
        ]);

        Alert::success('Success', 'Discipline rule sukses diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        DisciplineRule::where('id', $id)->delete();

        Alert::success('Success', 'Discipline rule sukses dihapus');
        return redirect()->back();
    }
}
