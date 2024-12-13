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

                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100" id="datatable_ajax">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                <th>Siswa</th>
                                <th>Tanggal</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Pulang</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </ div>
    @endsection
    @section('scripts')
        <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/discipline.js') }}"></script>
        <script src="{{ asset('back/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
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


            $('#datatable_ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('back.student-attendance.history.datatable') }}",
                    type: 'GET',
                    data: function(d) {
                        d.search = {{ Auth::user()->parent?->student?->nisn ?? Auth::user()->student?->nisn }};
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    }
                },

                columns: [{
                        data: 'student',
                        name: 'student'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'time_in',
                        name: 'time_in'
                    },
                    {
                        data: 'time_out',
                        name: 'time_out'
                    }
                ],
                order: [],
                "createdRow": function(row, data, dataIndex) {
                    $(row).find('td').eq(0).addClass('d-flex align-items-center');
                    $(row).find('td').eq(1).addClass('text-start pe-0');
                    $(row).find('td').eq(2).addClass('text-start pe-0');
                    $(row).find('td').eq(3).addClass('text-start pe-0');
                }
            });

            $('#start_date, #end_date').on('change', function() {
                $('#datatable_ajax').DataTable().ajax.reload();
                console.log(
                    $('#start_date').val(),
                    $('#end_date').val()
                );

            });
        </script>
    @endsection
