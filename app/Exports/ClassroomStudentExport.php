<?php

namespace App\Exports;

use App\Models\Classroom;
use App\Models\ClassroomStudent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class ClassroomStudentExport implements FromCollection, WithHeadings, WithStyles, WithEvents, WithCustomStartCell
{

    protected $classroom;

    // Constructor untuk menerima parameter classroom
    public function __construct($classroom = null)
    {
        $this->classroom = $classroom;
    }

    public function collection()
    {
        return ClassroomStudent::where('classroom_id', $this->classroom)
            ->join('student', 'classroom_student.student_id', '=', 'student.id')
            ->select('student.name', 'student.nisn', 'student.nik', 'student.birth_place', 'student.birth_date', 'student.gender', 'student.address', 'student.no_telp', 'student.email', 'student.kebutuhan_khusus', 'student.disabilitas', 'student.father_name', 'student.mother_name',)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NISN',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Nomor Telepon',
            'Email',
            'Kebutuhan Khusus',
            'Disabilitas',
            'Nama Ayah',
            'Nama Ibu',
        ];
    }

    public function startCell(): string
    {
        return 'A8';  // Mulai di baris 4
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
                $classroom = Classroom::find($this->classroom);

                // Menambahkan judul di baris 1
                $sheet->mergeCells('A1:M1');
                $sheet->setCellValue('A1', 'Data Kelas ' . $classroom->name);
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan tanggal di baris 2
                $sheet->mergeCells('A2:M2');
                $sheet->setCellValue('A2', 'Import Tanggal: ' . date('d-m-Y H:i:s'));
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan preferensi kelas
                $sheet->mergeCells('A4:M4');
                $sheet->setCellValue('A4', 'Kelas: ' . $classroom->name);
                $sheet->getStyle('A4')->getFont()->setBold(true);

                $sheet->mergeCells('A5:M5');
                $sheet->setCellValue('A5', 'Tahun Ajaran: ' . $classroom->schoolYear->start_year . '/' . $classroom->schoolYear->end_year);
                $sheet->getStyle('A5')->getFont()->setBold(true);

                $sheet->mergeCells('A6:M6');
                $sheet->setCellValue('A6', 'Wali Kelas: ' . $classroom->teacher->name);
                $sheet->getStyle('A6')->getFont()->setBold(true);


                // Tambahkan warna latar belakang untuk heading di baris ke-4
                $sheet->getStyle('A8:M8')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                ]);

                // Menambahkan border untuk heading
                $sheet->getStyle('A8:M8')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Menambahkan border untuk data (mulai dari baris 5 sampai baris terakhir)
                $rowCount = $sheet->getHighestRow();
                $sheet->getStyle('A9:M' . $rowCount)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Auto-fit kolom (menyesuaikan lebar kolom dengan konten)
                foreach (range('A', 'M') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            }
        ];
    }
}
