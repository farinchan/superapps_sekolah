@extends('back.app')
@section('seo')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-xl-row">
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body pt-15">
                            <div class="d-flex flex-center flex-column mb-5">
                                <a
                                    class="fs-3 text-gray-800 text-hover-primary text-center fw-bold mb-1">{{ $billing->name }}</a>
                                {{-- <div class="fs-5 fw-semibold text-muted text-center mb-6">
                                    {{ $billing->description }}
                                </div> --}}
                                <div class="d-flex flex-wrap flex-center">
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fw-semibold text-muted">Jumlah Tagihan</div>
                                        <div class="fs-4 fw-bold text-gray-700">
                                            <span class="w-75px"> @money($billing->total) </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                    href="#kt_customer_view_details" role="button" aria-expanded="false"
                                    aria-controls="kt_customer_view_details">Details
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-outline ki-down fs-3"></i>
                                    </span>
                                </div>
                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit details">
                                    <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                        data-bs-target="#edit_detail">Edit</a>
                                </span>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div id="kt_customer_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <div class="fw-bold mt-5">ID Tagihan</div>
                                    <div class="text-gray-600">#{{ $billing->id }}</div>
                                    <div class="fw-bold mt-5">Nama Tagihan</div>
                                    <div class="text-gray-600">{{ $billing->name }}</div>
                                    <div class="fw-bold mt-5">Deskripsi</div>
                                    <div class="text-gray-600">{{ $billing->description }}</div>
                                    <div class="fw-bold mt-5">Jumlah Tagihan</div>
                                    <div class="text-gray-600">@money($billing->total)</div>
                                    <div class="fw-bold mt-5">Untuk Kelas</div>
                                    <div class="text-gray-600">
                                        <ul>
                                            @foreach ($billing->billing_classroom as $classroom_bill)
                                                <li>{{ $classroom_bill->classroom?->name }} - TA.
                                                    {{ $classroom_bill->classroom?->schoolYear?->start_year }}/{{ $classroom_bill->classroom?->schoolYear?->end_year }}
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="fw-bold mt-5">Tanggal Dibuat</div>
                                    <div class="text-gray-600">
                                        {{ Carbon\Carbon::parse($billing->created_at)->format('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-lg-row-fluid ms-lg-15">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_customer_view_overview_tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_customer_view_overview_events_and_logs_tab">Riwayat Pembayaran</a>
                        </li>
                        <li class="nav-item ms-auto">
                            <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                                data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">Actions
                                <i class="ki-outline ki-down fs-2 me-0"></i></a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                                data-kt-menu="true">
                                <div class="menu-item px-5">
                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Payments</div>
                                </div>
                                <div class="menu-item px-5">
                                    <a data-bs-toggle="modal" data-bs-target="#manual_bayar" href="#"
                                        class="menu-link flex-stack px-5">Tambah pembayaran
                                        <span class="ms-2" data-bs-toggle="tooltip"
                                            title="Membayar secara manual oleh bendahara sekolah">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span></a>
                                </div>
                                <div class="menu-item px-5">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete_tagihan" class="menu-link text-danger px-5">Hapus Tagihan</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_customer_view_overview_tab" role="tabpanel">

                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2 class="fw-bold">Total Terkumpul</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">

                                    <div class="fw-bold fs-2">
                                        <span class="text-muted fs-4 fw-semibold">Rp.</span>
                                        {{ number_format($total_billing_payment, 0, ',', '.') }}
                                        <div class="fs-7 fw-normal text-muted"> Saldo akan diperbarui setelah pembayaran
                                            diverifikasi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2 class="fw-bold mb-0">Pembayaran</h2>
                                    </div>
                                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                        <div class="w-200 mw-300px">
                                            <select class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true" data-placeholder="Pilih Kelas"
                                                data-kt-ecommerce-order-filter="status" id="classroom_select">
                                                <option></option>
                                                @foreach ($billing_classroom as $classroom_bill)
                                                    <option value="{{ $classroom_bill->classroom_id }}"
                                                        @if ($loop->first) selected @endif>
                                                        {{ $classroom_bill->classroom?->name }} - TA.
                                                        {{ $classroom_bill->classroom?->schoolYear?->start_year }}/{{ $classroom_bill->classroom?->schoolYear?->end_year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="kt_customer_view_payment_method" class="card-body pt-0">
                                    <div id="classroom_detail"></div>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="kt_customer_view_overview_events_and_logs_tab" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Payment Records</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0 pb-5">
                                    <table class="table align-middle table-row-dashed gy-5" id="payment_history">
                                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                            <tr class="text-start text-muted text-uppercase gs-0">
                                                <th class="">ID</th>
                                                <th>Siswa</th>
                                                <th>Status</th>
                                                <th>Jumlah</th>
                                                <th>Dibayar Oleh</th>
                                                <th class="min-w-100px">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            @foreach ($billing_payment as $billing_payment)
                                                <tr>
                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-600 text-hover-primary mb-1">#{{ $billing_payment->id }}</a>
                                                    </td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="#">
                                                                <div class="symbol-label">
                                                                    <img src="{{ $billing_payment->student?->getPhoto() }}"
                                                                        alt="{{ $billing_payment->student?->name }}"
                                                                        width="50px" />
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="#"
                                                                class="text-gray-800 text-hover-primary mb-1">{{ $billing_payment->student?->name }}</a>
                                                            <span> NISN.{{ $billing_payment->student?->nisn }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($billing_payment->status == 'paid')
                                                            <span class="badge badge-light-success">diterima</span>
                                                        @elseif ($billing_payment->status == 'pending')
                                                            <span class="badge badge-light-warning">tertunda</span>
                                                        @else
                                                            <span class="badge badge-light-danger">ditolak</span>
                                                        @endif
                                                    </td>
                                                    <td>@money($billing_payment->total)</td>
                                                    <td>
                                                        @if ($billing_payment->parent_student_id)
                                                            Orang Tua
                                                        @else
                                                            Bendahara/Admin
                                                        @endif
                                                    </td>
                                                    <td>{{ Carbon\Carbon::parse($billing_payment->created_at)->format('d F Y') }} {{ Carbon\Carbon::parse($billing_payment->created_at)->format('H:i') }}
                                                        WIB </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="delete_tagihan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Hapus Tagihan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.billing.destroy', $billing->id) }}" method="post">
                    @csrf
                    @method('delete')

                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="fs-3 fw-semibold text-danger">Apakah Anda yakin?</div>
                            <div class="fs-5 fw-semibold text-muted">Tagihan yang dihapus tidak dapat dikembalikan dan semua
                                data terkait akan dihapus juga.</div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="manual_bayar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Buat Pembayaran</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('back.billing.payment', $billing->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-10">
                            <label class="form-label fw-bold">Siswa</label>
                            <select class="form-select" name="student_id" data-control="select2"
                                data-placeholder="Pilih Siswa" data-dropdown-parent="#manual_bayar" required>
                                <option></option>
                                @foreach ($billing->billing_classroom as $classroom_bill)
                                    @foreach ($classroom_bill->classroom->classroomStudent as $student)
                                        <option value="{{ $student->student_id }}">{{ $student->student->name }} - NISN.
                                            {{ $student->student->nisn }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label class="form-label fw-bold">Jumlah Pembayaran</label>
                            <input type="number" class="form-control" name="total"
                                placeholder="Masukkan jumlah pembayaran" required />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Bayar & Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="edit_detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Detail Tagihan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.billing.update', $billing->id) }}" method="post">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="required form-label">Nama Tagihan</label>
                            <input type="text" name="name" class="form-control form-control-solid"
                                value="{{ $billing->name }}" placeholder="Nama Tagihan" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="required form-label">Deskripsi</label>
                            <textarea name="description" class="form-control form-control-solid" placeholder="Deskripsi">{{ $billing->description }}
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="required form-label">Total Tagihan</label>
                            <input type="number" name="total" class="form-control form-control-solid"
                                value="{{ $billing->total }}" placeholder="Jumlah" />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        function formatRupiah(number) {
            return 'Rp. ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function formatTanggalWaktu(dateString) {
            const parsedDate = new Date(dateString); // Ganti 'date' dengan 'parsedDate'
            return new Intl.DateTimeFormat('id-ID', {
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                timeZone: 'Asia/Jakarta'
            }).format(parsedDate);

        }
        $(document).ready(function() {
            // Example AJAX request

            $('#classroom_select').on('change', function() {
                var classroom_id = $(this).val();
                $('#classroom_detail').html('');
                $('#classroom_detail').append(`
                    <div class="d-flex flex-center flex-column mb-5">
                        <div class="fs-5 fw-semibold text-muted text-center mb-6">
                            Memuat data...
                        </div>
                    </div>
                `);

                $.ajax({
                    url: '{{ route('back.billing.detail.billingClassroomAjax') }}',
                    method: 'GET',
                    data: {
                        billing_id: '{{ $billing->id }}',
                        classroom_id: classroom_id
                    },
                    success: function(response) {
                        let classroom_student = response[0].classroom_student;
                        console.log(classroom_student);
                        $('#classroom_detail').html('');
                        classroom_student.forEach(function(student) {

                            let billing_payment = student.student.billing_payment;
                            console.log("billing_payment", billing_payment);

                            let html_billing_payment = '';
                            billing_payment.forEach(function(payment) {
                                html_billing_payment += `
                                    <tr>
                                        <td>#${payment.id}</td>
                                        <td>${formatRupiah(payment.total)}</td>
                                        ${payment.status == 'paid' ? '<td><span class="badge badge-light-success">Pembayaran diterima</span></td>' : payment.status == 'pending' ? '<td><span class="badge badge-light-warning">Pembayaran tertunda</span></td>' : '<td><span class="badge badge-light-danger">Pembayaran ditolak</span></td>'}
                                        <td>${formatTanggalWaktu(payment.created_at)}</td>
                                    </tr>
                                `;
                            });
                            let sum_billing_payment = billing_payment.reduce((a, b) => b
                                .status == 'paid' ? a + b.total : a, 0);
                            let remaining_billing_payment = response[0].billing.total -
                                sum_billing_payment;
                            let percentage_billing_payment = (sum_billing_payment /
                                response[0].billing.total) * 100;
                            $('#classroom_detail').append(`
                                <div class="py-0" data-kt-customer-payment-method="row">
                                    <div class="py-3 d-flex flex-stack flex-wrap">
                                        <div class="d-flex align-items-center collapsible collapsed rotate"
                                            data-bs-toggle="collapse"
                                            href="#kt_customer_view_payment_method_${student.student_id}" role="button"
                                            aria-expanded="false"
                                            aria-controls="kt_customer_view_payment_method_${student.student_id}">
                                            <div class="me-3 rotate-90">
                                                <i class="ki-outline ki-right fs-3"></i>
                                            </div>
                                            <img src="${student.student?.photo ?? '/img_ext/anonim_person.png'}"
                                                class="w-40px me-3" alt="" />
                                            <div class="me-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="text-gray-800 fw-bold">${student.student?.name}</div>
                                                    ${percentage_billing_payment == 100 ? '<div class="badge badge-light-success ms-5">Lunas</div>' : percentage_billing_payment > 0 ? '<div class="badge badge-light-warning ms-5">Mencicil</div>' : '<div class="badge badge-light-danger ms-5">Belum Bayar</div>'}
                                                </div>
                                                <div class="text-muted">NISN. ${student.student?.nisn}</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="kt_customer_view_payment_method_${student.student_id}" class="collapse fs-6 ps-10"
                                        data-bs-parent="#kt_customer_view_payment_method">
                                        <div class="d-flex flex-wrap py-5">
                                            <div class="flex-equal me-5">
                                                <table class="table table-flush fw-semibold gy-1">
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Tagihan</td>
                                                        <td class="text-gray-800">${formatRupiah(response[0].billing.total)}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Dibayar</td>
                                                        <td class="text-gray-800">${formatRupiah(sum_billing_payment)}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Sisa</td>
                                                        <td class="text-gray-800">${formatRupiah(remaining_billing_payment)}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted min-w-125px w-125px">Persen</td>
                                                        <td class="text-gray-800">${percentage_billing_payment}%</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <span class="fw-bold fs-6">Riwayat Pembayaran</span>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-gray-800">
                                                        <th>ID</th>
                                                        <th>Jumlah</th>
                                                        <th>Status</th>
                                                        <th>Waktu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ${html_billing_payment}
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="separator separator-dashed"></div>
                            `);
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            $('#classroom_select').trigger('change');

        });
    </script>
    <script>
        $('#payment_history').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "order": [],
        });
    </script>
@endsection
