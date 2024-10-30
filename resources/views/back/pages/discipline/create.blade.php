@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">

                <div class="card-header mt-6">
                    <h2 class="mb-5">
                        Catat Pelanggaran Siswa
                    </h2>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-4">
                            <i class="ki-duotone ki-notepad-edit" style="font-size: 500px;">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="col-md-8">
                            <form id="kt_modal_create_discipline_rule_form" class="form"
                                action="{{ route('back.discipline.student.store') }}" method="POST">
                                @csrf
                                <div class="fv-row mb-4">
                                    <label class="required fw-bold fs-6 mb-2">Discipline Rule Name</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter Discipline Rule Name" name="name" />
                                </div>

                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('back/js/custom/apps/ecommerce/catalog/discipline_rule.js') }}"></script>
@endsection
