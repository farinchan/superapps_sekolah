<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Penerimaan Peserta Didik Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .card {
            height: 217mm;
            border: 1px solid #000;
            padding: 15px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header img {
            height: 70px;
            margin-bottom: 5px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
        }
        .header h3 {
            font-size: 16px;
            margin: 5px 0 0 0;
        }
        .content {
            display: flex;
            border: 1px solid #000;
            padding: 10px;
        }
        .photo {
            width: 40mm;
            height: 55mm;
            border: 1px solid #000;
            margin-right: 15px;
            text-align: center;
            line-height: 55mm;
            font-size: 14px;
            color: #555;
        }
        .info table {
            margin: 5px 0;
            font-size: 14px;

        }
        .info table td, .info table * {
            vertical-align: top;
        }
        .info p strong {
            display: inline-block;
            width: 150px;
        }

        .table {
            margin-top: 15px;
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        .table th {
            text-align: center;
        }
        .declaration {
            margin-top: 15px;
            font-size: 14px;
        }
        .declaration p {
            margin: 5px 0;
        }
        .signature {
            margin-top: 20px;
            text-align: right;
        }
        .signature p {
            margin-right: 48px;
        }
        .signature .line {
            border-top: 1px solid #000;
            width: 200px;
            margin-left: auto;
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
@php
    $setting_website = \App\Models\SettingWebsite::first();
@endphp

<body>
    <div class="card">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('storage/' . $setting_website->logo) }}" alt="Logo Sekolah">
            <h1>PENERIMAAN PESERTA DIDIK BARU</h1>
            <h3>MAN 1 PADANG PANJANG</h3>
        </div>
        {{-- <table>
            <tr>
                <td>
                    <img src="{{ public_path('storage/' . $setting_website->logo) }}" alt="Logo Sekolah" style="height: 70px;">
                </td>
                <td style="padding-left: 15px; text-align: center;">
                    <h1 style="font-size: 18px; margin: 0;">PENERIMAAN PESERTA DIDIK BARU</h1>
                    <h3 style="font-size: 16px; margin: 5px 0 0 0;">MAN 1 PADANG PANJANG</h3>
                </td>
            </tr>
        </table> --}}

        <!-- Content -->
        <div class="content">
            <!-- Photo Section -->
            <table>
                <tr>
                    <td class="photo">PASS FOTO</td>
                    <td  class="info" style="padding-left: 15px;">
                        <table >
                            <tr>
                                <td style="width: 120px;"
                                ><strong>No Pendaftaran</strong></td>
                                <td>:</td>
                                <td>4190000001</td>
                            </tr>
                            <tr>
                                <td><strong>NISN</strong></td>
                                 <td>:</td>
                                <td>{{ $path_card->user->nisn }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Siswa</strong></td>
                                 <td>:</td>
                                <td>{{ $path_card->user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>TTL</strong></td>
                                 <td>:</td>
                                <td>{{ $path_card->user->birth_place }}, {{ $path_card->user->birth_date }}</td>
                            </tr>
                            <tr>
                                <td><strong>Asal Sekolah</strong></td>
                                 <td>:</td>
                                <td>{{ $path_card->user->school_origin }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                 <td>:</td>
                                <td>{{ $path_card->user->address }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </div>

        <!-- Pilihan -->
        <table class="table">
            <thead>
                <tr>
                    <th>Pilihan Jalur Pendaftaran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <br>
                        <strong>{{ $path_card->path->name }} - T.A {{ $path_card->path->schoolYear->start_year }}/{{ $path_card->path->schoolYear->end_year }}</strong><br>
                        {{ $path_card->path->description }}
                        <br>
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Declaration -->
        <div class="declaration">
            <p>
                Dengan ini saya menyatakan bahwa data yang tertera di atas adalah benar dan sesuai dengan dokumen asli. Saya bersedia mengikuti segala ketentuan dan peraturan yang berlaku dalam proses Penerimaan Peserta Didik Baru (PPDB) di MAN 1 Padang Panjang.
            </p>
        </div>

        <!-- Signature -->
        <div class="signature">
            <p>Tanda Tangan:</p>
            <div class="line">{{ $path_card->user->name }}</div>
        </div>
    </div>
</body>
</html>
