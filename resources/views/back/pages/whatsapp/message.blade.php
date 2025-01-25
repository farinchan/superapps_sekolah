@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">

                <div class="card-header mt-6">
                    <h2 class="mb-5">
                        Kirim Pesan Whatsapp
                    </h2>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('img_ext/wa_massage.png') }}" style="width: 100%" alt="" />
                        </div>
                        <div class="col-md-8">
                            <form id="kt_modal_create_discipline_rule_form" class="form" method="POST">
                                <div class="fv-row mb-10">
                                    <label class="required fw-bold fs-6 mb-2">Kepada (No Whatsapp)</label>
                                    <input class="form-control form-control-solid form-control-lg fw-bold" type="text"
                                        placeholder="628++++" name="phone" />
                                    <small class="text-muted">Pastikan nomor whatsapp benar, nomor diawali dengan kode
                                        negara tanpa tanda <code>+</code> atau <code>0</code>, dengan contoh
                                        <code>6281234567890</code></small>
                                </div>

                                <div class="fv-row mb-10">
                                    <label class="required fw-bold fs-6 mb-2">Pesan</label>
                                    <textarea class="form-control form-control-solid form-control-lg fw-bold" name="message" rows="10" placeholder=""></textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary" id="send_message_btn">
                                        <span class="indicator-label">Kirim Pesan</span>
                                    </button>
                                </div>

                            </form>
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
            $('#kt_modal_create_discipline_rule_form').submit(function(e) {
                $('#send_message_btn').attr('disabled', true);
                $('#send_message_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('api.whatsapp.send-message') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            swal.fire({
                                title: "Berhasil",
                                text: response.message,
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                                reverseButtons: true
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        } else {
                            toastr.error(response.message);
                            swal.fire({
                                title: "Gagal",
                                html: `${response.message} <br> <small class="text-danger">${response.error.message}</small>`,
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                                reverseButtons: true
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        var res = xhr.responseJSON;
                        toastr.error(res.message);
                        swal.fire({
                            title: "Gagal",
                            html: `${res.message} <br> <small class="text-danger">${res.error.message}</small>`,
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                            reverseButtons: true
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });
    </script>
@endsection
