@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">

                <div class="card-header mt-6">
                    <h2 class="mb-5">
                        Whatsapp API Setting
                    </h2>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="fv-row mb-10 px-10">
                                <label class="fw-bold fs-6 mb-2">Status Server</label>
                                <div class="border  rounded mt-3">
                                    <div class="text-center ">
                                        <p class="text-gray-700 fs-3 fw-bold py-7" id="status_server">
                                            Loading...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="fv-row mb-10 px-10">
                                <label class="fw-bold fs-6 mb-2">Session Whatsapp</label>
                                <div class="border  rounded mt-3">
                                    <div class="text-center ">
                                        <p class="text-gray-700 fs-3 fw-bold py-7" id="status_whatsapp">
                                            Loading...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid mb-10 px-10">
                                <button class="btn btn-flex btn-primary px-6 justify-content-center mb-5" id="start_button">
                                    <i class="fa-solid fa-play fs-2x"></i>
                                    <span class="d-flex flex-column align-items-start ms-2">
                                        <span class="fs-3 fw-bold">Start</span>
                                        <span class="fs-7">Hubungkan Ke whatsapp</span>
                                    </span>
                                </button>
                                <button class="btn btn-flex btn-danger px-6 justify-content-center mb-5" id="stop_button">
                                    <i class="fa-solid fa-stop fs-2x"></i>
                                    <span class="d-flex flex-column align-items-start ms-2">
                                        <span class="fs-3 fw-bold">Stop</span>
                                        <span class="fs-7">Matikan koneksi whatsapp</span>
                                    </span>
                                </button>
                                <button class="btn btn-flex btn-warning px-6 justify-content-center mb-5" id="reset_button">
                                    <i class="fa-solid fa-repeat fs-2x"></i>
                                    <span class="d-flex flex-column align-items-start ms-2">
                                        <span class="fs-3 fw-bold">reset</span>
                                        <span class="fs-7">hubungkan kembali ke whatsapp</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="border border-hover-primary rounded mt-3">
                                <div class="text-center pt-15 pb-15">
                                    <h2 class="fs-2x fw-bold mb-0">Whatsapp QR Code</h2>
                                    <p class="text-gray-500 fs-4 fw-semibold py-7" id="info">
                                        Silahkan scan QR Code untuk menghubungkan ke Whatsapp API <br>
                                        Qr Code akan berubah setiap 30 detik
                                    </p>
                                    <img class="p-10" style="width: 100%" alt="" id="qr_code">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let status_server = $('#status_server');
            let status_whatsapp = $('#status_whatsapp');
            let qr_code = $('#qr_code');
            let info = $('#info');
            let start_button = $('#start_button');
            let stop_button = $('#stop_button');
            let reset_button = $('#reset_button');


            function getMySession() {
                $.ajax({
                    url: '{{ route('api.whatsapp.get-my-session') }}',
                    type: 'GET',
                    success: function(response) {
                        // console.log(response);
                        status_whatsapp.text(`${response.status} (${response.message})`);
                        if (response.status === 'Terhubung') {
                            info.html(
                                'Anda Sudah Terhubung ke Whatsapp API <br> Klik Stop Untuk Mematikan Koneksi'
                            );
                            start_button.hide();
                            stop_button.show();
                            reset_button.show();
                        } else {
                            info.html(
                                'Anda Belum Terhubung ke Whatsapp API, Silahkan Klik Start Untuk Terhubung'
                            );

                            start_button.show();
                            stop_button.hide();
                            reset_button.hide();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        status_whatsapp.text('Error (Error Get Session)');
                    }
                });
            }

            function stopSession() {
                $.ajax({
                    url: '{{ route('api.whatsapp.delete-session') }}',
                    type: 'POST',
                    success: function(response) {
                        console.log(response);
                        getMySession();
                    },
                    error: function(error) {
                        console.log(error);
                        status_whatsapp.text('Error (Error Stop Session)');
                    }
                });
            }

            function startSession() {
                start_button.attr('disabled', true);
                ws.send(JSON.stringify({
                    "session": "{{ env('WHATSAPP_API_SESSION') }}",
                }));
            }


            const ws = new WebSocket('{{ env('WHATSAPP_API_WEBSOCKET_URL') }}');
            ws.onopen = function() {
                console.log('Connected to WebSocket Server');
                status_server.text('Terhubung (WebSocket Connected)');

            };

            ws.onmessage = (e) => {
                console.log('Message:', e.data);
                let data = JSON.parse(e.data);
                if (data.type === 'qr') {
                    qr_code.attr('src', data.qr);
                    info.html(
                        'Silahkan scan QR Code untuk menghubungkan ke Whatsapp API <br> Qr Code akan berubah setiap 30 detik'
                    );
                }
            };

            ws.onerror = function(error) {
                console.log('WebSocket Error ', error);
                status_server.text('Error (WebSocket Error)');
            };
            ws.onclose = () => {
                console.log('WebSocket Closed');
                status_server.text('Tidak Terhubung (WebSocket Closed)');
            };



            getMySession();

            stop_button.click(function() {
                stopSession();
            });
            start_button.click(function() {
                startSession();
            });

            reset_button.click(function() {
                stopSession();
                setTimeout(() => {
                    startSession();
                }, 1000);
            });

        });
    </script>
@endsection
