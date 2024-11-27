@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('back.pages.exam.detail-header')
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    @role('admin|proktor')
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                Tambah Kelas
                            </a>
                        </div>
                    @endrole
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table"">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_products_table" value="1" />
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
                            @foreach ($list_exam_classroom as $item)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="@role('admin'){{ route('back.classroom.detail', $item->classroom?->id) }}@else#@endrole"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                                {{ $item->classroom?->name }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->classroom?->schoolYear->start_year }}/{{ $item->classroom?->schoolYear->end_year }}
                                    </td>
                                    <td>
                                        {{ $item->classroom?->teacher->name }}
                                    </td>
                                    <td>
                                        {{ $item->classroom?->classroomStudent?->count() ?? '0' }} Siswa
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $item->id }}">
                                            <i class="ki-duotone ki-cross fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Modals-->
    <div class="modal fade" tabindex="-1" id="add">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambahkan Kelas</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.exam.classroom.store', $exam->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <select class="form-select form-select-solid form-select-lg" data-control="select2"
                            data-placeholder="Select an option" multiple="multiple" name="classroom_id[]">
                            <option></option>
                            @foreach ($list_classroom as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->name }} -
                                    {{ $classroom->schoolYear->start_year }}/{{ $classroom->schoolYear->end_year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($list_exam_classroom as $item)
        <div class="modal fade" tabindex="-1" id="delete{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Hapus Kelas</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.exam.classroom.destroy', [$exam->id, $item->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin menghapus Kelas <strong> {{ $item->classroom?->name }} -
                                        {{ $item->classroom?->schoolYear->start_year }}/{{ $item->classroom?->schoolYear->end_year }}
                                    </strong>? dari Ujian ini</p>
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
@endsection
