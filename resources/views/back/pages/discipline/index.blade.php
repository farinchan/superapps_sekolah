@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center">
                    <div class="card-title fw-bolder">Pelanggaran Siswa</div>
                </div>
                <div class="card-body pt-0">

                    <div class="row mb-5">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-ecommerce-product-filter="search"
                                    class="form-control form-control-solid ps-12" placeholder="Cari Siswa" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center position-relative my-1">
                                <select data-control="select2" data-hide-search="true" data-placeholder="Pilih Tahun Ajaran" id="school_year_id"
                                    class="form-select form-select-solid form-select-lg fw-bold">
                                    <option selected disabled></option>
                                    @foreach ($list_school_year as $school_year)
                                        <option value="{{ $school_year->id }}">
                                            {{ $school_year->start_year }}/{{ $school_year->end_year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center position-relative my-1">
                                <select data-control="select2" data-hide-search="true" data-placeholder="Pilih Kelas" id="class_id"
                                    class="form-select form-select-solid form-select-lg fw-bold">
                                    <option selected disabled></option>

                                </select>
                            </div>
                        </div>


                    </div>

                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-200px">Siswa</th>
                                <th class="text-start min-w-100px">Pelanggaran</th>
                                <th class="text-end min-w-70px">Point</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($list_discipline as $discipline)
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
                                                    <img src="{{ $discipline->students?->getPhoto() }}"
                                                        alt="{{ $discipline->students?->name }}" width="50px" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $discipline->students?->name }}</a>
                                            <span> NISN.{{ $discipline->students?->nisn }}</span>
                                            <span> NIK.{{ $discipline->students?->nik }}</span>
                                        </div>
                                    </td>
                                    <td class="text-start pe-0">
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bolder mb-1">{{ $discipline->rules?->rule }}</span>
                                            <span>{{ $discipline->description }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">+{{ $discipline->rules?->point }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit_discipline{{ $discipline->id }}"
                                                    class="menu-link px-3">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#delete_discipline{{ $discipline->id }}">Delete</a>
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

    <div class="modal fade" tabindex="-1" id="add_discipline">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Rule</h3>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('back.discipline.student.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-5">
                            <label for="title" class="required form-label">Rule</label>
                            <input type="text" class="form-control " name="discipline" id="title" placeholder="Rule"
                                required />
                        </div>
                        <div class="mb-5">
                            <label for="category" class="required form-label">Kategori</label>
                            <select class="form-select " name="category" id="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="ringan">Ringan</option>
                                <option value="sedang">Sedang</option>
                                <option value="berat">Berat</option>
                                <option value="sangat berat">Sangat Berat</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="point" class="required form-label">Point</label>
                            <input type="number" class="form-control " name="point" id="point"
                                placeholder="Point" required />
                        </div>
                        <div class="mb-5">
                            <label for="description" class=" form-label">Deskripsi</label>
                            <textarea class="form-control " name="description" id="description" rows="5" placeholder="Deskripsi"></textarea>
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


    @foreach ($list_discipline as $discipline)
        <div class="modal fade" tabindex="-1" id="edit_discipline{{ $discipline->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Rule</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <form action="{{ route('back.discipline.student.update', $discipline->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body" id="edit_discipline{{ $discipline->id }}">
                            <div class="mb-5">
                                <label for="title" class="required form-label">Rule</label>
                                <input type="text" class="form-control " name="discipline" id="title"
                                    placeholder="Rule" value="{{ $discipline->discipline }}" required />
                            </div>
                            <div class="mb-5">
                                <label for="category" class="required form-label">Kategori</label>
                                <select class="form-select " name="category" id="category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Ringan" {{ $discipline->category == 'ringan' ? 'selected' : '' }}>
                                        Ringan</option>
                                    <option value="Sedang" {{ $discipline->category == 'sedang' ? 'selected' : '' }}>
                                        Sedang</option>
                                    <option value="Berat" {{ $discipline->category == 'berat' ? 'selected' : '' }}>
                                        Berat</option>
                                    <option value="Sangat Berat"
                                        {{ $discipline->category == 'sangat berat' ? 'selected' : '' }}>Sangat Berat
                                    </option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="point" class="required form-label">Point</label>
                                <input type="number" class="form-control " name="point" id="point"
                                    placeholder="Point" value="{{ $discipline->point }}" required />
                            </div>
                            <div class="mb-5">
                                <label for="description" class=" form-label">Deskripsi</label>
                                <textarea class="form-control " name="description" id="description" rows="5" placeholder="Deskripsi">{{ $discipline->description }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" tabindex="-1" id="delete_discipline{{ $discipline->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Hapus Berit</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <form action="{{ route('back.discipline.student.destroy', $discipline->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus Rule <strong>{{ $discipline->discipline }}</strong>?
                                </p>
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
    <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/discipline.js') }}"></script>
@endsection
