<?php

namespace App\Exports;

use App\Models\PpdbPath;
use App\Models\PpdbRegistrationUser;
use App\Models\PpdbUser as ModelsPpdbUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PpdbUser implements FromCollection, WithHeadings, WithStyles, WithEvents, WithCustomStartCell
{

    public function collection()
    {
        return ModelsPpdbUser::with(['rapor', 'certificate'])
            ->get()
            ->map(function ($item) {
                $semesters = ['semester1', 'semester2', 'semester3', 'semester4', 'semester5'];
                $data = [
                    $item->nisn,
                    $item->name,
                    $item->birth_place,
                    $item->birth_date,
                    $item->school_origin,
                    $item->npsn,
                    $item->whatsapp_number,
                    $item->address,
                    $item->email,
                    $item->no_kk,
                    $item->nik,
                    $item->mother_nik,
                    $item->mother_name,
                    $item->mother_phone_number,
                    $item->father_nik,
                    $item->father_name,
                    $item->father_phone_number,
                    '=HYPERLINK("' . url('storage/' . $item->screenshoot_nisn) . '", "Lihat Disini")',
                    $item->rapor->rapor_type ?? "-"
                ];

                foreach ($semesters as $semester) {
                    $nilai_ipa = null;
                    $nilai_ips = null;
                    $nilai_indo = null;
                    $nilai_inggris = null;
                    $nilai_mtk = null;
                    $nilai_agama = null;
                    $nilai_qurdis = null;
                    $nilai_akidah = null;
                    $nilai_fiqih = null;
                    $nilai_ski = null;

                    if (!empty($item->rapor->{$semester . '_nilai'})) {
                        $nilai_ipa = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Ilmu Pengetahuan Alam (IPA)')['nilai'] ?? null;
                        $nilai_ips = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Ilmu Pengetahuan Sosial (IPS)')['nilai'] ?? null;
                        $nilai_indo = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Bahasa Indonesia')['nilai'] ?? null;
                        $nilai_inggris = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Bahasa Inggris')['nilai'] ?? null;
                        $nilai_mtk = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Matematika')['nilai'] ?? null;
                        $nilai_agama = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Pendidikan Agama Islam')['nilai'] ?? null;
                        $nilai_qurdis = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', "Al-qur'an Hadits")['nilai'] ?? null;
                        $nilai_akidah = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Akidah Akhlak')['nilai'] ?? null;
                        $nilai_fiqih = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Fiqih')['nilai'] ?? null;
                        $nilai_ski = collect($item->rapor->{$semester . '_nilai'})->firstWhere('mapel', 'Sejarah Kebudayaan Islam (SKI)')['nilai'] ?? null;
                    }

                    $data = array_merge($data, [
                        $nilai_ipa,
                        $nilai_ips,
                        $nilai_indo,
                        $nilai_inggris,
                        $nilai_mtk,
                        $nilai_agama,
                        $nilai_qurdis,
                        $nilai_akidah,
                        $nilai_fiqih,
                        $nilai_ski,
                        $item->rapor != null && $item->rapor->{$semester . '_file'} != null ?
                            '=HYPERLINK("' . url('storage/' . $item->rapor->{$semester . '_file'}) . '", "Lihat Disini")'
                            : '-', // Jika file tidak ada, isi dengan tanda strip (-)
                    ]);
                }

                $data[] = $item->certificate->map(function ($certificate) {
                    $fileUrl = url('storage/' . ($certificate->path ?? ''));
                    return  $certificate->name . ' - ' . $certificate->rank . ' ( file : ' . $fileUrl . ' )';
                })->implode(', ');


                return $data;
            });
    }

    public function headings(): array
    {
        $headings = [
            'NISN',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Asal Sekolah',
            'NPSN Sekolah Asal',
            'Nomor WhatsApp',
            'Alamat',
            'Email',
            'Nomor KK',
            'NIK',
            'NIK Ibu',
            'Nama Ibu',
            'Nomor HP Ibu',
            'NIK Ayah',
            'Nama Ayah',
            'Nomor HP Ayah',
            'Screenshoot NISN',
            'Jenis Rapor',
        ];

        for ($i = 1; $i <= 5; $i++) {
            $headings = array_merge($headings, [
                "IPA",
                "IPS",
                "Bahasa Indonesia",
                "Bahasa Inggris",
                "Matematika",
                "Pendidikan Agama",
                "Qur'an Hadist",
                "Akidah Akhlak",
                "Fiqih",
                "SKI",
                "File",
            ]);
        }


        return $headings;
    }

    public function startCell(): string
    {
        return 'A6';  // Mulai di baris 4
    }

    public function styles(Worksheet $sheet)
    {
        return [
            4 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {


                $sheet = $event->sheet->getDelegate();

                // Menambahkan judul di baris 1
                $sheet->mergeCells('A1:BW1');
                $sheet->setCellValue('A1', 'Seluruh Data Pendaftar PPDB');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan tanggal di baris 2
                $sheet->mergeCells('A2:BW2');
                $sheet->setCellValue('A2', 'Import Tanggal: ' . date('d-m-Y H:i:s'));
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menambahkan heading di baris 4
                $sheet->mergeCells('A4:R5');
                $sheet->setCellValue('A4', 'Data Pribadi');
                $sheet->getStyle('A4')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A4:R5')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                $sheet->mergeCells('S4:BV4');
                $sheet->setCellValue('S4', 'Data Nilai Rapor');
                $sheet->getStyle('S4')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('S4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('S4:BV4')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                $sheet->getStyle('S5')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                ]);



                $sheet->mergeCells('T5:AD5');
                $sheet->setCellValue('T5', 'Semester 1');
                $sheet->getStyle('T5')->getFont()->setBold(true);
                $sheet->getStyle('T5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('T5:AD5')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                $sheet->mergeCells('AE5:AO5');
                $sheet->setCellValue('AE5', 'Semester 2');
                $sheet->getStyle('AE5')->getFont()->setBold(true);
                $sheet->getStyle('AE5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('AE5:AO5')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                $sheet->mergeCells('AP5:AZ5');
                $sheet->setCellValue('AP5', 'Semester 3');
                $sheet->getStyle('AP5')->getFont()->setBold(true);
                $sheet->getStyle('AP5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('AP5:AZ5')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                $sheet->mergeCells('BA5:BK5');
                $sheet->setCellValue('BA5', 'Semester 4');
                $sheet->getStyle('BA5')->getFont()->setBold(true);
                $sheet->getStyle('BA5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('BA5:BK5')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                $sheet->mergeCells('BL5:BV5');
                $sheet->setCellValue('BL5', 'Semester 5');
                $sheet->getStyle('BL5')->getFont()->setBold(true);
                $sheet->getStyle('BL5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('BL5:BV5')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Menambahkan heading di baris 4
                $sheet->mergeCells('BW4:BW6');
                $sheet->setCellValue('BW4', 'Data Sertifikat');
                $sheet->getStyle('BW4')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('BW4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('BW4:BW6')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Tambahkan warna latar belakang untuk heading di baris ke-4
                $sheet->getStyle('A6:BV6')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'],  // Warna kuning
                    ],
                ]);

                // Menambahkan border untuk heading
                $sheet->getStyle('A6:BV6')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                $sheet->getStyle('A6:BV6')->getFont()->setBold(true);

                // Menambahkan border untuk data (mulai dari baris 5 sampai baris terakhir)
                $rowCount = $sheet->getHighestRow();
                $sheet->getStyle('A7:BV' . $rowCount)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],  // Warna hitam
                        ],
                    ],
                ]);

                // Auto-fit kolom (menyesuaikan lebar kolom dengan konten)
                $columns = array_merge(range('A', 'Z'), array_map(function ($char) {
                    return 'A' . $char;
                }, range('A', 'Z')), array_map(function ($char) {
                    return 'B' . $char;
                }, range('A', 'W')));

                foreach ($columns as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Set the hyperlink text color to blue
                for ($row = 7; $row <= $rowCount; $row++) {
                    $sheet->getStyle('R' . $row)->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'],  // Warna biru
                        ],
                    ]);
                    $sheet->getStyle('AD' . $row)->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'],  // Warna biru
                        ],
                    ]);
                    $sheet->getStyle('AO' . $row)->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'],  // Warna biru
                        ],
                    ]);
                    $sheet->getStyle('AZ' . $row)->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'],  // Warna biru
                        ],
                    ]);
                    $sheet->getStyle('BK' . $row)->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'],  // Warna biru
                        ],
                    ]);
                    $sheet->getStyle('BV' . $row)->applyFromArray([
                        'font' => [
                            'color' => ['rgb' => '0000FF'],  // Warna biru
                        ],
                    ]);
                }
            }
        ];
    }
}
