@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13" placeholder="Cari Anggota" />
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
                                        <label class="form-label fs-6 fw-semibold">Keanggotaan</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-user-table-filter="keanggotaan" data-hide-search="true">
                                            <option></option>
                                            <option value="Kader Muhammadiyah">Kader Muhammadiyah</option>
                                            <option value="Warga Muhammadiyah">Warga Muhammadiyah</option>
                                            <option value="Simpatisan Muhammadiyah">Simpatisan Muhammadiyah</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Pekerjaan</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-user-table-filter="pekerjaan">
                                            <option></option>
                                            <option value="Ustadz">Ustadz</option>
                                            <option value="Dosen">Dosen</option>
                                            <option value="Guru">Guru</option>
                                            <option value="Arsitek">Arsitek</option>
                                            <option value="Nelayan">Nelayan</option>
                                            <option value="Perawat">Perawat</option>
                                            <option value="Dokter">Dokter</option>
                                            <option value="Bidan">Bidan</option>
                                            <option value="Pemadam Kebakaran">Pemadam Kebakaran</option>
                                            <option value="Kondektur">Kondektur</option>
                                            <option value="Pilot">Pilot</option>
                                            <option value="Masinis">Masinis</option>
                                            <option value="Wartawan">Wartawan</option>
                                            <option value="Penulis">Penulis</option>
                                            <option value="Insinyur Mesin">Insinyur Mesin</option>
                                            <option value="Ahli Gizi">Ahli Gizi</option>
                                            <option value="Pustakawan">Pustakawan</option>
                                            <option value="Hakim">Hakim</option>
                                            <option value="Notaris">Notaris</option>
                                            <option value="Teller Bank">Teller Bank</option>
                                            <option value="Koki">Koki</option>
                                            <option value="Artis">Artis</option>
                                            <option value="Penerjemah">Penerjemah</option>
                                            <option value="Tentara">Tentara</option>
                                            <option value="Tukang Cukur">Tukang Cukur</option>
                                            <option value="Petani">Petani</option>
                                            <option value="Akuntan">Akuntan</option>
                                            <option value="Pengacara">Pengacara</option>
                                            <option value="Polisi">Polisi</option>
                                            <option value="Pegawai Negeri">Pegawai Negeri</option>
                                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Role</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-user-table-filter="role" data-hide-search="true">
                                            <option></option>
                                            <option value="admin">admin</option>
                                            <option value="user">user</option>
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

                            <a href="{{ route("back.user.create") }}" class="btn btn-primary">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Anggota</a>
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
                                <th class="min-w-125px">Anggota</th>
                                <th class="min-w-125px">Pekerjaan</th>
                                <th class="min-w-125px">Keanggotaan</th>
                                <th class="min-w-125px">Role</th>
                                <th class="min-w-125px">Waktu Bergabung</th>
                                <th class="min-w-125px">Status</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($users as $user)
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
                                                    <img src="@if ($user->photo) {{ Storage::url($user->photo) }} @else https://ui-avatars.com/api/?background=000C32&color=fff&name={{ $user->name }} @endif"
                                                        alt="{{ $user->name }}"
                                                        width="50px" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                            <span>{{ $user->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <ul>
                                                <li><span class="fw-bold">Pekerjaan:
                                                    </span>{{ implode(', ', json_decode($user->job) ?? []) }}</li>
                                                <li><span class="fw-bold">Kepakaran: </span>{{ $user->kepakaran }}</li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="text-dark fw-bolder text-hover-primary">{{ $user->keanggotaan }}</span>
                                    </td>
                                    <td>
                                        @foreach ($user->getRoleNames() as $role)
                                            @if ($role == 'user')
                                                <div class="badge badge-light-primary fw-bold">{{ $role }}</div>
                                            @elseif ($role == 'admin')
                                                <div class="badge badge-light-danger fw-bold">{{ $role }}</div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($user->status == 1)
                                            <span class="badge badge-light-success">Aktif</span>
                                        @else
                                            <span class="badge badge-light-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route("back.user.edit", $user->id) }}"  class="menu-link px-3">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_delete_user{{ $user->id }}">Delete</a>
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
    @foreach ($users as $user)
        <div class="modal fade" id="kt_modal_delete_user{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Hapus Anggota</h2>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body px-5">
                        <form class="form" method="POST" action="{{ route('back.user.destroy', $user->id) }}">
                            @method('DELETE')
                            @csrf
                            <h3 class="text-center">
                                Apakah Anda Yakin Ingin Menghapus Anggota {{ $user->name }} ?
                            </h3>
                            <div class="text-center pt-10">
                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                                    aria-label="Close">batal</button>
                                <button type="submit" class="btn btn-danger" data-kt-users-modal-action="submit">
                                    <span class="indicator-label">Hapus</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script src="{{ asset('back/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('back/js/custom/apps/user-management/users/list/add.js') }}"></script>
@endsection
