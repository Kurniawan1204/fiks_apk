<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\laporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon; 
use App\Models\Daftung;

class TransaksiController extends Controller
{

//     Mengambil semua data dari tabel daftung dengan status yang tidak sama dengan 'Validasi'.
//     Menggunakan pagination untuk menampilkan data dalam jumlah tertentu per halaman.
//     Mengembalikan tampilan transaksi.daftung dengan data transaksi yang diambil.
    public function transaksi()
    {
        $transaksi = DB::table('daftung')
                       ->where('Status', '!=', 'Validasi')
                       ->paginate(10); 
        return view('transaksi.daftung', ['transaksi' => $transaksi]);
    }

    // permohonan(), jumlahBayar(), validasi():

    // Mengambil data transaksi berdasarkan status tertentu (Permohonan, Bayar, Validasi) dan mengembalikannya ke tampilan masing-masing.

    public function permohonan()
    {
        $transaksi = DB::table('daftung')->where('Status', 'Permohonan')->get();
        return view('transaksi.permohonan', ['transaksi' => $transaksi, 'activeTab' => 'Permohonan']);
    }

    public function jumlahBayar()
    {
        $transaksi = DB::table('daftung')->where('Status', 'Bayar')->get();
        return view('transaksi.bayar', ['transaksi' => $transaksi, 'activeTab' => 'Bayar']);
    }

    public function validasi()
    {
        $transaksi = DB::table('daftung')->where('Status', 'Validasi')->get();
        return view('transaksi.validasi', ['transaksi' => $transaksi, 'activeTab' => 'Validasi']);
    }

    // countTransaksiPerDay(Request $request):

    // Menghitung jumlah transaksi berdasarkan rentang tanggal yang diinputkan.
    // Menyimpan tanggal awal dan akhir ke dalam session untuk digunakan di tampilan.
    // Mengambil total jumlah transaksi dan jumlah berdasarkan status dalam rentang tanggal yang ditentukan.

    public function countTransaksiPerDay(Request $request)
    {
        // Variabel $startDate dan $endDate menerima input tanggal dari pengguna melalui request. 
        // Variabel ini digunakan untuk menyaring data dalam rentang tanggal tertentu.
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Menyimpan Tanggal dalam Session:
         $request->session()->put('start_date', $startDate);
        $request->session()->put('end_date', $endDate);

        // Memeriksa Kondisi Tanggal dan Menghitung Total Transaksi:
        if ($startDate && $endDate) {
            $totalDaftung = DB::table('daftung')->whereBetween('Tgl_permohonan', [$startDate, $endDate])->count();
            $totalPermohonan = DB::table('daftung')->whereBetween('Tgl_permohonan', [$startDate, $endDate])->where('Status', 'Permohonan')->count();
            $totalBayar = DB::table('daftung')->whereBetween('Tgl_permohonan', [$startDate, $endDate])->where('Status', 'Bayar')->count();
            $totalValidasi = DB::table('daftung')->whereBetween('Tgl_permohonan', [$startDate, $endDate])->where('Status', 'Validasi')->count();
            $jenistransaksi = DB::table('daftung')->whereBetween('Tgl_permohonan', [$startDate, $endDate])->select('transaksi', DB::raw('count(*) as total'))->groupBy('transaksi')->get();
        } else {
            $totalDaftung = DB::table('daftung')->count();
            $totalPermohonan = DB::table('daftung')->where('Status', 'Permohonan')->count();
            $totalBayar = DB::table('daftung')->where('Status', 'Bayar')->count();
            $totalValidasi = DB::table('daftung')->where('Status', 'Validasi')->count();
            $jenistransaksi = DB::table('daftung')->select('transaksi', DB::raw('count(*) as total'))->groupBy('transaksi')->get();
        }

        // 1. if-Else Statement: Kode ini mengecek apakah $startDate dan $endDate tersedia.
        // Jika tersedia: Data transaksi dihitung berdasarkan tanggal yang berada di antara $startDate dan $endDate.
        // Jika tidak tersedia: Semua data transaksi dihitung tanpa batasan tanggal.

        // 2. Hitungan Berdasarkan Status Transaksi:
        // totalDaftung: Menghitung semua transaksi pada tabel daftung.
        // totalPermohonan, totalBayar, totalValidasi: Menghitung jumlah transaksi dengan status Permohonan, Bayar, dan Validasi
        
        // Hitungan Berdasarkan Jenis Transaksi:
        // 3. $jenistransaksi berisi data transaksi (jenis transaksi) dan jumlahnya (count) dalam periode yang ditentukan atau secara keseluruhan jika tidak ada tanggal.

        // Mengambil Label dan Data dari Jenis Transaksi:
        // pluck() digunakan untuk mengambil kolom tertentu dari hasil query jenistransaksi.
        // labels: Array dari nama jenis transaksi.
        // data: Array dari jumlah setiap jenis transaksi.
        $labels = $jenistransaksi->pluck('transaksi')->toArray();
        $data = $jenistransaksi->pluck('total')->toArray();
        
        // Ambil data bulanan
        // getMonthlyStats() adalah fungsi yang dipanggil untuk mengambil data statistik bulanan
        // - labelsMonthly, dataTotalMonthly, dan dataValidasiMonthly:
        // labelsMonthly: Label untuk data bulanan, misalnya bulan-bulan tertentu.
        // dataTotalMonthly: Total transaksi bulanan.
        // dataValidasiMonthly: Jumlah transaksi dengan status Validasi per bulan.
        $monthlyStats = $this->getMonthlyStats(); // Panggil fungsi baru
        $labelsMonthly = $monthlyStats['labels'];
        $dataTotalMonthly = $monthlyStats['dataTotal']; // Sesuaikan kunci dengan 'dataTotal'
        $dataValidasiMonthly = $monthlyStats['dataValidasi']; // Sesuaikan kunci dengan 'dataValidasi'
        
        
        return view('home', [
            'totalDaftung' => $totalDaftung,
            'totalPermohonan' => $totalPermohonan,
            'totalValidasi' => $totalValidasi,
            'totalBayar' => $totalBayar,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'labels' => $labels,
            'data' => $data,
            'labelsMonthly' => $labelsMonthly, // Kirim data bulanan
            'dataTotalMonthly' => $dataTotalMonthly, // Data total bulanan
            'dataValidasiMonthly' => $dataValidasiMonthly // Data validasi bulanan
        ]);
        
      
    }

