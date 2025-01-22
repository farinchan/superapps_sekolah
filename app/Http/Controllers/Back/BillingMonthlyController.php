<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\BillingMonthly;
use App\Models\BillingMonthlyClassroom;
use App\Models\BillingMonthlyPayment;
use App\Models\Classroom;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class BillingMonthlyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');
        $data = [
            'title' => 'List Tagihan Bulanan',
            'menu' => 'Tagihan',
            'sub_menu' => 'Tagihan Bulanan',
            'list_school_year' => SchoolYear::latest()->get(),
            'list_billing' => BillingMonthly::latest()->where('name', 'like', '%' . $search . '%')->with('schoolYear')->paginate(10),
            // 'list_classroom' => Classroom::with('schoolYear')->latest()->get(),
        ];
        // return response()->json($data);
        return view('back.pages.billing_monthly.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'amount' => 'required',
            'school_year_id' => 'required|integer',
            'semester' => 'required|in:ganjil,genap',
            'classroom_id' => 'required|array',
            'classroom_id.*' => 'required|integer',
        ], [
            'name.required' => 'Nama tagihan wajib diisi',
            'name.max' => 'Nama tagihan maksimal 255 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'amount.required' => 'Jumlah tagihan wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
            'school_year_id.integer' => 'Tahun ajaran harus berupa angka',
            'semester.required' => 'Semester wajib diisi',
            'semester.in' => 'Semester harus ganjil atau genap',
            'classroom_id.required' => 'Kelas wajib diisi',
            'classroom_id.array' => 'Kelas harus berupa array',
            'classroom_id.*.required' => 'Kelas wajib diisi',
            'classroom_id.*.integer' => 'Kelas harus berupa angka',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $BillingMonthly = BillingMonthly::create([
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
            'school_year_id' => $request->school_year_id,
            'semester' => $request->semester,
        ]);

        $classroom_id = $request->classroom_id;
        foreach ($classroom_id as $classroom) {
            $BillingMonthly->billing_classroom()->create([
                'classroom_id' => $classroom,
            ]);
        }

        Alert::success('Berhasil', 'Tagihan berhasil ditambahkan');
        return redirect()->route('back.billing-monthly.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'amount' => 'required',
            'school_year_id' => 'required|integer',
            'semester' => 'required|in:ganjil,genap',
        ], [
            'name.required' => 'Nama tagihan wajib diisi',
            'name.max' => 'Nama tagihan maksimal 255 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'amount.required' => 'Jumlah tagihan wajib diisi',
            'school_year_id.required' => 'Tahun ajaran wajib diisi',
            'school_year_id.integer' => 'Tahun ajaran harus berupa angka',
            'semester.required' => 'Semester wajib diisi',
            'semester.in' => 'Semester harus ganjil atau genap',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $BillingMonthly = BillingMonthly::find($id);
        $BillingMonthly->update([
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
            'school_year_id' => $request->school_year_id,
            'semester' => $request->semester,
        ]);

        Alert::success('Berhasil', 'Tagihan berhasil diubah');
        return redirect()->route('back.billing-monthly.index');
    }
    public function destroy($id)
    {
        $billing = BillingMonthly::findOrFail($id);
        $billing->billing_classroom()->delete();
        $billing->delete();

        Alert::success('Berhasil', 'Tagihan berhasil dihapus');
        return redirect()->route('back.billing-monthly.index');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Tagihan Bulanan',
            'menu' => 'Tagihan',
            'sub_menu' => 'Tagihan Bulanan',
            'billing' => BillingMonthly::with('schoolYear')->findOrFail($id),
            'billing_payment' => BillingMonthlyPayment::where('billing_monthly_id', $id)->with('parent_student', 'student')->latest()->get(),
            'total_billing_payment' => BillingMonthlyPayment::where('billing_monthly_id', $id)->where('status', 'paid')->sum('amount'),
            'billing_classroom' => BillingMonthlyClassroom::where('billing_monthly_id', $id)->with(['classroom.schoolYear'])->get(),
        ];

        // return response()->json($data);
        return view('back.pages.billing_monthly.detail', $data);
    }

    public function billingMonthlyClassroomAjax(Request $request)
    {
        $classroom_id = $request->classroom_id;
        $billing_id = $request->billing_id;

        $billing_classroom = BillingMonthlyClassroom::where('billing_monthly_id', $billing_id)
            ->when($classroom_id, function ($query) use ($classroom_id) {
                $query->where('classroom_id', $classroom_id);
            })
            ->with(['billingMonthly', 'classroom_student.student.billing_payment'])
            ->get();

        return response()->json($billing_classroom);
    }

    public function payment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'parent_student_id' => 'nullable|integer',
            'amount ' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'note' => 'nullable',
        ], [
            'student_id.required' => 'Siswa wajib diisi',
            'student_id.integer' => 'Siswa harus berupa angka',
            'parent_student_id.integer' => 'Orang tua siswa harus berupa angka',
            'total.required' => 'Total pembayaran wajib diisi',
            'image.image' => 'Bukti pembayaran harus berupa gambar',
            'image.mimes' => 'Bukti pembayaran harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'image.max' => 'Bukti pembayaran maksimal 4MB',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $billing_payment = new BillingMonthlyPayment();
        $billing_payment->billing_id = $id;
        $billing_payment->student_id = $request->student_id;
        $billing_payment->total = $request->total;
        if (Auth::user()->parent) {
            $billing_payment->parent_student_id = Auth::user()->parent?->id ?? null; // jika user adalah orang tua
            $billing_payment->status = 'pending';
        }
        if (Auth::user()->teacher) {
            $billing_payment->status = 'paid';
        }
        $billing_payment->note = $request->note;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $billing_payment->image = $image->storeAs('billing_payment', Str::random(16) . '.' . $image->getClientOriginalExtension(), 'public');
        }
        $billing_payment->save();

        Alert::success('Berhasil', 'Pembayaran berhasil ditambahkan');
        return redirect()->back();
    }

}
