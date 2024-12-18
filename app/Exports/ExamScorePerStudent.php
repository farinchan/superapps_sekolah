<?php

namespace App\Exports;

use App\Models\Classroom;
use App\Models\ExamClassroom;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExamScorePerStudent implements FromCollection, WithHeadings, WithStyles, WithEvents, WithCustomStartCell
{
    protected $student_id;
    protected $exam_id;
    protected $classroom_id;

    public function __construct($id, $classroom_id, $search)
    {
        $this->student_id = $id;
        $this->classroom_id = $classroom_id;
        $this->exam_id = $search;
    }

    public function collection()
    {
        return ExamClassroom::whereIn('exam_classroom.exam_id', $this->exam_id)->where('classroom_id', $this->classroom_id)
        ->leftJoin('exam_session', 'exam_session.exam_id', '=', 'exam_classroom.exam_id')
        ->leftJoin('exam', 'exam.id', '=', 'exam_classroom.exam_id')
        ->leftJoin('subject', 'subject.id', '=', 'exam.subject_id')
        ->where('exam_session.student_id', $this->student_id)
        ->select(
            'exam.type as exam_type',
            'exam.semester',
            'subject.name as subject_name',
            'exam_session.score'
        )
        ->get();
    }

    public function headings(): array
    {
        return [
            'Ujian Info',
            'Semester',
            'Mata Pelajaran',
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
                $student = Student::find($this->student_id);

                // Menambahkan judul di baris 1
                $sheet->mergeCells('A1:D1');
                $sheet->setCellValue('A1', 'Nilai Ujian');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan tanggal di baris 2
                $sheet->mergeCells('A2:D2');
                $sheet->setCellValue('A2', 'Import Tanggal: ' . date('d-m-Y H:i:s'));
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan preferensi kelas
                $sheet->mergeCells('A4:D4');
                $sheet->setCellValue('A4', 'Nama: ' . $student?->name);
                $sheet->getStyle('A4')->getFont()->setBold(true);

                $sheet->mergeCells('A5:D5');
                $sheet->setCellValue('A5', 'NISN: ' . $student?->nisn);
                $sheet->getStyle('A5')->getFont()->setBold(true);

                $classroom = Classroom::find($this->classroom_id)->with('schoolYear')->first();

                $sheet->mergeCells('A6:D6');
                $sheet->setCellValue('A6', 'Kelas: ' . $classroom->name);
                $sheet->getStyle('A6')->getFont()->setBold(true);

                $sheet->mergeCells('A7:D7');
                $sheet->setCellValue('A7', 'Tahun Ajaran: ' . $classroom->schoolYear->start_year . '/' . $classroom->schoolYear->end_year);
                $sheet->getStyle('A7')->getFont()->setBold(true);

                $sheet->mergeCells('A8:D8');
                $sheet->setCellValue('A8', 'Wali Kelas: ' . $classroom->teacher->name);
                $sheet->getStyle('A8')->getFont()->setBold(true);



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
