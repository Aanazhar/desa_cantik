<?php

namespace App\Http\Controllers;

use App\Models\BerkasLaporanDesa;
use App\Models\DesaStatisticHistory;
use App\Models\DesaVillage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataDesaController extends Controller
{
    protected function desaId(): int
    {
        return session('desa_id', 1);
    }

    private function getStatistics(): array
    {
        $desaId = $this->desaId();

        $kependudukan = DB::table('statistik_kependudukan')->where('desa_id', $desaId)->first();
        $perumahan    = DB::table('statistik_perumahan')->where('desa_id', $desaId)->first();
        $bangunan     = DB::table('statistik_bangunan')->where('desa_id', $desaId)->first();
        $perkawinan   = DB::table('statistik_perkawinan')->where('desa_id', $desaId)->first();
        $kelompokUmur = DB::table('statistik_kelompok_umur')->where('desa_id', $desaId)->first();
        $pendidikan   = DB::table('statistik_pendidikan')->where('desa_id', $desaId)->first();
        $pekerjaan    = DB::table('statistik_pekerjaan')->where('desa_id', $desaId)->first();
        $agama        = DB::table('statistik_agama')->where('desa_id', $desaId)->first();
        $fasilitas    = DB::table('statistik_fasilitas')->where('desa_id', $desaId)->first();

        return array_merge(
            (array) $kependudukan,
            (array) $perumahan,
            (array) $bangunan,
            (array) $perkawinan,
            (array) $kelompokUmur,
            (array) $pendidikan,
            (array) $pekerjaan,
            (array) $agama,
            (array) $fasilitas,
            ['desa_id' => $desaId]
        );
    }

    private function histories()
    {
        $desaId = $this->desaId();
        $histories = DesaStatisticHistory::where('desa_id', $desaId)->orderByDesc('tahun')->get();
        $berkasList = BerkasLaporanDesa::where('desa_id', $desaId)->get()->keyBy('tahun');

        // GABUNGKAN DATA FILE DARI TABEL berkas_laporan_desa KE RIWAYAT
        foreach ($histories as $h) {
            $data = is_array($h->data) ? $h->data : [];
            if (isset($berkasList[$h->tahun])) {
                $b = $berkasList[$h->tahun];
                if (!empty($b->file_csv)) $data['file_csv'] = $b->file_csv;
                if (!empty($b->file_pdf)) $data['file_pdf'] = $b->file_pdf;
            }
            $h->data = $data;
        }

        return $histories;
    }

    private function selectedData(Request $request): array
    {
        $statisticsArray = $this->getStatistics();
        $histories = $this->histories();

        $historyYears = $histories->pluck('tahun')->map(fn ($year) => (int) $year)->unique()->sortDesc();
        $currentSystemYear = (int) date('Y');

        $years = $historyYears->concat([$currentSystemYear])->unique()->sortDesc()->values();

        $requestedYear = (int) $request->query('year', 0);

        if ($requestedYear && $years->contains($requestedYear)) {
            $selectedYear = $requestedYear;
        } else {
            $selectedYear = $historyYears->first() ?? $currentSystemYear;
        }

        $selected = $histories->firstWhere('tahun', $selectedYear);
        $displayStats = $selected?->data;

        if (!is_array($displayStats)) {
            $displayStats = $statisticsArray;
        }

        return [
            'statistics'   => (object) $statisticsArray,
            'histories'    => $histories,
            'years'        => $years,
            'selectedYear' => $selectedYear,
            'selected'     => $selected,
            'displayStats' => $displayStats
        ];
    }

    public function index(Request $request)
    {
        $data = $this->selectedData($request);
        $villages = DesaVillage::where('desa_id', $this->desaId())->orderBy('id')->get();
        return view('data-desa', array_merge($data, compact('villages')));
    }

    public function category(string $category, Request $request)
    {
        $data = $this->selectedData($request);
        $villages = DesaVillage::where('desa_id', $this->desaId())->orderBy('id')->get();

        return view('data-desa', array_merge($data, [
            'category' => $category,
            'villages' => $villages,
        ]));
    }

    public function admin(Request $request)
    {
        $data = $this->selectedData($request);
        $villages = DesaVillage::where('desa_id', $this->desaId())->orderBy('id')->get();
        return view('admin.data-desa', array_merge($data, compact('villages')));
    }

    public function adminCategory(string $category, Request $request)
    {
        $data = $this->selectedData($request);
        $villages = DesaVillage::where('desa_id', $this->desaId())->orderBy('id')->get();

        return view('admin.data-desa', array_merge($data, [
            'category' => $category,
            'villages' => $villages,
        ]));
    }

    public function updateStatistics(Request $request)
    {
        $validated = $request->validate([
            'tahun_data'          => ['nullable', 'integer'],
            'total_penduduk'      => ['nullable', 'integer'],
            'kepala_keluarga'     => ['nullable', 'integer'],
            'laki_laki'           => ['nullable', 'integer'],
            'perempuan'           => ['nullable', 'integer'],
            'keluarga_miskin'     => ['nullable', 'integer'],
            'disabilitas'         => ['nullable', 'integer'],
            'luas_wilayah'        => ['nullable', 'numeric'],
            'balita'              => ['nullable', 'integer'],
            'anak'                => ['nullable', 'integer'],
            'remaja'              => ['nullable', 'integer'],
            'dewasa'              => ['nullable', 'integer'],
            'lansia'              => ['nullable', 'integer'],
            'sekolah'             => ['nullable', 'integer'],
            'posyandu'            => ['nullable', 'integer'],
            'puskesmas'           => ['nullable', 'integer'],
            'tempat_ibadah'       => ['nullable', 'integer'],
            'rumah_tinggal'       => ['nullable', 'integer'],
            'toko'                => ['nullable', 'integer'],
            'fasilitas'           => ['nullable', 'integer'],
            'bangunan_lain'       => ['nullable', 'integer'],
            'rumah_sendiri'       => ['nullable', 'integer'],
            'rumah_sewa'          => ['nullable', 'integer'],
            'bebas_sewa'          => ['nullable', 'integer'],
            'menumpang'           => ['nullable', 'integer'],
            'belum_kawin'         => ['nullable', 'integer'],
            'kawin'               => ['nullable', 'integer'],
            'cerai_hidup'         => ['nullable', 'integer'],
            'cerai_mati'          => ['nullable', 'integer'],
            'petani'              => ['nullable', 'integer'],
            'nelayan'             => ['nullable', 'integer'],
            'pedagang'            => ['nullable', 'integer'],
            'wiraswasta'          => ['nullable', 'integer'],
            'pns'                 => ['nullable', 'integer'],
            'karyawan'            => ['nullable', 'integer'],
            'pelajar'             => ['nullable', 'integer'],
            'belum_bekerja'       => ['nullable', 'integer'],
            'islam'               => ['nullable', 'integer'],
            'kristen'             => ['nullable', 'integer'],
            'katolik'             => ['nullable', 'integer'],
            'hindu'               => ['nullable', 'integer'],
            'buddha'              => ['nullable', 'integer'],
            'konghucu'            => ['nullable', 'integer'],
            'kepercayaan_lainnya' => ['nullable', 'integer'],
            'belum_sekolah'       => ['nullable', 'integer'],
            'sd'                  => ['nullable', 'integer'],
            'smp'                 => ['nullable', 'integer'],
            'sma'                 => ['nullable', 'integer'],
            'diploma'             => ['nullable', 'integer'],
            'sarjana'             => ['nullable', 'integer'],
            'catatan'             => ['nullable', 'string'],
            'file_csv'            => ['nullable', 'file', 'mimes:csv,txt,xls,xlsx', 'max:10240'],
            'file_pdf'            => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        $year = (int) ($validated['tahun_data'] ?? date('Y'));
        unset($validated['tahun_data']);

        $desaId = $this->desaId();

        // CEK ATAU BUAT BERKAS DI TABEL DEDIKASI berkas_laporan_desa
        $berkasRecord = BerkasLaporanDesa::firstOrNew(['desa_id' => $desaId, 'tahun' => $year]);

        // JIKA UPLOAD FILE CSV BARU
        if ($request->hasFile('file_csv')) {
            if ($berkasRecord->file_csv) {
                @unlink(public_path(ltrim($berkasRecord->file_csv, '/')));
            }
            $fileCsvPath = $this->uploadFile($request->file('file_csv'), 'csv', $year);
            $validated['file_csv'] = $fileCsvPath;
            $berkasRecord->file_csv = $fileCsvPath;
        } else {
            // PERTAHANKAN FILE CSV LAMA JIKA TIDAK DILIHAT FILE BARU
            if ($berkasRecord->file_csv) {
                $validated['file_csv'] = $berkasRecord->file_csv;
            }
        }

        // JIKA UPLOAD FILE PDF BARU
        if ($request->hasFile('file_pdf')) {
            if ($berkasRecord->file_pdf) {
                @unlink(public_path(ltrim($berkasRecord->file_pdf, '/')));
            }
            $filePdfPath = $this->uploadFile($request->file('file_pdf'), 'pdf', $year);
            $validated['file_pdf'] = $filePdfPath;
            $berkasRecord->file_pdf = $filePdfPath;
        } else {
            // PERTAHANKAN FILE PDF LAMA JIKA TIDAK DILIHAT FILE BARU
            if ($berkasRecord->file_pdf) {
                $validated['file_pdf'] = $berkasRecord->file_pdf;
            }
        }

        $berkasRecord->save();

        // SIMPAN KE KE-9 TABEL ANEKA STATISTIK + SNAPSHOT RIWAYAT
        $this->saveSnapshotMultiTable($year, array_filter($validated, fn($v) => !is_null($v)));

        return redirect()->back()->with('success', "Seluruh data & berkas desa tahun {$year} berhasil disimpan ke database!");
    }

    private function uploadFile($file, string $type, int $year): string
    {
        $dir = public_path('uploads/data-desa');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $filename = "laporan-data-desa-{$year}-" . time() . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return '/uploads/data-desa/' . $filename;
    }

    private function saveSnapshotMultiTable(int $year, array $changes): void
    {
        DB::transaction(function () use ($year, $changes) {
            $desaId = $this->desaId();

            // 1. UPDATE TABEL statistik_kependudukan
            $kepData = array_intersect_key($changes, array_flip(['total_penduduk', 'laki_laki', 'perempuan', 'kepala_keluarga', 'luas_wilayah', 'catatan']));
            if (!empty($kepData)) {
                DB::table('statistik_kependudukan')->updateOrInsert(['desa_id' => $desaId], array_merge($kepData, ['updated_at' => now()]));
            }

            // 2. UPDATE TABEL statistik_perumahan
            $perData = array_intersect_key($changes, array_flip(['rumah_sendiri', 'rumah_sewa', 'bebas_sewa', 'menumpang']));
            if (!empty($perData)) {
                DB::table('statistik_perumahan')->updateOrInsert(['desa_id' => $desaId], array_merge($perData, ['updated_at' => now()]));
            }

            // 3. UPDATE TABEL statistik_bangunan
            $bangData = array_intersect_key($changes, array_flip(['rumah_tinggal', 'toko', 'fasilitas', 'bangunan_lain']));
            if (!empty($bangData)) {
                DB::table('statistik_bangunan')->updateOrInsert(['desa_id' => $desaId], array_merge($bangData, ['updated_at' => now()]));
            }

            // 4. UPDATE TABEL statistik_perkawinan
            $kawData = array_intersect_key($changes, array_flip(['belum_kawin', 'kawin', 'cerai_hidup', 'cerai_mati']));
            if (!empty($kawData)) {
                DB::table('statistik_perkawinan')->updateOrInsert(['desa_id' => $desaId], array_merge($kawData, ['updated_at' => now()]));
            }

            // 5. UPDATE TABEL statistik_kelompok_umur
            $umurData = array_intersect_key($changes, array_flip(['keluarga_miskin', 'balita', 'anak', 'remaja', 'dewasa', 'lansia', 'disabilitas']));
            if (!empty($umurData)) {
                DB::table('statistik_kelompok_umur')->updateOrInsert(['desa_id' => $desaId], array_merge($umurData, ['updated_at' => now()]));
            }

            // 6. UPDATE TABEL statistik_pendidikan
            $pendData = array_intersect_key($changes, array_flip(['belum_sekolah', 'sd', 'smp', 'sma', 'diploma', 'sarjana']));
            if (!empty($pendData)) {
                DB::table('statistik_pendidikan')->updateOrInsert(['desa_id' => $desaId], array_merge($pendData, ['updated_at' => now()]));
            }

            // 7. UPDATE TABEL statistik_pekerjaan
            $pekData = array_intersect_key($changes, array_flip(['petani', 'nelayan', 'pedagang', 'wiraswasta', 'pns', 'karyawan', 'pelajar', 'belum_bekerja']));
            if (!empty($pekData)) {
                DB::table('statistik_pekerjaan')->updateOrInsert(['desa_id' => $desaId], array_merge($pekData, ['updated_at' => now()]));
            }

            // 8. UPDATE TABEL statistik_agama
            $agmData = array_intersect_key($changes, array_flip(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu', 'kepercayaan_lainnya']));
            if (!empty($agmData)) {
                DB::table('statistik_agama')->updateOrInsert(['desa_id' => $desaId], array_merge($agmData, ['updated_at' => now()]));
            }

            // 9. UPDATE TABEL statistik_fasilitas
            $fasData = array_intersect_key($changes, array_flip(['sekolah', 'posyandu', 'puskesmas', 'tempat_ibadah']));
            if (!empty($fasData)) {
                DB::table('statistik_fasilitas')->updateOrInsert(['desa_id' => $desaId], array_merge($fasData, ['updated_at' => now()]));
            }

            // 10. SIMPAN SNAPSHOT RIWAYAT TAHUNAN
            $history = DesaStatisticHistory::where('desa_id', $desaId)
                ->where('tahun', $year)
                ->first();

            $base = is_array($history?->data) ? $history->data : $this->getStatistics();
            $data = array_merge($base, $changes, ['desa_id' => $desaId]);
            unset($data['id'], $data['created_at'], $data['updated_at']);

            DesaStatisticHistory::updateOrCreate(
                ['desa_id' => $desaId, 'tahun' => $year],
                ['data' => $data, 'catatan' => $data['catatan'] ?? null]
            );
        });
    }

    public function export(Request $request, string $format)
    {
        $year = (int) $request->query('year', date('Y'));
        $desaId = $this->desaId();

        $berkas = BerkasLaporanDesa::where('desa_id', $desaId)->where('tahun', $year)->first();
        $fieldKey = $format === 'pdf' ? 'file_pdf' : 'file_csv';
        $filePathRelative = $berkas?->$fieldKey;

        if (!$filePathRelative) {
            $history = DesaStatisticHistory::where('desa_id', $desaId)->where('tahun', $year)->first();
            $filePathRelative = $history?->data[$fieldKey] ?? null;
        }

        if ($filePathRelative) {
            $fullPath = public_path(ltrim($filePathRelative, '/'));
            if (is_file($fullPath)) {
                $ext = pathinfo($fullPath, PATHINFO_EXTENSION);
                return response()->download($fullPath, "laporan-resmi-data-desa-{$year}.{$ext}");
            }
        }

        return redirect()->back()->with('error', "Berkas laporan resmi format " . strtoupper($format) . " untuk tahun {$year} belum diunggah oleh Admin.");
    }

    public function destroyFile(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'type'  => 'required|in:csv,pdf',
        ]);

        $year = (int) $request->input('tahun');
        $type = $request->input('type');
        $fieldKey = $type === 'csv' ? 'file_csv' : 'file_pdf';

        $desaId = $this->desaId();

        // HAPUS DARI TABEL berkas_laporan_desa
        $berkas = BerkasLaporanDesa::where('desa_id', $desaId)->where('tahun', $year)->first();
        if ($berkas && !empty($berkas->$fieldKey)) {
            $filePath = public_path(ltrim($berkas->$fieldKey, '/'));
            if (is_file($filePath)) {
                @unlink($filePath);
            }
            $berkas->$fieldKey = null;
            $berkas->save();
        }

        // HAPUS DARI TABEL RIWAYAT
        $history = DesaStatisticHistory::where('desa_id', $desaId)->where('tahun', $year)->first();
        if ($history && is_array($history->data) && !empty($history->data[$fieldKey])) {
            $data = $history->data;
            unset($data[$fieldKey]);
            $history->update(['data' => $data]);
        }

        return redirect()->back()->with('success', "Berkas " . strtoupper($type) . " tahun {$year} berhasil dihapus.");
    }

    public function storeVillage(Request $request)
    {
        $request->validate([
            'nama_dusun'      => 'required|string|max:255',
            'jumlah_rt'       => 'required|integer|min:0',
            'jumlah_penduduk' => 'required|integer|min:0',
        ]);

        DesaVillage::create([
            'desa_id'         => $this->desaId(),
            'nama_dusun'      => $request->string('nama_dusun'),
            'jumlah_rt'       => $request->integer('jumlah_rt'),
            'jumlah_penduduk' => $request->integer('jumlah_penduduk'),
        ]);

        return redirect()->back()->with('success', 'Data dusun berhasil ditambahkan.');
    }

    public function destroyVillage($id)
    {
        DesaVillage::where('desa_id', $this->desaId())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data dusun berhasil dihapus.');
    }

    public function destroyHistory($id)
    {
        DesaStatisticHistory::where('desa_id', $this->desaId())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Riwayat data berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        return $this->export($request, 'csv');
    }
}