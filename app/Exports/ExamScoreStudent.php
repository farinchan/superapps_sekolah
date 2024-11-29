<?php

namespace App\Exports;

use App\Models\Classroom;
use App\Models\ClassroomStudent;
use App\Models\Exam;
use App\Models\ExamClassroom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class ExamScoreStudent implements FromCollection, WithHeadings, WithStyles, WithEvents, WithCustomStartCell
{
    protected $id;
    protected $search;
    protected $classroom_id;

    public function __construct($id, $classroom_id = null, $search = null)
    {
        $this->id = $id;
        $this->classroom_id = $classroom_id;
        $this->search = $search;
    }

    public function collection()
    {

        return ExamClassroom::where('exam_classroom.exam_id', $this->id)
            ->when($this->classroom_id, function ($query) {
                $query->where('exam_classroom.classroom_id', $this->classroom_id);
            })
            ->leftJoin('classroom', 'classroom.id', '=', 'exam_classroom.classroom_id')
            ->leftJoin('classroom_student', function ($join) {
                $join->on('classroom_student.classroom_id', '=', 'exam_classroom.classroom_id');
            })
            ->leftJoin('student', function ($join) {
                $join->on('student.id', '=', 'classroom_student.student_id');
            })
            ->when($this->search, function ($query) {
                $query->where('student.name', 'like', '%' . $this->search . '%')->orWhere('student.nisn', 'like', '%' . $this->search . '%');
            })
            ->leftJoin('exam_session', function ($join) {
                $join->on('exam_session.student_id', '=', 'student.id')
                    ->where('exam_session.exam_id', $this->id);
            })
            ->select('student.nisn', 'student.name', 'classroom.name as classroom_name','exam_session.score')
            ->get();

        // return ClassroomStudent::join('student', 'student.id', '=', 'classroom_student.student_id')
        //     ->when($this->classroom_id, function ($query) {
        //         $query->where('classroom_id', $this->classroom_id);
        //     })

        //     ->when(function ($query) {
        //         $query->where('student.name', 'like', '%' . $this->search . '%');
        //     })
        //     ->wherehas('classroom.examClassroom', function ($query) {
        //         $query->where('exam_id', $this->id);
        //     })

        //     ->leftJoin('exam_session', function ($join) {
        //         $join->on('exam_session.student_id', '=', 'student.id')
        //             ->where('exam_session.exam_id', $this->id);
        //     })->leftJoin('classroom', 'classroom.id', '=', 'classroom_student.classroom_id')
        //     ->leftJoin('school_year', 'school_year.id', '=', 'classroom.school_year_id')
        //     ->select('student.nisn', 'student.name', 'classroom.name as classroom_name','exam_session.score')
        //     ->get();
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
            'Kelas',
            'Nilai Ujian'
        ];
    }

    public function startCell(): string
    {
        return 'A12';
    }

    public function styles($sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();



                // Mengambil data classroom
                $Exam = Exam::find($this->id);

                $type = "";

                if ($Exam->type == 'UAS') {
                    $type = ' Sumatif Akhir Semester ';
                } else if ($Exam->type == 'UTS') {
                    $type = ' Sumatif Tengah Semester ';
                }

                // Menambahkan judul di baris 1
                $sheet->mergeCells('A1:D1');
                $sheet->setCellValue('A1', 'Nilai' . $type . $Exam->subject?->name);
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan tanggal di baris 2
                $sheet->mergeCells('A2:D2');
                $sheet->setCellValue('A2', 'Import Tanggal: ' . date('d-m-Y H:i:s'));
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan preferensi kelas
                $sheet->mergeCells('A4:D4');
                $sheet->setCellValue('A4', 'Mata Ujian: ' . $Exam->subject?->name);
                $sheet->getStyle('A4')->getFont()->setBold(true);

                $sheet->mergeCells('A5:D5');
                $sheet->setCellValue('A5', 'Guru Pengampu: ' . $Exam->teacher?->name);
                $sheet->getStyle('A5')->getFont()->setBold(true);

                $kelas = '';
                if ($this->classroom_id) {
                    $kelas = Classroom::find($this->classroom_id)->name;
                } else {
                    foreach ($Exam->examClassroom as $item) {
                        $kelas .= $item->classroom->name . ', ';
                    }
                }

                $sheet->mergeCells('A6:D6');
                $sheet->setCellValue('A6', 'Kelas: ' . $kelas);
                $sheet->getStyle('A6')->getFont()->setBold(true);

                $sheet->mergeCells('A7:D7');
                $sheet->setCellValue('A7', 'Tahun Ajaran: ' . $Exam->schoolYear->start_year . '/' . $Exam->schoolYear->end_year);
                $sheet->getStyle('A7')->getFont()->setBold(true);

                $sheet->mergeCells('A8:D8');
                $sheet->setCellValue('A8', 'Waktu: ' . $Exam->start_time . ' s/d ' . $Exam->end_time);
                $sheet->getStyle('A8')->getFont()->setBold(true);

                $sheet->mergeCells('A9:D9');
                $sheet->setCellValue('A9', 'Durasi: ' . $Exam->duration . ' Menit');
                $sheet->getStyle('A9')->getFont()->setBold(true);

                $sheet->mergeCells('A10:D10');
                $sheet->setCellValue('A10', 'Jumlah Soal: ' . $Exam->examQuestion->count());
                $sheet->getStyle('A10')->getFont()->setBold(true);




                // Tambahkan warna latar belakang untuk heading di baris ke-4
                $sheet->getStyle('A12:D12')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                // Menambahkan border untuk heading
                $sheet->getStyle('A12:D12')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Menambahkan border untuk data (mulai dari baris 5 sampai baris terakhir)
                $rowCount = $sheet->getHighestRow();
                $sheet->getStyle('A13:D' . $rowCount + 1)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Auto-fit kolom (menyesuaikan lebar kolom dengan konten)
                foreach (range('A', 'D') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                foreach (range(12, $rowCount) as $row) {
                    $cellValue = $sheet->getCell('D' . $row)->getValue();
                    if (is_null($cellValue) || $cellValue === '') {
                        $sheet->getStyle('D' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'color' => ['rgb' => 'FFCCCC'],  // Warna merah
                            ],
                        ]);
                    }
                }

                // Menambahkan footer di bawah tabel
                $footerRow = $rowCount + 1;
                $sheet->mergeCells('A' . $footerRow . ':C' . $footerRow);
                $sheet->setCellValue('A' . $footerRow, 'Rata-Rata Nilai Ujian');
                $sheet->getStyle('A' . $footerRow)->getFont()->setBold(true);
                $sheet->getStyle('A' . $footerRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue('D' . $footerRow, '=AVERAGE(D11:D' . $rowCount . ')');
            }
        ];
    }
}
