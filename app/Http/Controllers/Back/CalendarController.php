<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CalendarController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Calendar',
            'menu' => 'calendar',
            'submenu' => '',
        ];

        return view('back.pages.calendar.index', $data);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'nullable',
            'location' => 'nullable',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $calendar = new Calendar();
        $calendar->title = $request->title;
        $calendar->start = $request->start;
        $calendar->end = $request->end;
        $calendar->description = $request->description;
        $calendar->location = $request->location;
        $calendar->save();

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('back.calendar.index');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'nullable',
            'location' => 'nullable',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $calendar = Calendar::find($request->id);
        $calendar->title = $request->title;
        $calendar->start = $request->start;
        $calendar->end = $request->end;
        $calendar->description = $request->description;
        $calendar->location = $request->location;
        $calendar->save();

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('back.calendar.index');
    }

    public function destroy(Request $request)
    {
        $calendar = Calendar::find($request->id);
        if (!$calendar) {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect()->back();
        }
        $calendar->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('back.calendar.index');
    }
}
