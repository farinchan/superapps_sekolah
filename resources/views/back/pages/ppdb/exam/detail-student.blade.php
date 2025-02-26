@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('back.pages.ppdb.exam.detail-header')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Nilai Ujian</h3>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                <input type="text" id="search" class="form-control form-control-solid w-250px ps-12"
                                    placeholder="Cari Calon Siswa">
                            </div>
                        </div>

                        <a href="#" class="btn btn-light-primary">
                            Export
                        </a>
                    </div>
                </div>
                <div class="card-body">
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
                                <th class="min-w-200px">Calon Siswa</th>
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
                url: `/back/ppdb/exam/detail/${exam_id}/student/datatable`, // Ganti dengan rute yang sesuai
                type: 'GET',
                data: function(d) {
                    // Kirim parameter tambahan jika diperlukan
                    d.search = $('#search').val();
                }
            },
            order: [
                [1, 'asc']
            ],
            columns: [{
                    data: 'index',
                    name: 'index',
                },
                {
                    data: 'siswa',
                    name: 'siswa',
                },
                {
                    data: 'nilai',
                    name: 'nilai'
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ],
            "createdRow": function(row, data, dataIndex) {
                $(row).find('td').eq(0).addClass('');
                $(row).find('td').eq(1).addClass('d-flex align-items-center');
                $(row).find('td').eq(2).addClass('text-end pe-0');
                $(row).find('td').eq(3).addClass('text-end');
            }
        });

        $('#search').on('keyup', function() {
            $('#datatable_ajax').DataTable().ajax.reload();
        });

        $('#class_id').on('change', function() {
            $('#datatable_ajax').DataTable().ajax.reload();
        });
    </script>
@endsection
