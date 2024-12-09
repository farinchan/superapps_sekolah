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
                            <img src="{{ asset('img_ext/pelanggaran.png') }}" style="width: 100%" alt="" />
                        </div>
                        <div class="col-md-8">
                            <form id="kt_modal_create_discipline_rule_form" class="form"
                                action="{{ route('back.discipline.student.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="fv-row mb-4">
                                    <label class="required fw-bold fs-6 mb-2">Kelas</label>
                                    <select class="form-select form-select-solid form-select-lg fw-bold" data-placeholder="Pilih Kelas"
                                        data-control="select2" data-hide-search="false" name="class_id" id="class_id">
                                        @foreach ($list_classroom as $classroom)
                                            <option value="" selected disabled>Pilih Kelas</option>
                                            <option value="{{ $classroom->id }}">{{ $classroom->name }} -
                                                TA.{{ $classroom->schoolYear->start_year }}/{{ $classroom->schoolYear->end_year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="fv-row mb-4">
                                    <label class="required fw-bold fs-6 mb-2">Siswa</label>
                                    <select class="form-select form-select-solid form-select-lg fw-bold" data-placeholder="Pilih Siswa"
                                        data-control="select2" data-hide-search="false" name="student_id">
                                    </select>
                                </div>

                                <div class="fv-row mb-4">
                                    <label class="required fw-bold fs-6 mb-2">Pelanggaran</label>
                                    <select class="form-select form-select-solid form-select-lg fw-bold"
                                        data-control="select2" data-hide-search="false" name="discipline_rule_id">
                                        <option value="">Pilih Pelanggaran</option>
                                        @foreach ($list_discipline_rule as $rule)
                                            <option value="{{ $rule->id }}">{{ $rule->rule }} - {{ $rule->point }}
                                                Poin</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="fv-row mb-4">
                                    <label class="required fw-bold fs-6 mb-2">Tanggal</label>
                                    <input class="form-control form-control-solid form-control-lg fw-bold" type="datetime-local"
                                        name="date" />
                                </div>

                                <div class="fv-row mb-4">
                                    <label class="fw-bold fs-6 mb-2">Photo</label>
                                    <input class="form-control form-control-solid form-control-lg fw-bold" type="file" name="image" accept="image/*" />
                                    <small class="text-muted">Photo harus berformat jpg, jpeg, png, atau gif dengan ukuran maksimal 6MB</small>
                                </div>

                                <div class="fv-row mb-4">
                                    <label class="required fw-bold fs-6 mb-2">Keterangan</label>
                                    <textarea class="form-control form-control-solid form-control-lg fw-bold" name="description" rows="3"
                                        placeholder="Keterangan siswa yang melanggar"></textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-danger">
                                        <span class="indicator-label">Buat Pelanggaran</span>
                                    </button>
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
    <script>
            $('#class_id').change(function() {
                var class_id = $(this).val();
                $.ajax({
                    url: "{{ route('back.discipline.student.apiStudent') }}",
                    type: 'GET',
                    data: {
                        class_id: class_id
                    },
                    success: function(data) {
                        $('select[name="student_id"]').html('')
                        var html = '';
                        $.each(data, function(key, value) {
                            html += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        $('select[name="student_id"]').html(html);
                    }
                });
            });
    </script>
@endsection
