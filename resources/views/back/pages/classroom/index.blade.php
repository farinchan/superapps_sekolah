@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-ecommerce-product-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Cari Kelas" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="w-100 mw-150px">
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Tahun Ajaran" data-kt-ecommerce-product-filter="status" id="filter-tahun-ajar">
                                <option></option>
                                @foreach ($list_school_year as $school_year)
                                    <option value="{{ $school_year->id }}">
                                        {{ $school_year->start_year }}/{{ $school_year->end_year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Kelas
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table"">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_products_table"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-250px">Kelas</th>
                                <th class=" min-w-150px">Tahun Ajaran</th>
                                <th class=" min-w-150px">Wali Kelas</th>
                                <th class=" min-w-70px">Jumlah Siswa</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($list_classroom as $item)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('back.classroom.detail', $item->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                                {{ $item->name }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->schoolYear->start_year }}/{{ $item->schoolYear->end_year }}
                                    </td>
                                    <td>
                                        {{ $item->teacher->name }}
                                    </td>
                                    <td>
                                        {{ $item->classroomStudent?->count() ?? "0" }} Siswa
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route('back.classroom.detail', $item->id) }}" class="menu-link px-3">
                                                    Detail
                                                </a>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Kelas</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.classroom.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="title" name="name"
                                placeholder="Nama kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Wali Kelas</label>
                            <select class="form-select" name="teacher_id" data-control="select2"
                                data-placeholder="Select an option" required>
                                <option></option>
                                @foreach ($list_teacher as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Tahun Ajaran</label>
                            <select class="form-select" name="school_year_id" data-control="select2"
                                data-placeholder="Select an option" required>
                                <option></option>
                                @foreach ($list_school_year as $school_year)
                                    <option value="{{ $school_year->id }}">
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



    @foreach ($list_classroom as $item)
        <div class="modal fade" tabindex="-1" id="edit{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Kelas</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.classroom.update', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" id="title" name="name"
                                    placeholder="Nama kelas" value="{{ $item->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Wali Kelas</label>
                                <select class="form-select" name="teacher_id" data-control="select2"
                                    data-placeholder="Select an option" required>
                                    <option></option>
                                    @foreach ($list_teacher as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            @if ($teacher->id == $item->teacher_id) selected @endif>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Tahun Ajaran</label>
                                <select class="form-select" name="school_year_id" data-control="select2"
                                    data-placeholder="Select an option" required>
                                    <option></option>
                                    @foreach ($list_school_year as $school_year)
                                        <option value="{{ $school_year->id }}"
                                            @if ($school_year->id == $item->school_year_id) selected @endif>
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
                        <h3 class="modal-title">Hapus Kelas</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.classroom.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus Kelas <strong> {{ $item->name }} - {{ $item->schoolYear->start_year }}/{{ $item->schoolYear->end_year }} </strong>?</p>
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
    {{-- <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/categories.js') }}"></script> --}}
    <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/products.js') }}"></script>

    {{-- <script>
        var table = $('#kt_ecommerce_products_table"').DataTable({
            responsive: true,
            columnDefs: [{
                targets: 0,
                orderable: false,
            }, ],
        });

        const filterYear = document.getElementById('filter-tahun-ajar');
        filterYear.addEventListener('change', function(e) {
            console.log(this.value);
            table.columns(2).search(this.value).draw();
        });
    </script> --}}
@endsection
