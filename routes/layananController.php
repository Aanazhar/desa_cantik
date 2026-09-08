<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class LayananController extends Controller
{
    protected function desaId(): int
    {
        return session('desa_id', 1);
    }
    /**
     * 1. Halaman Publik Daftar Layanan Desa
     */
    public function index()
    {
        $services = DB::table('services')
            ->where('active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();
        return view('layanan', compact('services'));
    }
    /**
     * 2. Halaman Detail & Formulir Layanan (layanan_show.blade.php)
     */
    public function show($id)
    {
        $service = DB::table('services')->where('id', $id)->first();
        if (!$service) {
            abort(404, 'Layanan tidak ditemukan.');
        }
        // Decode JSON fields & requirements
        if (isset($service->requirements) && is_string($service->requirements)) {
            $service->requirements = array_filter(explode("\n", str_replace("\r", "", $service->requirements)));
        } else {
            $service->requirements = [];
        }
        if (isset($service->form_fields) && is_string($service->form_fields)) {
            $service->form_fields = json_decode($service->form_fields, true) ?? [];
        } else {
            $service->form_fields = [];
        }
        return view('layanan_show', compact('service'));
    }
    /**
     * 3. Memproses Pengajuan Surat Baru dari Warga
     */
    public function pengajuanSurat(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'nama'       => 'required|string|max:255',
            'no_hp'      => 'required|string|max:30',
        ]);
        $desaId = $this->desaId();
        // Generate Kode Pengajuan Unik (Contoh: WAHA-A1B2C3D4)
        $trackingCode = 'WAHA-' . strtoupper(Str::random(8));
        $formData = $request->input('form', []);
        DB::table('pengajuan_surat')->insert([
            'desa_id'       => $desaId,
            'service_id'    => $request->service_id,
            'tracking_code' => $trackingCode,
            'nama'          => $request->nama,
            'no_hp'         => $request->no_hp,
            'form_data'     => json_encode($formData),
            'status'        => 'pending',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
        // Redirect langsung ke halaman status dengan membawa Kode Pengajuan & Notifikasi Pop-Up
        return redirect()->route('layanan.status', ['kode' => $trackingCode])
            ->with('success', 'Pengajuan surat berhasil dikirim!')
            ->with('tracking_code', $trackingCode);
    }
    /**
     * 4. Halaman Cek Status Pengajuan (layanan_status.blade.php)
     */
    public function status(Request $request)
    {
        $kode = $request->query('kode') ?? session('tracking_code');
        $requestData = null;
        $searched = false;
        if ($kode) {
            $searched = true;
            $requestData = DB::table('pengajuan_surat')
                ->where('tracking_code', trim($kode))
                ->first();
            if ($requestData) {
                // Ambil judul layanan terkait
                $service = DB::table('services')->where('id', $requestData->service_id)->first();
                $requestData->service = $service;
                
                // Format tanggal
                if (isset($requestData->created_at)) {
                    $requestData->created_at = \Carbon\Carbon::parse($requestData->created_at);
                }
            }
        }
        return view('layanan_status', compact('searched', 'requestData'));
    }
    /**
     * 5. Memproses Form Pencarian Status
     */
    public function statusCheck(Request $request)
    {
        $kode = trim($request->input('kode'));
        return redirect()->route('layanan.status', ['kode' => $kode]);
    }
    /**
     * 6. Halaman Admin Kelola Layanan & No WA (admin/layanan.blade.php)
     */
    public function adminIndex()
    {
        $services = DB::table('services')->orderBy('sort_order', 'asc')->get();
        foreach ($services as $service) {
            if (isset($service->requirements) && is_string($service->requirements)) {
                $service->requirements = array_filter(explode("\n", str_replace("\r", "", $service->requirements)));
            } else {
                $service->requirements = [];
            }
            if (isset($service->form_fields) && is_string($service->form_fields)) {
                $service->form_fields = json_decode($service->form_fields, true) ?? [];
            } else {
                $service->form_fields = [];
            }
        }
        return view('admin.layanan', compact('services'));
    }
    /**
     * 7. Admin: Simpan Layanan Baru
     */
    public function adminStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        DB::table('services')->insert([
            'desa_id'      => $this->desaId(),
            'title'        => $request->title,
            'icon'         => $request->icon ?? '📄',
            'description'  => $request->description,
            'sort_order'   => (int) ($request->sort_order ?? 0),
            'is_letter'    => $request->has('is_letter') ? 1 : 0,
            'active'       => 1,
            'requirements' => $request->requirements,
            'form_fields'  => $request->form_fields,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
        return redirect()->back()->with('success', 'Layanan baru berhasil ditambahkan!');
    }
    /**
     * 8. Admin: Update Layanan
     */
    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        DB::table('services')->where('id', $id)->update([
            'title'        => $request->title,
            'icon'         => $request->icon ?? '📄',
            'description'  => $request->description,
            'sort_order'   => (int) ($request->sort_order ?? 0),
            'active'       => (int) ($request->active ?? 1),
            'requirements' => $request->requirements,
            'form_fields'  => $request->form_fields,
            'updated_at'   => now(),
        ]);
        return redirect()->back()->with('success', 'Perubahan layanan berhasil disimpan!');
    }
    /**
     * 9. Admin: Toggle Aktif/Nonaktif Layanan
     */
    public function adminToggle($id)
    {
        $service = DB::table('services')->where('id', $id)->first();
        if ($service) {
            DB::table('services')->where('id', $id)->update([
                'active' => $service->active ? 0 : 1,
                'updated_at' => now(),
            ]);
        }
        return redirect()->back()->with('success', 'Status layanan berhasil diperbarui!');
    }
    /**
     * 10. Admin: Hapus Layanan
     */
    public function adminDestroy($id)
    {
        DB::table('services')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus.');
    }
    /**
     * 11. Admin: Simpan/Update Nomor WhatsApp Petugas
     */
    public function updateWhatsapp(Request $request)
    {
        $request->validate([
            'no_whatsapp' => 'required|string|max:30',
        ]);
        $desaId = $this->desaId();
        DB::table('isi_situs')->updateOrInsert(
            ['desa_id' => $desaId, 'key' => 'no_whatsapp'],
            ['value' => $request->no_whatsapp, 'updated_at' => now()]
        );
        return redirect()->back()->with('success', 'Nomor WhatsApp petugas pelayanan berhasil diperbarui!');
    }
}