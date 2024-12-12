@extends('back.app')
@section('seo')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row gx-6 gx-xl-9">

                <div class="col-lg-12 mb-5">
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <form method="GET" class="card-title">
                                <input type="hidden" name="page" value="{{ request('page', 1) }}">
                                <div class="input-group d-flex align-items-center position-relative my-1">
                                    <input type="text" class="form-control form-control-solid  ps-5 rounded-0"
                                        name="q" value="{{ request('q') }}" placeholder="Cari Tagihan" />
                                    <button class="btn btn-primary btn-icon" type="submit" id="button-addon2">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Search-->
                            </form>
                        </div>
                    </div>
                </div>

                @forelse ($list_billing as $bill)
                    @php
                        $total_billing = $bill->billing?->total;
                        $total_payment = 0;
                        $remaining_payment = 0;
                        $percent_payment = 0;
                        foreach ($bill->billing->billing_payment as $payment) {
                            $total_payment += $payment->total;
                        }
                        $remaining_payment = $total_billing - $total_payment;
                        $percent_payment = ($total_payment / $total_billing) * 100;
                    @endphp
                    <div class="col-lg-12 mb-5">
                        <div class="card card-flush h-lg-100">
                            <div class="card-body pt-9 pb-0">
                                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">

                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-1">
                                                    <a href="#"
                                                        class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">
                                                        {{ $bill->billing?->name }}
                                                    </a>
                                                    @if ($percent_payment == 100)
                                                        <span class="badge badge-light-success">Lunas</span>
                                                    @elseif ($percent_payment > 0)
                                                        <span class="badge badge-light-warning">Mencicil</span>
                                                    @else
                                                        <span class="badge badge-light-danger">Belum Bayar</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-500">
                                                    <table>
                                                        <tr>
                                                            <td width="180px">Total Tagihan</td>
                                                            <td>:</td>
                                                            <td>@money($total_billing)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dibayar</td>
                                                            <td>:</td>
                                                            <td> @money($total_payment)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sisa</td>
                                                            <td>:</td>
                                                            <td> @money($remaining_payment)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Persen</td>
                                                            <td>:</td>
                                                            <td> {{ $percent_payment }}%</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="d-flex mb-4">
                                                <button type="submit" class="btn btn-sm btn-primary me-3"
                                                    data-bs-toggle="modal" data-bs-target="#bayar_{{ $bill->billing?->id }}">
                                                    Bayar Sekarang
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-bold fs-6">Riwayat Pembayaran</span>
                                <div class="separator"></div>
                                <div class="align-items-center pe-5 ps-5">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th>ID </th>
                                                    <th>Tanggal Transfer</th>
                                                    <th>Jumlah</th>
                                                    <th>Bukti Pembayaran</th>
                                                    <th>Status</th>
                                                    <th>Note</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($bill->billing->billing_payment as $billing_payment)
                                                    <tr>
                                                        <td>#{{ $billing_payment->id }}</td>
                                                        <td>
                                                            {{ Carbon\Carbon::parse($billing_payment->created_at)->format('d F Y') }}
                                                            -
                                                            {{ Carbon\Carbon::parse($billing_payment->created_at)->format('H:i') }}
                                                            WIB
                                                        </td>
                                                        <td>@money($billing_payment->total)</td>
                                                        <td>
                                                            <div style="width: 100px; ">

                                                                <a class="overlay" data-fslightbox="lightbox-basic"
                                                                    href="{{ $billing_payment->getImage() }}">
                                                                    <!--begin::Image-->
                                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-50px"
                                                                        style="background-image:url('{{ $billing_payment->getImage() }}')">
                                                                    </div>
                                                                    <!--end::Image-->

                                                                    <!--begin::Action-->
                                                                    <div
                                                                        class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                                    </div>
                                                                    <!--end::Action-->
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($billing_payment->status == 'pending')
                                                                <span
                                                                    class="badge badge-light-warning">{{ $billing_payment->status }}</span>
                                                            @elseif ($billing_payment->status == 'paid')
                                                                <span
                                                                    class="badge badge-light-success">{{ $billing_payment->status }}</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-light-danger">{{ $billing_payment->status }}</span>
                                                            @endif
                                                        <td>
                                                            @if ($billing_payment->note)
                                                                {{ $billing_payment->note }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    @empty
                                                        <td colspan="4" class="text-center">Belum ada pembayaran</td>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="card card-flush h-lg-100">
                            <div class="card-body pt-9 pb-0">
                                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-1">
                                                    <a href="#"
                                                        class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">
                                                        Tidak ada data
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
                <div class="col-lg-12">
                    <div class="d-flex flex-stack flex-wrap my-3">
                        <div class="fs-6 fw-semibold text-gray-700">
                            Showing {{ $list_billing->firstItem() }} to {{ $list_billing->lastItem() }} of
                            {{ $list_billing->total() }}
                            records
                        </div>
                        <ul class="pagination">
                            @if ($list_billing->onFirstPage())
                                <li class="page-item previous">
                                    <a href="#" class="page-link"><i class="previous"></i></a>
                                </li>
                            @else
                                <li class="page-item previous">
                                    <a href="{{ $list_billing->previousPageUrl() }}" class="page-link bg-light"><i
                                            class="previous"></i></a>
                                </li>
                            @endif

                            @php
                                // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                $start = max($list_billing->currentPage() - 2, 1);
                                $end = min($start + 4, $list_billing->lastPage());
                            @endphp

                            @if ($start > 1)
                                <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif

                            @foreach ($list_billing->getUrlRange($start, $end) as $page => $url)
                                <li class="page-item{{ $page == $list_billing->currentPage() ? ' active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($end < $list_billing->lastPage())
                                <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif

                            @if ($list_billing->hasMorePages())
                                <li class="page-item next">
                                    <a href="{{ $list_billing->nextPageUrl() }}" class="page-link bg-light"><i
                                            class="next"></i></a>
                                </li>
                            @else
                                <li class="page-item next">
                                    <a href="#" class="page-link"><i class="next"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @foreach ($list_billing as $bill)
        <div class="modal fade" tabindex="-1" id="bayar_{{ $bill->billing?->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Buat Pembayaran</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <form action="{{ route('back.billing.payment', $bill->billing?->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="student_id" value="{{ Auth::user()->parent?->student_id }}">

                            <div class="mb-10">
                                <label class="form-label fw-bold required">Jumlah Pembayaran</label>
                                <input type="number" class="form-control" name="total"
                                    placeholder="{{ $bill->billing?->total }}"
                                     required />
                            </div>
                            <div class="mb-10">
                                <label class="form-label fw-bold required">Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="image" accept="image/*" required />
                                <small class="text-muted">File harus berformat jpg, jpeg, png dengan ukuran maksimal 4MB</small>
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
    @endforeach

@endsection
@section('scripts')
<script src="{{ asset("back/plugins/custom/fslightbox/fslightbox.bundle.js") }}"></script>
@endsection
