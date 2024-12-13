<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\billing;
use App\Models\BillingClassroom;
use App\Models\BillingPayment;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');
        $data = [
            'title' => 'List Tagihan',
            'menu' => 'Tagihan',
            // 'sub_menu' => '',
            'list_billing' => billing::latest()->where('name', 'like', '%' . $search . '%')->paginate(10),
            'list_classroom' => Classroom::with('schoolYear')->latest()->get(),
        ];

        return view('back.pages.billing.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'total' => 'required',
            'classroom_id' => 'required|array',
            'classroom_id.*' => 'required|integer',
        ], [
            'name.required' => 'Nama tagihan wajib diisi',
            'name.max' => 'Nama tagihan maksimal 255 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'total.required' => 'Total tagihan wajib diisi',
            'classroom_id.required' => 'Kelas wajib diisi',
            'classroom_id.array' => 'Kelas harus berupa array',
            'classroom_id.*.required' => 'Kelas wajib diisi',
            'classroom_id.*.integer' => 'Kelas harus berupa angka',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $billing = billing::create([
            'name' => $request->name,
            'description' => $request->description,
            'total' => $request->total,
        ]);

        $classroom_id = $request->classroom_id;
        foreach ($classroom_id as $classroom) {
            $billing->billing_classroom()->create([
                'classroom_id' => $classroom,
            ]);
        }

        Alert::success('Berhasil', 'Tagihan berhasil ditambahkan');
        return redirect()->route('back.billing.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'total' => 'required',
        ], [
            'name.required' => 'Nama tagihan wajib diisi',
            'name.max' => 'Nama tagihan maksimal 255 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'total.required' => 'Total tagihan wajib diisi',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $billing = billing::findOrFail($id);
        $billing->update([
            'name' => $request->name,
            'description' => $request->description,
            'total' => $request->total,
        ]);

        Alert::success('Berhasil', 'Tagihan berhasil diubah');
        return redirect()->route('back.billing.index');
    }

    public function destroy($id)
    {
        $billing = billing::findOrFail($id);
        $billing->billing_classroom()->delete();
        $billing->delete();

        Alert::success('Berhasil', 'Tagihan berhasil dihapus');
        return redirect()->route('back.billing.index');
    }
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Tagihan',
            'menu' => 'Tagihan',
            // 'sub_menu' => '',
            'billing' => billing::findOrFail($id),
            'billing_payment' => BillingPayment::where('billing_id', $id)->with('parent_student', 'student')->latest()->get(),
            'total_billing_payment' => BillingPayment::where('billing_id', $id)->where('status', 'paid')->sum('total'),
            'billing_classroom' => BillingClassroom::where('billing_id', $id)->with(['classroom.schoolYear'])->get(),
        ];

        // return response()->json($data);
        return view('back.pages.billing.detail', $data);
    }

    public function billingClassroomAjax(Request $request)
    {
        $classroom_id = $request->classroom_id;
        $billing_id = $request->billing_id;

        $billing_classroom = BillingClassroom::where('billing_id', $billing_id)
            ->when($classroom_id, function ($query) use ($classroom_id) {
                $query->where('classroom_id', $classroom_id);
            })
            ->with(['billing', 'classroom_student.student.billing_payment'])
            ->get();

        return response()->json($billing_classroom);
    }

    public function payment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'parent_student_id' => 'nullable|integer',
            'total' => 'required',
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

        $billing_payment = new BillingPayment();
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

    public function BillingStudentIndex(Request $request)
    {
        $search = $request->input('q');
        $data = [
            'title' => 'Tagihan Saya',
            'menu' => 'Tagihan',
            // 'sub_menu' => '',
            'list_billing' => BillingClassroom::whereHas('classroom_student', function ($query) {
                $query->where('student_id', Auth::user()->parent?->student_id ?? Auth::user()->student?->id);
            })->whereHas('billing', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->with([
                'billing.billing_payment' => function ($query) {
                    $query->where('student_id', Auth::user()->parent?->student_id ?? Auth::user()->student?->id);
                },
            ])
                ->latest()
                ->paginate(10),
        ];

        // return response()->json($data);
        return view('back.pages.billing.index-student', $data);
    }

    public function confirmPayment()
    {
        $data = [
            'title' => 'Konfirmasi Pembayaran',
            'menu' => 'Tagihan',
            'sub_menu' => 'Pembayaran',
            'billing_payment' => BillingPayment::where('status', 'pending')->with('student')->latest()->get(),
        ];

        // return response()->json($data);
        return view('back.pages.billing.confirm', $data);
    }

    public function confirmPaymentProcess(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:paid,rejected',
            'note' => 'nullable',
        ], [
            'status.required' => 'Status wajib diisi',
            'status.in' => 'Status harus berupa paid atau cancel',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $billing_payment = BillingPayment::findOrFail($id);
        $billing_payment->status = $request->status;
        $billing_payment->note = $request->note;
        $billing_payment->save();

        Alert::success('Berhasil', 'Status pembayaran berhasil diubah');
        return redirect()->back();
    }

    public function paidPayment()
    {
        $data = [
            'title' => 'Pembayaran Diterima',
            'menu' => 'Tagihan',
            'sub_menu' => 'Pembayaran',
            'billing_payment' => BillingPayment::where('status', 'paid')->with('student')->latest()->get(),
        ];

        return view('back.pages.billing.paid', $data);
    }

    public function rejectedPayment()
    {
        $data = [
            'title' => 'Pembayaran Ditolak',
            'menu' => 'Tagihan',
            'sub_menu' => 'Pembayaran',
            'billing_payment' => BillingPayment::where('status', 'rejected')->with('student')->latest()->get(),
        ];

        return view('back.pages.billing.rejected', $data);
    }
}
