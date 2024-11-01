@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center">
                    <div class="card-title fw-bolder">Pelanggaran Siswa</div>
                </div>
                <div class="card-body pt-0">

                    <div class="row mb-5">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" id="search" class="form-control form-control-solid ps-12"
                                    placeholder="Cari Siswa" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center position-relative my-1">
                                <select data-control="select2" data-hide-search="true" data-placeholder="Pilih Tahun Ajaran"
                                    id="school_year_id" class="form-select form-select-solid form-select-lg fw-bold">
                                    <option selected disabled></option>
                                    @foreach ($list_school_year as $school_year)
                                        <option value="{{ $school_year->id }}">
                                            {{ $school_year->start_year }}/{{ $school_year->end_year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center position-relative my-1">
                                <select data-control="select2" data-hide-search="true" data-placeholder="Pilih Kelas"
                                    id="class_id" class="form-select form-select-solid form-select-lg fw-bold">
                                    <option selected disabled></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-calendar-search fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                <input type="text" id="start_date" class="form-control form-control-solid ps-12"
                                    placeholder="Dari tanggal" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-calendar-search fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                <input type="text" id="end_date" class="form-control form-control-solid ps-12"
                                    placeholder="Sampai tanggal" />
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="btn-group my-1" role="group" aria-label="Basic example">
                                <a href="#" class="btn btn-secondary" id="filter">
                                    <i class="ki-duotone ki-magnifier fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Filter
                                </a>
                                <a href="#" class="btn btn-secondary">
                                    <i class="ki-duotone ki-file-up fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Export
                                </a>
                            </div>
                        </div> --}}
                    </div>

                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable_ajax">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-200px">Siswa</th>
                                <th class="text-start min-w-100px">Pelanggaran</th>
                                <th class="text-end min-w-70px">Point</th>
                                <th class="text-end min-w-70px">Tanggal</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @foreach ($list_discipline as $discipline)
        <div class="modal fade" tabindex="-1" id="delete{{ $discipline->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Hapus Berit</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <form action="{{ route('back.discipline.student.destroy', $discipline->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus Pelanngaran siswa <strong>{{ $discipline->students?->name }}</strong>?<br>
                                    pada pelanggaran <strong>{{ $discipline->rules?->rule }}</strong>
                                    <strong>{{ $discipline->discipline }}</strong> dengan point <strong>{{ $discipline->rules?->point }}</strong> pada tanggal <strong>{{ $discipline->date }}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
    <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/discipline.js') }}"></script>
    <script>
        $("#start_date").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
        $("#end_date").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        $('#school_year_id').on('change', function() {
            var school_year_id = $(this).val();
            $.ajax({
                url: "{{ route('api.get-classroom') }}",
                type: 'GET',
                data: {
                    school_year_id: school_year_id
                },
                success: function(data) {
                    console.log(data);

                    data.forEach(function(item) {
                        console.log(item);
                        $('#class_id').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                }
            });
        });



        $('#datatable_ajax').DataTable({
            processing: true, // Menampilkan indikator loading
            serverSide: true, // Menggunakan server-side processing
            ajax: {
                url: "{{ route('back.discipline.student.datatableAjax') }}", // Ganti dengan rute yang sesuai
                type: 'GET',
                data: function(d) {
                    // Kirim parameter tambahan jika diperlukan
                    d.search = $('#search').val();
                    d.school_year_id = $('#school_year_id').val();
                    d.class_id = $('#class_id').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    data: 'index',
                    name: 'index',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'siswa',
                    name: 'siswa',
                },
                {
                    data: 'pelanggaran',
                    name: 'pelanggaran'
                },
                {
                    data: 'point',
                    name: 'point'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            "createdRow": function(row, data, dataIndex) {
                $(row).find('td').eq(0).addClass('');
                $(row).find('td').eq(1).addClass('d-flex align-items-center');
                $(row).find('td').eq(2).addClass('text-start pe-0');
                $(row).find('td').eq(3).addClass('text-end pe-0');
                $(row).find('td').eq(4).addClass('text-end pe-0');
                $(row).find('td').eq(5).addClass('text-end');
            }
        });

        // Event listener untuk filter (optional)
        $('#search').on('keyup', function() {
            $('#datatable_ajax').DataTable().ajax.reload();
        });

        $('#school_year_id, #class_id, #start_date, #end_date').on('change', function() {
            $('#datatable_ajax').DataTable().ajax.reload();
            console.log(
                $('#school_year_id').val(),
                $('#class_id').val(),
                $('#start_date').val(),
                $('#end_date').val()
            );

        });
    </script>
@endsection
