<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Daftung; // Pastikan untuk mengimpor model Daftung
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class laporanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null) // Menambahkan parameter untuk tanggal
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        // Mengambil data sesuai dengan rentang tanggal jika diberikan
        if ($this->startDate && $this->endDate) {
            return Daftung::whereBetween('Tgl_permohonan', [$this->startDate, $this->endDate])->get();
        }
    
        return Daftung::all(); // Ambil semua data jika tidak ada filter
    }
    

    // Menentukan header kolom di Excel
    public function headings(): array
    {
        return [
            ['Data Daftar Tunggu Pelanggan'],
            ['ULP SUBANG'],
            ['', ''], // Menggunakan dua baris kosong agar ada jarak sebelum heading
            ['No', 'Nama Pelanggan', 'Idpel', 'Transaksi', 'Status', 'Nama Admin', 'Jam Penginputan']
        ];
    }

    // Mapping data untuk kolom-kolom yang akan diekspor
    public function map($daftung): array
    {
        return [
            $this->collection()->search($daftung) + 1, // Menambahkan 1 agar mulai dari 1
            $daftung->Nama_Pelanggan,
            "- " . $daftung->idpel, // Mengatur IDPEL sebagai teks
            $daftung->Transaksi,
            $daftung->Status,
            $daftung->Nama_Admin,
            $daftung->input_time ? Carbon::parse($daftung->input_time)->format('H:i:s') : 'Belum Diinput'
        ];
    }

    // Menambahkan styling ke sheet
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:A2')->getFont()->setBold(true)->setSize(14);
        $sheet->mergeCells('A1:G1'); // Menggabungkan sel untuk judul
        $sheet->mergeCells('A2:G2'); // Menggabungkan sel untuk subjudul
        return [
            // Style untuk heading
            'A4:G4' => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
            ],
        ];
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo_PLN');
    //     $drawing->setDescription('PLN ');
    //     $drawing->setPath(public_path(''));
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('A3');

    //     return $drawing;
    // }

    // Menentukan judul untuk worksheet
    public function title(): string
    {
        return 'Daftar Tunggu'; // Nama sheet
    }
}
