@extends('back.app')

@section('styles')
    <link href="{{ asset('back/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .fc-event {
            cursor: pointer;
            /* Mengubah kursor menjadi pointer */
        }

        .fc-event:hover {
            cursor: pointer;
            /* Menjaga kursor tetap pointer saat hover */
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title fw-bold">Kalender Akademik</h2>
                    <div class="card-toolbar">
                        <button class="btn btn-flex btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_event">
                            <i class="ki-duotone ki-plus fs-2"></i>Tambah</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="calendar_academic"></div>
                </div>
            </div>
            <div class="modal fade" id="kt_modal_add_event" tabindex-="1" aria-hidden="true" data-bs-focus="false">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="fw-bold" data-kt-calendar="title">Tambahkan Kalender</h2>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                        </div>
                        <form action="{{ route('back.calendar.store') }}" method="POST">
                            @csrf
                            <div class="modal-body py-10 px-lg-17">
                                <div class="fv-row mb-5">
                                    <label class="fs-6 fw-semibold required mb-2">Nama</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Nama Acara"
                                        name="title" />
                                </div>
                                <div class="fv-row mb-5">
                                    <label class="fs-6 fw-semibold mb-2">Lokasi</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Lokasi"
                                        name="location" />
                                </div>
                                <div class="fv-row mb-5">
                                    <label class="fs-6 fw-semibold mb-2">Deskripsi</label>
                                    <textarea class="form-control form-control-solid" placeholder="Deskripsi" rows="3" name="description"></textarea>
                                </div>

                                <div class="row row-cols-lg-2 g-10">
                                    <div class="col">
                                        <div class="fv-row mb-5">
                                            <label class="fs-6 fw-semibold mb-2 required">Dari</label>
                                            <input class="form-control form-control-solid" name="start"
                                                type="datetime-local" required />
                                        </div>
                                    </div>
                                    <div class="col" data-kt-calendar="datepicker">
                                        <div class="fv-row mb-9">
                                            <label class="fs-6 fw-semibold mb-2 required">Sampai</label>
                                            <input class="form-control form-control-solid" name="end"
                                                type="datetime-local" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer flex-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="kt_modal_add_event_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="kt_modal_view_event" tabindex-="1" aria-hidden="true" data-bs-focus="false">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="fw-bold">Lihat Kalender</h2>
                            <div class="justify-content-end">
                                <form action="{{ route('back.calendar.destroy') }}" method="post" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" id="id_delete" name="id" />
                                    <button type="submit" class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-danger me-2"
                                        data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        data-bs-original-title="Hapus Kalender">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button>
                                </form>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('back.calendar.update') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-body py-10 px-lg-17">
                                <input type="hidden" id="id_edit" name="id" />
                                <div class="fv-row mb-5">
                                    <label class="fs-6 fw-semibold required mb-2">Nama</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nama Acara" id="title_edit" name="title" />
                                </div>
                                <div class="fv-row mb-5">
                                    <label class="fs-6 fw-semibold mb-2">Lokasi</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Lokasi"
                                        id="location_edit" name="location" />
                                </div>
                                <div class="fv-row mb-5">
                                    <label class="fs-6 fw-semibold mb-2">Deskripsi</label>
                                    <textarea class="form-control form-control-solid" placeholder="Deskripsi" rows="3" name="description"
                                        id="description_edit"></textarea>
                                </div>
                                <div class="row row-cols-lg-2 g-10">
                                    <div class="col">
                                        <div class="fv-row mb-5">
                                            <label class="fs-6 fw-semibold mb-2 required">Dari</label>
                                            <input class="form-control form-control-solid" name="start" id="start_edit"
                                                type="datetime-local" required />
                                        </div>
                                    </div>
                                    <div class="col" data-kt-calendar="datepicker">
                                        <div class="fv-row mb-9">
                                            <label class="fs-6 fw-semibold mb-2 required">Sampai</label>
                                            <input class="form-control form-control-solid" name="end" id="end_edit"
                                                type="datetime-local" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer flex-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="kt_modal_view_event_submit" class="btn btn-warning">
                                    <span class="indicator-label">Update</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('back/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('back/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="{{ asset('back/js/custom/apps/calendar/calendar_academic.js') }}"></script>
@endsection
