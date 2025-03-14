<?php

namespace App\Exports;

use App\Models\PpdbExam;
use App\Models\PpdbExamScheduleUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PpdbExamScoreStudent implements FromCollection, WithHeadings, WithStyles, WithEvents, WithCustomStartCell
{
    protected $id;
    protected $search;

    public function __construct($id, $classroom_id = null, $search = null)
    {
        $this->id = $id;
        $this->search = $search;
    }

    public function collection()
    {

        return PpdbExamScheduleUser::leftJoin('ppdb_exam_schedule', 'ppdb_exam_schedule.id', '=', 'ppdb_exam_schedule_user.ppdb_exam_schedule_id')
        ->leftJoin('ppdb_exam', 'ppdb_exam.id', '=', 'ppdb_exam_schedule.ppdb_exam_id')
        ->where('ppdb_exam.id', $this->id)
        ->leftJoin('ppdb_user', 'ppdb_user.id', '=', 'ppdb_exam_schedule_user.ppdb_user_id')
        ->leftJoin('ppdb_exam_session', 'ppdb_exam_session.ppdb_user_id', '=', 'ppdb_exam_schedule_user.ppdb_user_id')
        ->where('ppdb_user.name', 'like', '%' . $this->search . '%')
        ->select( 'ppdb_user.nisn','ppdb_user.name', 'ppdb_exam_session.score')
        ->get();
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
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
                $Exam = PpdbExam::find($this->id);

                // Menambahkan judul di baris 1
                $sheet->mergeCells('A1:C1');
                $sheet->setCellValue('A1', 'Nilai ' . $Exam->name);
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan tanggal di baris 2
                $sheet->mergeCells('A2:D2');
                $sheet->setCellValue('A2', 'Import Tanggal: ' . date('d-m-Y H:i:s'));
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan preferensi kelas
                $sheet->mergeCells('A4:C4');
                $sheet->setCellValue('A4', 'Ujian PPDB: ' . ($Exam->name ?? 'Tidak Diketahui'));
                $sheet->getStyle('A4')->getFont()->setBold(true);

                $sheet->mergeCells('A5:C5');
                $sheet->setCellValue('A5', 'Durasi: ' . ($Exam->duration ?? 'Tidak Diketahui') . ' Menit');
                $sheet->getStyle('A5')->getFont()->setBold(true);

                $sheet->mergeCells('A6:C6');
                $sheet->setCellValue('A6', 'Tahun Ajaran: ' . ($Exam->schoolYear->start_year ?? 'Tidak Diketahui') . '/' . ($Exam->schoolYear->end_year ?? 'Tidak Diketahui'));
                $sheet->getStyle('A6')->getFont()->setBold(true);

                $sheet->mergeCells('A7:C7');
                $sheet->setCellValue('A7', 'Jumlah Soal: ' . ($Exam->examQuestion->count() ?? 'Tidak Diketahui'));
                $sheet->getStyle('A7')->getFont()->setBold(true);



                // Tambahkan warna latar belakang untuk heading di baris ke-4
                $sheet->getStyle('A12:C12')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                // Menambahkan border untuk heading
                $sheet->getStyle('A12:C12')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Menambahkan border untuk data (mulai dari baris 5 sampai baris terakhir)
                $rowCount = $sheet->getHighestRow();
                $sheet->getStyle('A13:C' . $rowCount + 1)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Auto-fit kolom (menyesuaikan lebar kolom dengan konten)
                foreach (range('A', 'C') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                foreach (range(12, $rowCount) as $row) {
                    $cellValue = $sheet->getCell('C' . $row)->getValue();
                    if (is_null($cellValue) || $cellValue === '') {
                        $sheet->getStyle('C' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'color' => ['rgb' => 'FFCCCC'],  // Warna merah
                            ],
                        ]);
                    }
                }

                // Menambahkan footer di bawah tabel
                $footerRow = $rowCount + 1;
                $sheet->mergeCells('A' . $footerRow . ':B' . $footerRow);
                $sheet->setCellValue('A' . $footerRow, 'Rata-Rata Nilai Ujian');
                $sheet->getStyle('A' . $footerRow)->getFont()->setBold(true);
                $sheet->getStyle('A' . $footerRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue('C' . $footerRow, '=AVERAGE(C11:C' . $rowCount . ')');
            }
        ];
    }
}
