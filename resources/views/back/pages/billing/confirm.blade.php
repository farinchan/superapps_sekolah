@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card pt-4 mb-6 mb-xl-9">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Konfirmasi Pembayaran</h2>
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
                                <th class="text-end min-w-100px pe-4">Actions</th>
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
                                            class="text-gray-600 text-hover-primary mb-1">#{{ $billing_pay->id }}</a>
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
                                    <td>
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
                                    <td class="pe-0 text-end">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#action_{{ $billing_pay->id }}"
                                            class="btn btn-sm btn-light image.png btn-active-light-primary">Actions
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($billing_payment as $billing_pay)
        <div class="modal fade" tabindex="-1" id="action_{{ $billing_pay->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Konfirmasi Pembayaran</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route("back.billing.confirm-payment.process", $billing_pay->id) }}" method="post">
                        @csrf
                        @method('PUT')


                        <div class="modal-body">

                            <div class="mb-10">
                                <div class="py-5 fs-6">
                                    <div class=" d-flex align-items-center">
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
                                    </div>
                                    <div class="fw-bold mt-5">Jumlah</div>
                                    <div class="text-gray-600">@money($billing_pay->total)</div>
                                    <div class="fw-bold mt-5">Tanggal</div>
                                    <div class="text-gray-600">
                                        {{ Carbon\Carbon::parse($billing_pay->created_at)->format('d F Y') }}
                                        -
                                        {{ Carbon\Carbon::parse($billing_pay->created_at)->format('H:i') }} WIB</div>
                                </div>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fw-bold required">Action</label>
                                <select class="form-select form-select-solid" name="status" id="status">
                                    <option value="paid">Terima</option>
                                    <option value="rejected">Tolak</option>
                                </select>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fw-bold ">Catatan</label>
                                <textarea class="form-control form-control-solid" name="note" id="note" rows="3" placeholder="Catatan"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Selesai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
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
