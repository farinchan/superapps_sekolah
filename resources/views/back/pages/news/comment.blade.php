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
                            <input type="text" data-kt-ecommerce-order-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Search Komentar" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="input-group w-250px">
                            <input class="form-control form-control-solid rounded rounded-end-0"
                                placeholder="Tanggal Komentar" id="kt_ecommerce_sales_flatpickr" />
                            <button class="btn btn-icon btn-light" id="kt_ecommerce_sales_flatpickr_clear">
                                <i class="ki-duotone ki-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </div>
                        <div class="w-100 mw-150px">
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                                <option></option>
                                <option value="all">All</option>
                                <option value="Approved">Approved</option>
                                <option value="Spam">Spam</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_sales_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="">ID</th>
                                <th class="min-w-175px">Pengguna</th>
                                <th class="min-w-100px">Komentar</th>
                                <th class="text-end min-w-70px">Berita</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="#" class="text-gray-800 text-hover-primary fw-bold">{{ $comment->id }}</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                @if ($comment->user_id)
                                                    <a href="#">
                                                        <div class="symbol-label">
                                                            <img src="@if ($comment->user->photo) {{ Storage::url($comment->user->photo) }} @else https://ui-avatars.com/api/?background=000C32&color=fff&name={{ $comment->user->name }} @endif"
                                                                alt="{{ $comment->user->name }}" width="50px" />
                                                        </div>
                                                    </a>
                                                @else
                                                    <a href="#">
                                                        <div class="symbol-label fs-3 bg-light-danger text-danger">E</div>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="ms-5">
                                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1"
                                                    data-kt-ecommerce-category-filter="category_name">{{ $comment->name }}
                                                    @if ($comment->user_id == null)
                                                        <span class="badge badge-light-info">Guest</span>
                                                    @else
                                                        <span class="badge badge-light-success">Anggota</span>
                                                    @endif
                                                </a>
                                                <div class="text-muted fs-7 fw-bold">
                                                    {{ $comment->email }}
                                                </div>
                                            </div>
                                    </td>
                                    <td class="">
                                        <span class="fw-bold">{{ $comment->comment }}</span>
                                    </td>

                                    <td class="text-end" >
                                        <a href="#" class="text-gray-600 fw-bold text-hover-primary">{{ $comment->news->title }}</a>
                                        <br>
                                        <span class="text-muted fw-bold">{{ $comment->parent_id ? 'Reply ID: ' . $comment->parent_id : 'Comment' }}</span>
                                    </td>
                                    <td class="text-end" >
                                        @if ($comment->status == 'approved')
                                            <div class="badge badge-light-primary">Approved</div>
                                        @else
                                            <div class="badge badge-light-danger">Spam</div>
                                        @endif
                                        <br>
                                        <span class="text-muted fw-bold">{{ $comment->news->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="text-end">
                                        <form style="display: inline-block;"
                                            action="{{ route('back.news.comment.spam', $comment->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-icon btn-light-youtube me-2" title="Jadikan Spam">
                                                <i class="fas fa-trash-alt fs-4"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('back/js/custom/apps/ecommerce/sales/listing.js') }}"></script>
@endsection
