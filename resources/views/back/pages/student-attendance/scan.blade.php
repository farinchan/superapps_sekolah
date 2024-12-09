@extends('back.app')

@section('styles')
    <style>
        .html5-qrcode-element {}
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

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="radio_buttons_2" checked="checked"
                                        id="camera_mode" />
                                    <label
                                        class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-5"
                                        for="camera_mode">
                                        <i class="ki-duotone ki-setting-2 fs-4x me-4"><span class="path1"></span><span
                                                class="path2"></span></i>

                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-gray-900 fw-bold d-block fs-3">Camera QR Scanner</span>
                                            <span class="text-muted fw-semibold fs-6">
                                                Scan QR Code dengan kamera untuk melakukan presensi siswa.
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="radio_buttons_2" id="scanner_mode" />
                                    <label
                                        class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
                                        for="scanner_mode">
                                        <i class="ki-duotone ki-message-text-2 fs-4x me-4"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span></i>

                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-gray-900 fw-bold d-block fs-3">Mesin QR Scanner</span>
                                            <span class="text-muted fw-semibold fs-6">
                                                Scan QR Code dengan mesin untuk melakukan presensi siswa.
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="fv-row mb-4" id="camera_mode_input">
                                <div id="reader" width="600px"></div>
                            </div>

                            <div class="fv-row mb-4" id="scanner_mode_input" style="display: none;">
                                <div class="input-group ">
                                    <input type="text" class="form-control me-5" placeholder="QR Code"
                                        id="scanner_qr_code" readonly>
                                </div>
                            </div>

                            <div class="separator separator-content my-14">
                                <span class="w-200px text-gray-500 fw-semibold fs-7">atau Manual Input</span>
                            </div>

                            <div class="fv-row mb-4">
                                <div class="input-group ">
                                    <input type="text" class="form-control" placeholder="NISN" id="qr_code_nisn">
                                    <button class="btn btn-primary" type="button" id="qr_code_nisn_process">enter</button>
                                </div>
                            </div>
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
                                    <th>Waktu Masuk</th>
                                    <th>Waktu Pulang</th>
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
    <script>
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
    </script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toastr-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            let qr_code = decodedText;
            if (qr_code.length == 10) {
                console.log(qr_code);
                html5QrcodeScanner.pause();
                ajaxScanQrCode(qr_code);

            }
        }

        function onScanFailure(error) {
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 30,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        function ajaxScanQrCode(qr_code) {
            Swal.fire({
                title: 'Processing...',
                text: `Scanned code: ${qr_code}`,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: "{{ route('back.student-attendance.scan') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nisn: qr_code
                },
                success: function(response) {
                    swal.close();
                    console.log(response);
                    if (response.status == 'success') {
                        toastr.success(response.message);
                        $('#scan_history').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                    try {
                        html5QrcodeScanner.resume();
                    } catch (error) {
                        console.log(error);
                    }

                },
                error: function(err) {
                    swal.close();
                    console.log(err);
                    toastr.error('Terjadi kesalahan');
                    try {
                        html5QrcodeScanner.resume();
                    } catch (error) {
                        console.log(error);
                    }
                }
            });
        }
    </script>


    <script>
        $('#scanner_mode').change(function() {
            $('#camera_mode').prop('checked', false);
            if ($(this).is(':checked')) {
                $('#scanner_mode_input').show();
                $('#camera_mode_input').hide();

                html5QrcodeScanner.clear().then(status => {
                    console.log(`Camera QR Code scanner cleared: ${status}`);
                    $('#reader').html('Camera QR Code scanner Stopped');

                }).catch(err => {
                    console.log(`Error clearing QR Code scanner: ${err}`);
                });

                $('#scanner_qr_code').val('');
                $(document).keydown(function(event) {
                    var inputElement = $('#scanner_qr_code');
                    if (event.key >= '0' && event.key <= '9') {
                        inputElement.val(inputElement.val() + event.key);
                        if (inputElement.val().length == 10) {
                            ajaxScanQrCode(inputElement.val());
                            console.log(inputElement.val());

                            inputElement.val('');
                        }
                    }
                });

            }
        });

        $('#camera_mode').change(function() {
            $('#scanner_mode').prop('checked', false);
            $('#scanner_qr_code').val('');
            if ($(this).is(':checked')) {
                $('#scanner_mode_input').hide();
                $('#camera_mode_input').show();

                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }
        });

        $('#qr_code_nisn').keypress(function(event) {
            $('#scanner_qr_code').val('');
        });

        $('#qr_code_nisn_process').click(function() {
            let qr_code = $('#qr_code_nisn').val();
            if (qr_code.length == 10) {
                ajaxScanQrCode(qr_code);
            } else {
                toastr.error('NISN harus 10 digit');
            }
        });
    </script>
@endsection
