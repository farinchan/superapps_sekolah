@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="d-flex flex-wrap gap-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-4 me-lg-7">
                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                data-kt-check-target="#kt_inbox_listing .form-check-input" value="1" />
                        </div>
                        <a href="" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                            data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Reload">
                            <i class="ki-outline ki-arrows-circle fs-2"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                            data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Archive">
                            <i class="ki-outline ki-sms fs-2"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center position-relative">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input type="text" data-kt-inbox-listing-filter="search"
                                class="form-control form-control-sm form-control-solid mw-100 min-w-125px min-w-lg-150px min-w-xxl-200px ps-11"
                                placeholder="Search inbox" />
                        </div>
                        <a href="#"
                            class="btn btn-sm btn-icon btn-color-primary btn-light btn-active-light-primary d-lg-none"
                            data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top"
                            title="Toggle inbox menu" id="kt_inbox_aside_toggle">
                            <i class="ki-outline ki-burger-menu-2 fs-3 m-0"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-row-dashed fs-6 gy-5 my-0" id="kt_inbox_listing">
                        <thead class="d-none">
                            <tr>
                                <th>Checkbox</th>
                                <th>Actions</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_message as $message)
                                <tr>
                                    <td class="w-10px ps-9">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid mt-3">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="w-150px">
                                        <a href="#"
                                            class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Lihat Selengkapnya">
                                            <i class="ki-outline ki-eye fs-3" data-bs-toggle="modal"
                                                data-bs-target="#view{{ $message->id }}"></i>
                                        </a>
                                        <a href="mailto:{{ $message->email }}?subject=re:{{ $message->subject }}&body=Balasan Dari {{ Auth::user()?->teacher?->name }}"
                                            class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Reply Pesan">
                                            <i class="ki-outline ki-message-edit fs-4 mt-1"></i>
                                        </a>
                                        <a href="#"
                                            class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Hapus Pesan">
                                            <i class="ki-outline ki-trash fs-3 text-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $message->id }}"></i>
                                        </a>
                                    </td>
                                    <td class="w-150px w-md-175px">
                                        <a href="mailto:{{ $message->email }}?subject=re:{{ $message->subject }}&body=Balasan Dari {{ Auth::user()?->teacher?->name }}"
                                            class="d-flex align-items-center text-gray-900">
                                            <div class="symbol symbol-35px me-3">
                                                <div class="symbol-label bg-light-danger">
                                                    <span class="text-danger">
                                                        {{ strtoupper(substr($message->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div>

                                                <span class="fw-semibold">{{ $message->name }}</span>
                                                <br>
                                                <small>{{ $message->email }}</small>
                                                <br>
                                                <small>{{ $message->phone }} </small>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="text-gray-900 gap-1 pt-2">
                                            <a href="#" class="text-gray-900">
                                                <span class="fw-bold" data-bs-toggle="modal"
                                                    data-bs-target="#view{{ $message->id }}">
                                                    {{ $message->subject }}</span>
                                                <br>
                                                <span class=" text-muted">
                                                    {{ Str::limit($message->message, 50) }}
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="min-w-100px text-end fs-7 pe-9">
                                        <span class="fw-semibold">{{ $message->created_at->diffForHumans() }}</span>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($list_message as $message)
        <!-- Modal-->
        <div class="modal fade" tabindex="-1" id="view{{ $message->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Lihat Pesan</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label required">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $message->name }}" placeholder="Nama" required readonly>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="title" class="form-label required">Email</label>
                                    <input type="email" class="form-control" id="title" name="email"
                                        value="{{ $message->email }}" placeholder="Email" required readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label required">Phone/WA</label>
                                    <input type="text" class="form-control" id="title" name="phone"
                                        value="{{ $message->phone }}" placeholder="Phone/WA" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label required">Subjek</label>
                            <input type="text" class="form-control" id="title" name="subject"
                                value="{{ $message->subject }}" placeholder="Subjek" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Pesan" readonly>{{ $message->message }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="delete{{ $message->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Hapus Jalur Pendafataran</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.ppdb.message.destroy', $message->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus pesan dari <strong>{{ $message->name }}</strong> ?</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
    <script src="{{ asset('back/js/custom/apps/inbox/listing.js') }}"></script>
@endsection
