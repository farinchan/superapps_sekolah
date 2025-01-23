@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        {{-- <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-ecommerce-category-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Cari ajaran" />
                        </div> --}}
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Jalur Pendaftaran
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_category_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="">Jalur Pendaftaran</th>
                                <th class="">Tahun Ajaran</th>
                                <th class="">rentang Waktu</th>
                                <th class="">Group</th>
                                <th class="">Pendaftar</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($list_path as $item)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>

                                        <div class="d-flex">
                                            <div class="">
                                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" >{{ $item->name }}</a>
                                                <div class="text-muted fs-7 fw-bold">
                                                    {{ $item->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->schoolYear->start_year }}/{{ $item->schoolYear->end_year }}
                                    </td>
                                    <td>
                                        {{ $item->start_date }} - {{ $item->end_date }}
                                    </td>
                                    <td>
                                        <a href="{{ $item->wa_group ?? "#" }}"
                                            target="_blank">
                                            <img src="{{ asset("img_ext/whatsapp.svg") }}" alt="" style="width: 50px" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Bergabung ke Group" data-bs-original-title="Bergabung ke Group" >

                                        </a>
                                    </td>
                                    <td>
                                            {{ $item->registrationUsers->count() }} Pendaftar
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route("back.ppdb.path.detail", $item->id)}}" class="menu-link px-3" >
                                                    Detail</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $item->id }}">
                                                    Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $item->id }}">
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Jalur Pendaftaran</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.ppdb.path.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label required">Nama Jalur</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Nama Jalur Pendaftaran" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="title" class="form-label required">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="title" name="start_date"
                                        value="{{ old('start_date') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label required">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="title" name="end_date"
                                        value="{{ old('end_date') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="title" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Link Whatsapp Group</label>
                            <input type="text" class="form-control" id="title" name="wa_group"
                                value="{{ old('wa_group') }}" placeholder="https://chat.whatsapp.com/...">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label required">Tahun Ajaran</label>
                            <select class="form-select" name="school_year_id" required>
                                <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($list_school_year as $school_year)
                                    <option value="{{ $school_year->id }}" @if (old('school_year_id') == $school_year->id) selected @endif>
                                        {{ $school_year->start_year }}/{{ $school_year->end_year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @foreach ($list_path as $item)
        <div class="modal fade" tabindex="-1" id="edit{{ $item->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Jalur Pendaftaran</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.ppdb.path.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label required">Nama Jalur</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $item->name }}" placeholder="Nama Jalur Pendaftaran" required>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label required">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="title" name="start_date"
                                            value="{{ $item->start_date }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title" class="form-label required">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="title" name="end_date"
                                            value="{{ $item->end_date }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="title" name="description">{{ $item->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Link Whatsapp Group</label>
                                <input type="text" class="form-control" id="title" name="wa_group"
                                    value="{{ $item->wa_group }}" placeholder="https://chat.whatsapp.com/...">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label required">Tahun Ajaran</label>
                                <select class="form-select" name="school_year_id" required>
                                    <option value="">Pilih Tahun Ajaran</option>
                                    @foreach ($list_school_year as $school_year)
                                        <option value="{{ $school_year->id }}"
                                            @if ($item->school_year_id == $school_year->id) selected @endif>
                                            {{ $school_year->start_year }}/{{ $school_year->end_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="delete{{ $item->id }}">
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

                    <form action="{{ route('back.ppdb.path.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus jalur pendaftaran <strong> {{ $item->name }} TA
                                        {{ $item->schoolYear->start_year }}/{{ $item->schoolYear->end_year }}</strong>
                                    ini?</p>
                                <p class="text-danger"><strong>Warning :</strong> Semua data yang terkait dengan jalur
                                    pendaftaran ini akan ikut terhapus.</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('scripts')
    <script>
        var table = $('#kt_ecommerce_category_table').DataTable({
            responsive: true,
            columnDefs: [{
                targets: 0,
                orderable: false,
            } ],
            order: []
        });
    </script>
@endsection
