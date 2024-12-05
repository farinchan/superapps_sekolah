@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

                <div class="col-xl-12">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Log Login E-Learning</span>
                            </h3>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table id="log_login_elearning"
                                    class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 px-7">
                                            <th>Siswa</th>
                                            <th>Info</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($log_login_elearning as $login_elearning)
                                            <tr class="text-gray-800">
                                                <td class="d-flex align-items-center" style="min-height: 100px;">
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="#">
                                                            <div class="symbol-label">
                                                                <img src="{{ $login_elearning->user?->student?->getPhoto() }}"
                                                                    alt="{{ $login_elearning->user?->student?->name }}"
                                                                    width="50px" />
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a href="#"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $login_elearning->user?->student?->name }}</a>
                                                        <span> NISN.{{ $login_elearning->user?->student?->nisn }}</span>
                                                        <span> NIK.{{ $login_elearning->user?->student?->nik }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            IP Address : {{ $login_elearning->ip }}
                                                        </li>
                                                        <li>
                                                            User Agent : {{ $login_elearning->user_agent }}
                                                        </li>
                                                        <li>
                                                            Browser : {{ $login_elearning->browser }}
                                                        </li>
                                                        <li>
                                                            Platform : {{ $login_elearning->platform }}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($login_elearning->created_at)->diffForHumans() }}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @role('admin|kepsek')
                <div class="col-xl-12">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Log Login Sistem Terpadu</span>
                            </h3>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table id="log_login"
                                    class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 px-7">
                                            <th>User </th>
                                            <th>Type</th>
                                            <th>Info</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($log_login as $login)
                                            <tr class="text-gray-800">
                                                @if ($login->user?->student)
                                                    <td class="d-flex align-items-center" style="min-height: 100px;">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="#">
                                                                <div class="symbol-label">
                                                                    <img src="{{ $login->user?->student?->getPhoto() }}"
                                                                        alt="{{ $login->user?->student?->name }}"
                                                                        width="50px" />
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="#"
                                                                class="text-gray-800 text-hover-primary mb-1">{{ $login->user?->student?->name }}</a>
                                                            <span> NISN.{{ $login->user?->student?->nisn }}</span>
                                                            <span> NIK.{{ $login->user?->student?->nik }}</span>
                                                        </div>
                                                    </td>
                                                @elseif ($login->user?->teacher)
                                                    <td class="d-flex align-items-center" style="min-height: 100px;">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="#">
                                                                <div class="symbol-label">
                                                                    <img src="{{ $login->user?->teacher?->getPhoto() }}"
                                                                        alt="{{ $login->user?->teacher?->name }}"
                                                                        width="50px" />
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="#"
                                                                class="text-gray-800 text-hover-primary mb-1">{{ $login->user?->teacher?->name }}</a>
                                                            <span> NIP.{{ $login->user?->teacher?->nip }}</span>
                                                            <span> NIK.{{ $login->user?->teacher?->nik }}</span>
                                                        </div>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if ($login->user?->student)
                                                        Siswa
                                                    @elseif ($login->user?->teacher)
                                                        Tenaga Pendidik/Kependidikan
                                                    @elseif ($login->user?->parent)
                                                        Orang Tua
                                                    @endif
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            IP Address : {{ $login->ip }}
                                                        </li>
                                                        <li>
                                                            User Agent : {{ $login->user_agent }}
                                                        </li>
                                                        <li>
                                                            Browser : {{ $login->browser }}
                                                        </li>
                                                        <li>
                                                            Platform : {{ $login->platform }}
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($login->created_at)->diffForHumans() }}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Log Perubahan</span>
                            </h3>
                        </div>
                        <div class="card-body ">

                        </div>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#log_login_elearning").DataTable({
            "responsive": true,
            "order": [],
        });
        $("#log_login").DataTable({
            "responsive": true,
            "order": [],
        });
    </script>
@endsection
