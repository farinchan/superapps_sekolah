@extends('back.app')

@section('styles')
    <style>
        .html5-qrcode-element {

        }

    </style>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">

                <div class="card-header mt-6">
                    <h2 class="mb-5">
                        Scan QR Presensi Siswa
                    </h2>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-4 mb-5">
                            <img src="{{ asset('img_ext/attendance.png') }}" style="width: 100%" alt="" />
                        </div>
                        <div class="col-md-8">
                            <form id="kt_modal_create_discipline_rule_form" class="form"
                                action="{{ route('back.discipline.student.store') }}" method="POST">
                                @csrf


                                <div class="fv-row mb-4">
                                    <div id="reader" width="600px"></div>
                                </div>

                                <div class="fv-row mb-4">
                                    <div class="input-group ">
                                        <input type="text" class="form-control" placeholder="QR Code" id="qr_code" readonly>
                                        <button class="btn btn-secondary" type="button"
                                            id="button-addon2">QR Scanner</button>
                                    </div>
                                </div>
                                <div class="separator separator-content my-14">
                                    <span class="w-200px text-gray-500 fw-semibold fs-7">atau Manual Input</span>
                                </div>

                                <div class="fv-row mb-4">
                                    <div class="input-group ">
                                        <input type="text" class="form-control" placeholder="NISN" id="qr_code" readonly>
                                        <button class="btn btn-primary" type="button"
                                            id="button-addon2">Input</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>

            <div class="card card-flush h-lg-100 mt-10  ">
                <div class="card-header pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">History</span>
                    </h3>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table id="scan_history"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>Siswa</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Jenis Absensi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

    <script>
        $(document).ready(function() {
            $('#scan_history').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('back.student-attendance.history-scan') }}",
                columns: [{
                        data: 'student',
                        name: 'student'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'attendance_type',
                        name: 'attendance_type'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                ]
            });
        });
        </script>
@endsection
