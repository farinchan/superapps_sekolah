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
                            Tambah Tahun Ajaran
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
                                <th class="min-w-250px">Tahun Ajaran</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($list_school_year as $item)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1"
                                                data-kt-ecommerce-category-filter="category_name">{{ $item->start_year }}/{{ $item->end_year }}</a>

                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
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
                    <h3 class="modal-title">Tambah Tahun Ajaran</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.school-year.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tahun Awal Ajaran</label>
                            <input type="number" class="form-control" id="title" name="start_year"
                                placeholder="Tahun awal ajaran" min="1900" max="2099" step="1"
                                value="{{ date('Y') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Tahun Akhir Ajaran</label>
                            <input type="number" class="form-control" id="title" name="end_year"
                                placeholder="Tahun akhir ajaran" min="1900" max="2099" step="1"
                                value="{{ date('Y') + 1 }}" required>
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



    @foreach ($list_school_year as $item)
    <div class="modal fade" tabindex="-1" id="edit{{ $item->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Tahun Ajaran</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.school-year.update', $item->id ) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tahun Awal Ajaran</label>
                            <input type="number" class="form-control" id="title" name="start_year"
                                placeholder="Tahun awal ajaran" min="1900" max="2099" step="1"
                                value="{{ $item->start_year }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Tahun Akhir Ajaran</label>
                            <input type="number" class="form-control" id="title" name="end_year"
                                placeholder="Tahun akhir ajaran" min="1900" max="2099" step="1"
                                value="{{ $item->end_year }}" required>
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
                        <h3 class="modal-title">Hapus Tahun Ajaran</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.school-year.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus ajaran <strong> {{ $item->start_year }}/{{ $item->end_year }} </strong>?</p>
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
            }, ],
        });

    </script>
@endsection