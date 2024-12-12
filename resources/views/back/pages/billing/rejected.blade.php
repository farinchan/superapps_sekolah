@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card pt-4 mb-6 mb-xl-9">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Pembayaran Ditolak</h2>
                    </div>
                </div>

                <div class="card-body pt-0 pb-5">
                    <table class="table align-middle table-row-dashed gy-5" id="payment_history">
                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                            <tr class="text-start text-muted text-uppercase gs-0">
                                <th>NO</th>
                                <th>ID</th>
                                <th>Siswa</th>
                                <th>Jumlah</th>
                                <th>Bukti Pembayaran</th>
                                <th>Dibayar Oleh</th>
                                <th class="min-w-100px">Tanggal</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-600">
                            @foreach ($billing_payment as $billing_pay)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="text-gray-800 pe-2"> {{ $loop->iteration }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#"
                                            class="text-danger mb-1">#{{ $billing_pay->id }}</a>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="#">
                                                <div class="symbol-label">
                                                    <img src="{{ $billing_pay->student?->getPhoto() }}"
                                                        alt="{{ $billing_pay->student?->name }}" width="50px" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $billing_pay->student?->name }}</a>
                                            <span> NISN.{{ $billing_pay->student?->nisn }}</span>
                                        </div>
                                    </td>
                                    <td>@money($billing_pay->total)</td>
                                    <td >
                                        @if ($billing_pay->image)
                                            <div style="width: 100px; ">

                                                <a class="overlay" data-fslightbox="lightbox-basic"
                                                    href="{{ $billing_pay->getImage() }}">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-50px"
                                                        style="background-image:url('{{ $billing_pay->getImage() }}')">
                                                    </div>
                                                    <!--end::Image-->

                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    @if ($billing_pay->parent_student_id)
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="#">
                                                    <div class="symbol-label">
                                                        <img src="{{ $billing_pay->parent_student?->getPhoto() }}"
                                                            alt="{{ $billing_pay->parent_student?->name }}"
                                                            width="50px" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span> Orang Tua</span>
                                                <a href="#"
                                                    class="text-gray-800 text-hover-primary mb-1">{{ $billing_pay->parent_student?->name }}</a>

                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            Bendahara/Admin
                                        </td>
                                    @endif
                                    <td>{{ Carbon\Carbon::parse($billing_pay->created_at)->format('d F Y') }}
                                        -
                                        {{ Carbon\Carbon::parse($billing_pay->created_at)->format('H:i') }}
                                        WIB </td>
                                    <td>{{ $billing_pay->note?? "-" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('back/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#payment_history').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "order": [],
            });
        });
    </script>
@endsection
