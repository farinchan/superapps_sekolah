@extends('back.app')

@section('styles')
    <link href="{{ asset('back/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('back/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title fw-bold">Calendar</h2>
                <div class="card-toolbar">
                    <button class="btn btn-flex btn-primary" data-kt-calendar="add">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Event</button>
                </div>
            </div>
            <div class="card-body">
                <div id="kt_calendar_app"></div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_add_event" tabindex-="1" aria-hidden="true" data-bs-focus="false">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <form class="form" action="#" id="kt_modal_add_event_form">
                        <div class="modal-header">
                            <h2 class="fw-bold" data-kt-calendar="title">Add Event</h2>
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_event_close">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <div class="modal-body py-10 px-lg-17">
                            <div class="fv-row mb-9">
                                <label class="fs-6 fw-semibold required mb-2">Event Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_name" />
                            </div>
                            <div class="fv-row mb-9">
                                <label class="fs-6 fw-semibold mb-2">Event Description</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_description" />
                            </div>
                            <div class="fv-row mb-9">
                                <label class="fs-6 fw-semibold mb-2">Event Location</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_location" />
                            </div>
                            <div class="fv-row mb-9">
                                <label class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" id="kt_calendar_datepicker_allday" />
                                    <span class="form-check-label fw-semibold" for="kt_calendar_datepicker_allday">All Day</span>
                                </label>
                            </div>
                            <div class="row row-cols-lg-2 g-10">
                                <div class="col">
                                    <div class="fv-row mb-9">
                                        <label class="fs-6 fw-semibold mb-2 required">Event Start Date</label>
                                        <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" />
                                    </div>
                                </div>
                                <div class="col" data-kt-calendar="datepicker">
                                    <div class="fv-row mb-9">
                                        <label class="fs-6 fw-semibold mb-2">Event Start Time</label>
                                        <input class="form-control form-control-solid" name="calendar_event_start_time" placeholder="Pick a start time" id="kt_calendar_datepicker_start_time" />
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-lg-2 g-10">
                                <div class="col">
                                    <div class="fv-row mb-9">
                                        <label class="fs-6 fw-semibold mb-2 required">Event End Date</label>
                                        <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="Pick a end date" id="kt_calendar_datepicker_end_date" />
                                    </div>
                                </div>
                                <div class="col" data-kt-calendar="datepicker">
                                    <div class="fv-row mb-9">
                                        <label class="fs-6 fw-semibold mb-2">Event End Time</label>
                                        <input class="form-control form-control-solid" name="calendar_event_end_time" placeholder="Pick a end time" id="kt_calendar_datepicker_end_time" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="reset" id="kt_modal_add_event_cancel" class="btn btn-light me-3">Cancel</button>
                            <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kt_modal_view_event" tabindex="-1" data-bs-focus="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header border-0 justify-content-end">
                        <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event" id="kt_modal_view_event_edit">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event" id="kt_modal_view_event_delete">
                            <i class="ki-duotone ki-trash fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </div>
                        <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-2x">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body pt-0 pb-20 px-lg-17">
                        <div class="d-flex">
                            <i class="ki-duotone ki-calendar-8 fs-1 text-muted me-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                                <span class="path6"></span>
                            </i>
                            <div class="mb-9">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-3 fw-bold me-3" data-kt-calendar="event_name"></span>
                                    <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                                </div>
                                <div class="fs-6" data-kt-calendar="event_description"></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="bullet bullet-dot h-10px w-10px bg-success ms-2 me-7"></span>
                            <div class="fs-6">
                                <span class="fw-bold">Starts</span>
                                <span data-kt-calendar="event_start_date"></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-9">
                            <span class="bullet bullet-dot h-10px w-10px bg-danger ms-2 me-7"></span>
                            <div class="fs-6">
                                <span class="fw-bold">Ends</span>
                                <span data-kt-calendar="event_end_date"></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-geolocation fs-1 text-muted me-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="fs-6" data-kt-calendar="event_location"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('back/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('back/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script src="{{ asset('back/js/custom/apps/calendar/calendar.js') }}"></script>
@endsection