    public function getMonthlyStats($startDate = null, $endDate = null)
    {
        // Mendapatkan bulan dan tahun sekarang
        $currentYear = date('Y');
        
        // Mengambil data jumlah pelanggan per bulan untuk tahun ini
        // DB::table('daftung'): Mengambil data dari tabel daftung.
        // select(DB::raw(...)): Memilih kolom-kolom khusus:
        // MONTH(Tgl_permohonan) as month: Mengambil bulan dari kolom Tgl_permohonan dan menyimpannya sebagai month.
        // COUNT(*) as total: Menghitung jumlah transaksi dan menyimpannya sebagai total
        $query = DB::table('daftung')->select(DB::raw('MONTH(Tgl_permohonan) as month'), DB::raw('COUNT(*) as total'));
    
        if ($startDate && $endDate) {
            $query->whereBetween('Tgl_permohonan', [$startDate, $endDate]); // Filter berdasarkan tanggal
        } else {
            $query->whereYear('Tgl_permohonan', $currentYear); // Hanya data dari tahun ini
        }
        
        // Total daftung
        // groupBy('month'): Mengelompokkan hasil query berdasarkan month.
        // orderBy('month'): Mengurutkan hasil query berdasarkan month.
        // get(): Menjalankan query dan mengambil hasilnya dalam bentuk koleksi yang disimpan di $monthlyStats.
        $monthlyStats = $query->groupBy('month')->orderBy('month')->get();
    
        // Total daftung tervalidasi
        $queryValidasi = DB::table('daftung')->select(DB::raw('MONTH(Tgl_permohonan) as month'), DB::raw('COUNT(*) as total'))
            ->where('Status', 'Validasi');
    
        if ($startDate && $endDate) {
            $queryValidasi->whereBetween('Tgl_permohonan', [$startDate, $endDate]); // Filter berdasarkan tanggal
        } else {
            $queryValidasi->whereYear('Tgl_permohonan', $currentYear); // Hanya data dari tahun ini
        }
    
        $monthlyValidasiStats = $queryValidasi->groupBy('month')->orderBy('month')->get();
    
        // Persiapkan data untuk chart
        $labels = [];
        $dataTotal = [];
        $dataValidasi = [];

        // Looping (for): Dari bulan 1 (Januari) hingga bulan 12 (Desember):
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $monthlyStats->firstWhere('month', $i); 

            //firstWhere('month', $i): Mencari data untuk bulan ke-$i.
            $monthValidasiData = $monthlyValidasiStats->firstWhere('month', $i);
    
            $labels[] = date('F', mktime(0, 0, 0, $i, 1)); 
            //abels[]: Menambahkan nama bulan ke array labels menggunakan date('F', mktime(0, 0, 0, $i, 1)), yang menghasilkan nama bulan seperti "January", "February", dll.
            $dataTotal[] = $monthData ? $monthData->total : 0; 
            // dataTotal[]: Menambahkan jumlah total transaksi ke array dataTotal. Jika data untuk bulan tersebut tidak ada, tambahkan 0.
            $dataValidasi[] = $monthValidasiData ? $monthValidasiData->total : 0; 
            // dataValidasi[]: Menambahkan jumlah transaksi tervalidasi ke array dataValidasi. Jika data untuk bulan tersebut tidak ada, tambahkan 0.
            // Maksud dari "tambahkan 0" adalah: jika tidak ada data transaksi tervalidasi untuk bulan tertentu, maka 0 akan ditambahkan ke dalam array dataValidasi sebagai nilai default untuk bulan tersebut.
        }
        return [
            'labels' => $labels, // labels: Menyimpan nama bulan.
            'dataTotal' => $dataTotal, // dataTotal: Menyimpan jumlah total transaksi untuk setiap bulan.
            'dataValidasi' => $dataValidasi, // dataValidasi: Menyimpan jumlah transaksi tervalidasi untuk setiap bulan.
        ];
    }
    
    public function add()
    {
        return view('transaksi.add');
    }

    public function process(Request $request)
    {
        $request->validate([
            'Tgl_permohonan' => 'required|date_format:Y-m-d',
        ]);

        DB::table('daftung')->insert([
            'Tgl_permohonan' => $request->Tgl_permohonan,
            'Transaksi' => $request->transaksi,
            'idpel' => $request->idpel,
            'Nama_Pelanggan' => $request->nama_pelanggan,
            'Nama_Pemohon' => $request->nama_pemohon,
            'No_HP' => $request->no_hp,
            'Daya' => $request->daya,
            'Status' => $request->status,
            'Tarif' => $request->tarif,
            'Alamat' => $request->alamat,
            'Nama_Admin' => Auth::user()->name, // Menyimpan nama admin yang sedang login
            'input_time' => now() // Menyimpan waktu saat ini

        ]);

        return redirect('transaksi/' . strtolower($request->status))->with('status', 'Data berhasil ditambah');
    }

    public function show($id)
    {
        $transaksi = DB::table('daftung')->where('id', $id)->first();
        return view('transaksi.show', ['transaksi' => $transaksi]);
    }

    public function edit($id)
    {
        $transaksi = DB::table('daftung')->where('id', $id)->first();
        return view('transaksi.edit', compact('transaksi'));
    }

    public function editprocess(Request $request, $id)
    {
        $validated = $request->input('is_validated') === '1' ? true : false;

        DB::table('daftung')->where('id', $id)->update([
            'transaksi' => $request->transaksi,      
            'Status' => $validated ? 'Validasi' : $request->status,
            'is_validated' => $validated,
        ]);

        return redirect('transaksi/' . strtolower($request->status))->with('status', 'Data berhasil diupdate');
    }

    public function laporan(Request $request)
    {
        $query = Daftung::query(); // Memulai query Daftung
    
        // Memeriksa apakah ada input tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
    
            // Filter berdasarkan tanggal
            $query->whereBetween('Tgl_permohonan', [$startDate, $endDate]);
        }
    
        // Memeriksa apakah ada input pencarian
        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');
            $query->where('idpel', 'LIKE', '%' . $searchTerm . '%'); // Filter berdasarkan IDPEL
        }
    
        // Mendapatkan semua data yang sudah difilter
        $daftung = $query->paginate(10); // Gunakan pagination jika perlu
    
        return view('transaksi.laporan', [
            'daftung' => $daftung,
            'startDate' => $startDate ?? null, // Mengirimkan kembali tanggal ke view
            'endDate' => $endDate ?? null, // Mengirimkan kembali tanggal ke view
            'search' => $searchTerm ?? '' // Mengirimkan kembali search term ke view
        ]);
    }
    
    // function untuk meng export data tabel di laporan
    public function exportLaporan(Request $request)
{
    $startDate = $request->input('start_date'); // Ambil tanggal awal dari input
    $endDate = $request->input('end_date'); // Ambil tanggal akhir dari input

    // Jika ada filter tanggal
    if ($startDate && $endDate) {
        // Ekspor data terfilter
        return Excel::download(new laporanExport($startDate, $endDate), 'laporan_daftar_tunggu_' . date('Y-m-d') . '_filtered.xlsx');
    } else {
        // Ekspor semua data
        return Excel::download(new laporanExport(), 'laporan_daftar_tunggu_' . date('Y-m-d') . '_all.xlsx');
    }
}

}



