<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesaStatistic;
use App\Models\DesaStatisticHistory;
use Illuminate\Http\Request;

class DesaStatisticController extends Controller
{
    public function index()
    {
        $desaId = 1;

        $statistic = DesaStatistic::firstOrCreate(
            ['desa_id' => $desaId],
            ['desa_id' => $desaId]
        );

        return view('admin.data-desa.statistics', compact('statistic'));
    }

    public function update(Request $request)
    {
        $desaId = 1;

        $validated = $request->validate([
            'total_penduduk' => 'required|integer|min:0',
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'kepala_keluarga' => 'required|integer|min:0',
            'keluarga_miskin' => 'required|integer|min:0',

            'balita' => 'required|integer|min:0',
            'anak' => 'required|integer|min:0',
            'remaja' => 'required|integer|min:0',
            'dewasa' => 'required|integer|min:0',
            'lansia' => 'required|integer|min:0',
            'disabilitas' => 'required|integer|min:0',

            'belum_sekolah' => 'required|integer|min:0',
            'sd' => 'required|integer|min:0',
            'smp' => 'required|integer|min:0',
            'sma' => 'required|integer|min:0',
            'diploma' => 'required|integer|min:0',
            'sarjana' => 'required|integer|min:0',

            'petani' => 'required|integer|min:0',
            'nelayan' => 'required|integer|min:0',
            'pedagang' => 'required|integer|min:0',
            'wiraswasta' => 'required|integer|min:0',
            'pns' => 'required|integer|min:0',
            'karyawan' => 'required|integer|min:0',
            'pelajar' => 'required|integer|min:0',
            'belum_bekerja' => 'required|integer|min:0',

            'islam' => 'required|integer|min:0',
            'kristen' => 'required|integer|min:0',
            'katolik' => 'required|integer|min:0',
            'hindu' => 'required|integer|min:0',
            'buddha' => 'required|integer|min:0',
            'konghucu' => 'required|integer|min:0',
            'kepercayaan_lainnya' => 'required|integer|min:0',

            'sekolah' => 'required|integer|min:0',
            'posyandu' => 'required|integer|min:0',
            'puskesmas' => 'required|integer|min:0',
            'tempat_ibadah' => 'required|integer|min:0',

            'luas_wilayah' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
        ]);

        $statistic = DesaStatistic::updateOrCreate(
            ['desa_id' => $desaId],
            $validated
        );

        /*
         * Simpan snapshot tahunan.
         * Data ini nantinya digunakan untuk
         * fitur Data Pertahun.
         */
        $tahun = now()->year;

        DesaStatisticHistory::updateOrCreate(
            [
                'desa_id' => $desaId,
                'tahun' => $tahun,
            ],
            [
                'data' => $statistic->toArray(),
                'catatan' => $request->catatan,
            ]
        );

        return redirect()
            ->route('admin.data-desa.statistics')
            ->with('success', 'Data statistik desa berhasil diperbarui.');
    }
}