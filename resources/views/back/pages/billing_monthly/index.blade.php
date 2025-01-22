@extends('back.app')
@section('seo')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="row row gx-6 gx-xl-9">
                <div class="col-lg-12 mb-5">
                    <div class="row">
                        <div class="col-lg-7"></div>
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
                        <div class="col-lg-2">
                            <div class="input-group d-flex align-items-center position-relative my-1">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                                    <i class="ki-duotone ki-plus fs-2"></i>
                                    Buat Tagihan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @forelse ($list_billing as $billing)
                    <div class="col-md-4">
                        <a href="{{ route('back.billing-monthly.detail', $billing->id) }}">

                            <div class="card  border-hover-primary mt-5">
                                <div class="card-body p-9 ">

                                    <div class="fs-3 fw-bold text-gray-900">
                                        {{ $billing->name }}
                                    </div>

                                    <div class="m-0">
                                        <span class=" text-muted">
                                            {{ $billing->description }}</span>
                                        <br>
                                    </div>


                                </div>
                                <div class="card-footer border-0">
                                    <div class="d-flex justify-content-end">
                                        <div class="d-flex align-items-center text-end ">
                                            <span
                                                class="text-gray-600 me-2 ">TA. {{ $billing->schoolYear->start_year }}/{{ $billing->schoolYear->end_year }} - Semester
                                                {{ $billing->semester }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="d-flex align-items-center text-end ">
                                            <span class="fs-4 fw-semibold text-gray-500 align-self-start me-1">Rp.</span>
                                            <span
                                                class="fs-1 fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ number_format($billing->amount, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
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

    <div class="modal fade" tabindex="-1" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Buat Tagihan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.billing-monthly.store') }}" method="post">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="required form-label">Nama Tagihan</label>
                            <input type="text" name="name" class="form-control form-control-solid"
                                placeholder="Nama Tagihan" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="required form-label">Deskripsi</label>
                            <textarea name="description" class="form-control form-control-solid" placeholder="Deskripsi"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="required form-label">Jumlah Tagihan</label>
                            <input type="number" name="amount" class="form-control form-control-solid"
                                placeholder="1xxxxx" />
                            <small class="text-muted">Jumlah tagihan dalam rupiah tanpa titik atau koma</small>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="required form-label">Semester</label>
                            <select class="form-select form-select-solid" name="semester" required>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="school_year_id" class="required form-label">Tahun Ajaran</label>
                            <select class="form-select form-select-solid" name="school_year_id" required>
                                @foreach ($list_school_year as $school_year)
                                    <option value="{{ $school_year->id }}">
                                        {{ $school_year->start_year }}/{{ $school_year->end_year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="classroom_id" class="required form-label">Untuk Kelas</label>
                            <select class="form-select form-select-solid" name="classroom_id[]" data-control="select2"
                                multiple="multiple" data-placeholder="Pilih kelas" data-dropdown-parent="#add" required>
                                <option></option>
                                {{-- @foreach ($list_classroom as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->name }} - TA.
                                        {{ $classroom->schoolYear->start_year }}/{{ $classroom->schoolYear->end_year }}
                                    </option>
                                @endforeach --}}
                            </select>
                            <small class="text-muted">Pilih kelas yang akan dikenakan tagihan (dapat dipilih lebih dari
                                satu)</small><br>
                            <small class="text-danger">*Jika kelas sudah dipilih maka kelas tidak dapat
                                diedit/dihapus</small>
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
        $(document).ready(function() {
            $('select[name="school_year_id"]').on('change', function() {
                var school_year_id = $(this).val();
                if (school_year_id) {
                    $.ajax({
                        url: '{{ route('api.get-classroom') }}',
                        type: "GET",
                        dataType: "json",
                        data: {
                            school_year_id: school_year_id
                        },
                        success: function(data) {
                            $('select[name="classroom_id[]"]').empty();
                            $.each(data, function(key, value) {
                                console.log(value);
                                $('select[name="classroom_id[]"]').append(
                                    '<option value="' + value.id + '">' + value.name + ' - TA. ' + value.school_year.start_year + '/' + value.school_year.end_year +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="classroom_id[]"]').empty();
                }
            });
            $('select[name="school_year_id"]').trigger('change');
        });
    </script>
@endsection
