@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <form action="{{ route('back.ppdb.path.update', $path->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="name" class="form-label required">Nama Jalur</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $path->name }}" placeholder="Nama Jalur Pendaftaran" required>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label required">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="title" name="start_date"
                                            value="{{ $path->start_date }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title" class="form-label required">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="title" name="end_date"
                                            value="{{ $path->end_date }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="title" name="description">{{ $path->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Link Whatsapp Group</label>
                                <input type="text" class="form-control" id="title" name="wa_group"
                                    value="{{ $path->wa_group }}" placeholder="https://chat.whatsapp.com/...">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label required">Tahun Ajaran</label>
                                <select class="form-select" name="school_year_id" required>
                                    <option value="">Pilih Tahun Ajaran</option>
                                    @foreach ($list_school_year as $school_year)
                                        <option value="{{ $school_year->id }}"
                                            @if ($path->school_year_id == $school_year->id) selected @endif>
                                            {{ $school_year->start_year }}/{{ $school_year->end_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('back.ppdb.path') }}" class="btn btn-light">Kembali</a>
                        <button type="submit" class="btn btn-warning ms-2">Update</button>
                    </div>
                </form>
            </div>
            <div class="card mt-5">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13" placeholder="Cari Siswa" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-filter fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Filter</button>
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <div class="px-7 py-5" data-kt-user-table-filter="form">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Status Berkas</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-user-table-filter="status" data-hide-search="true">
                                            <option></option>
                                            <option value="Sedang Diverifikasi">Sedang Diverifikasi</option>
                                            <option value="Diterima">Diterima</option>
                                            <option value="Ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Status Kelulusan</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-user-table-filter="status" data-hide-search="true">
                                            <option></option>
                                            <option value="-">-</option>
                                            <option value="Lulus">Lulus</option>
                                            <option value="Tidak Lulus">Tidak Lulus</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="reset"
                                            class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                            data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6"
                                            data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-group">

                                {{-- <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#import">
                                    <i class="ki-duotone ki-file-down fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Import</a> --}}
                                <a class="btn btn-secondary" href="#">
                                    <i class="ki-duotone ki-file-up fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Export
                                </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" {{-- data-kt-user-table-toolbar="selected" --}}>
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-user-table-select="delete_selected">Delete
                                Selected</button>
                        </div>

                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">Siswa</th>
                                <th class="min-w-125px">Info</th>
                                <th class="min-w-125px">Asal Sekolah</th>
                                <th class="min-w-125px">Status Berkas</th>
                                <th class="min-w-125px">Status Kelulusan</th>
                                <th class="min-w-125px">Waktu Bergabung</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($registration_users as $registration_user)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="#">
                                                <div class="symbol-label">
                                                    <img src="{{ asset('img_ext/anonim_person.png') }}"
                                                        alt="{{ $registration_user->user->name }}" width="50px" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $registration_user->user->name }}</a>
                                            <span> NISN.{{ $registration_user->user->nisn }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <ul>
                                                <li><span class="fw-bold">NIK:
                                                    </span>{{ $registration_user->user->nik }}</li>
                                                <li><span class="fw-bold">WA:
                                                    </span>{{ $registration_user->user->whatsapp_number }}</li>
                                                <li><span
                                                        class="fw-bold">Email:</span>{{ $registration_user->user->email }}
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">{{ $registration_user->user->school_origin }}</span>
                                            <span>NPSN.{{ $registration_user->user->npsn }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($registration_user->status_berkas == 'sedang diverifikasi')
                                            <span class="badge badge-light-primary">Sedang Diverifikasi</span>
                                        @elseif ($registration_user->status_berkas == 'diterima')
                                            <span class="badge badge-light-success">Diterima</span>
                                        @elseif ($registration_user->status_berkas == 'ditolak')
                                            <span class="badge badge-light-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($registration_user->status_kelulusan == '-')
                                            <span class="badge badge-light-primary">-</span>
                                        @elseif ($registration_user->status_kelulusan == 'lulus')
                                            <span class="badge badge-light-success">Lulus</span>
                                        @elseif ($registration_user->status_kelulusan == 'tidak lulus')
                                            <span class="badge badge-light-danger">Tidak Lulus</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $registration_user->user->created_at->diffForHumans() }}
                                        <br>
                                        {{ \Carbon\Carbon::parse($registration_user->user->created_at)->format('d M Y H:i') }}
                                    </td>

                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route('back.ppdb.student.detail', $registration_user->user->id) }}"
                                                    class="menu-link px-3">Detail</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $registration_user->id }}">Keluarkan</a>
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

    @foreach ($registration_users as $registration_user)
        <div class="modal fade" tabindex="-1" id="delete{{ $registration_user->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Keluarkan Calon Siswa</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.ppdb.path.kick-student', $registration_user->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin mengeluarkan calon siswa
                                    <strong>{{ $registration_user->user->name }}</strong> dari jalur
                                    <strong>{{ $path->name }}</strong> ?</p>
                                </p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Keluarkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('scripts')
    <script src="{{ asset('back/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('back/js/custom/apps/user-management/users/list/add.js') }}"></script>
@endsection
