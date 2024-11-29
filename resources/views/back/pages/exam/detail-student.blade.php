@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('back.pages.exam.detail-header')
            <div class="card card-flush">
                <div class="card-header align-items-center">
                    <div class="card-title fw-bolder">Penilaian Siswa</div>
                </div>
                <div class="card-body pt-0">

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" id="search" class="form-control form-control-solid ps-12"
                                    placeholder="Cari Siswa" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center position-relative my-1">
                                <select data-control="select2" data-hide-search="true" data-placeholder="Pilih Kelas"
                                    id="class_id" class="form-select form-select-solid form-select-lg fw-bold">
                                    <option value="0" selected>Semua</option>
                                    @foreach ($list_classroom as $class)
                                        <option value="{{ $class->classroom?->id }}">{{ $class->classroom?->name }} -
                                            {{ $class->classroom?->schoolYear?->start_year }}
                                            / {{ $class->classroom?->schoolYear?->end_year }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" mb-5">
                        <div class="btn-group" role="group">
                            <button onclick="exportNilai({{ $exam->id }})" class="btn  btn-secondary"><i
                                    class="ki-duotone ki-file-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>&nbsp;
                                Export Nilai</button>
                        </div>
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
                                <th class="text-start min-w-70px">Kelas</th>
                                <th class="text-end min-w-70px">Nilai</th>
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
@endsection
@section('scripts')
    <script>
        var exam = @json($exam);
        exam_id = exam.id;



        $('#datatable_ajax').DataTable({
            processing: true, // Menampilkan indikator loading
            serverSide: true, // Menggunakan server-side processing
            ajax: {
                url: `/back/exam/detail/${exam_id}/student/datatable`, // Ganti dengan rute yang sesuai
                type: 'GET',
                data: function(d) {
                    // Kirim parameter tambahan jika diperlukan
                    d.search = $('#search').val();
                    d.classroom_id = $('#class_id').val() != 0 ? $('#class_id').val() : null;
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
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'nilai',
                    name: 'nilai'
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
                $(row).find('td').eq(4).addClass('text-end');
            }
        });

        $('#search').on('keyup', function() {
            $('#datatable_ajax').DataTable().ajax.reload();
        });

        $('#class_id').on('change', function() {
            $('#datatable_ajax').DataTable().ajax.reload();
        });
    </script>

    <script>
        function exportNilai(exam_id) {
            console.log(exam_id);

            var search = $('#search').val();
            var classroom_id = $('#class_id').val() != 0 ? $('#class_id').val() : "";
            window.location.href =
                `/back/exam/detail/${exam_id}/student/export?search=${search}&classroom_id=${classroom_id}`;
        }
    </script>
@endsection
