<!--begin::Progress-->
{{-- <div class="d-flex align-items-center flex-column w-100 mb-8 mb-lg-10">
    <div class="d-flex justify-content-between fw-bolder fs-6 text-gray-800  w-100 mt-auto mb-3">
        <span>Waktu Pengerjaan</span>
    </div>
    <div class="fw-semibold fs-4 text-danger w-100 mt-auto">
        <span id="timer"> </span>
    </div>
</div> --}}
<div class="d-flex align-items-center flex-column w-100 mb-8 mb-lg-10">
    <div class="d-flex justify-content-between fw-bolder fs-6 text-gray-800  w-100 mt-auto mb-3">
        <span>Your Goal</span>
    </div>
    <div class="w-100 bg-light-info rounded mb-2" style="height: 24px">
        <div class="bg-info rounded" role="progressbar" style="height: 24px; width: {{ $exam_question_percentage }}%;"
            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="fw-semibold fs-7 text-primary w-100 mt-auto">
        <span>Kamu telah menjawab {{ round($exam_question_percentage, 1) }}% soal</span>
    </div>
</div>
<!--end::Progress-->
