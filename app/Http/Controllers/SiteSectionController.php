<?php

namespace App\Http\Controllers;

use App\Models\LetterRequest;
use App\Models\SiteSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteSectionController extends Controller
{
    private const SERVICE_TYPES = ['service'];

    public function services()
    {
        $services = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'service')->where('active', true)
            ->orderBy('sort_order')->orderBy('id')->get();

        foreach ($services as $service) {
            if ($service->is_letter && empty($service->form_fields)) {
                $service->form_fields = $this->defaultFields($service->title);
            }
        }

        return view('layanan', [
            'services' => $services->where('is_letter', false),
            'letters' => $services->where('is_letter', true),
        ]);
    }

    public function service(int $id)
    {
        $service = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'service')->where('active', true)->findOrFail($id);

        if ($service->is_letter && empty($service->form_fields)) {
            $service->form_fields = $this->defaultFields($service->title);
        }

        return view('layanan-show', compact('service'));
    }

    public function status()
    {
        return view('layanan-status');
    }

    public function checkStatus(Request $request)
    {
        $data = $request->validate([
            'kode' => ['required', 'string', 'max:30'],
        ]);

        $requestData = LetterRequest::with('service')
            ->where('desa_id', $this->desaId())
            ->where('tracking_code', strtoupper(trim($data['kode'])))
            ->first();

        return view('layanan-status', [
            'requestData' => $requestData,
            'searched' => true,
        ]);
    }

    public function kontak()
    {
        $kontak = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'contact')
            ->where('active', true)
            ->orderBy('sort_order')->orderBy('id')->get();

        return view('kontak', compact('kontak'));
    }

    public function submitLetterRequest(Request $request)
    {
        $service = SiteSection::where('desa_id', $this->desaId())
            ->where('id', $request->input('service_id'))
            ->where('type', 'service')->where('is_letter', true)
            ->where('active', true)->firstOrFail();

        $rules = [
            'service_id' => ['required', 'integer'],
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
        ];

        $fields = $service->form_fields ?: $this->defaultFields($service->title);
        foreach ($fields as $field) {
            $name = $field['name'] ?? null;
            if (!$name || in_array($name, ['nama', 'nik', 'no_hp'], true) || ($field['type'] ?? '') === 'document') {
                continue;
            }
            $rules['form.' . $name] = ($field['required'] ?? false)
                ? ['required', 'string', 'max:2000']
                : ['nullable', 'string', 'max:2000'];
        }

        $validated = $request->validate($rules);
        $form = $validated['form'] ?? [];
        $keperluan = $form['keperluan'] ?? 'Pengajuan layanan';

        do {
            $trackingCode = 'DC-' . strtoupper(Str::random(8));
        } while (LetterRequest::where('tracking_code', $trackingCode)->exists());

        LetterRequest::create([
            'desa_id' => $this->desaId(),
            'service_id' => $service->id,
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'keperluan' => $keperluan,
            'form_data' => $form,
            'tracking_code' => $trackingCode,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('layanan.status')
            ->with('success', 'Pengajuan berhasil dikirim.')
            ->with('tracking_code', $trackingCode);
    }

    public function adminServices()
    {
        $services = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'service')->orderBy('sort_order')->orderBy('id')->get();

        foreach ($services as $service) {
            if ($service->is_letter && empty($service->form_fields)) {
                $service->form_fields = $this->defaultFields($service->title);
            }
        }

        return view('admin.layanan', compact('services'));
    }

    public function adminRequests()
    {
        $requests = LetterRequest::with('service')
            ->where('desa_id', $this->desaId())->latest()->paginate(20);

        return view('admin.pengajuan', compact('requests'));
    }

    public function storeService(Request $request)
    {
        $v = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_letter' => ['nullable', 'boolean'],
            'form_fields' => ['nullable'],
            'requirements' => ['nullable', 'string', 'max:10000'],
        ]);

        $isLetter = $request->boolean('is_letter');
        $fields = $isLetter ? ($this->parseFields($v['form_fields'] ?? null) ?: $this->defaultFields($v['title'])) : null;

        SiteSection::create([
            'desa_id' => $this->desaId(),
            'type' => 'service',
            'title' => $v['title'],
            'description' => $v['description'] ?? null,
            'icon' => $v['icon'] ?? '📄',
            'is_letter' => $isLetter,
            'form_fields' => $fields,
            'requirements' => $isLetter ? $this->parseRequirements($v['requirements'] ?? '') : [],
            'active' => true,
            'sort_order' => $v['sort_order'] ?? 0,
        ]);

        return back()->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function updateService(Request $request, int $id)
    {
        $service = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'service')->findOrFail($id);

        $v = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'form_fields' => ['nullable'],
            'requirements' => ['nullable', 'string', 'max:10000'],
        ]);

        $parsed = $this->parseFields($request->input('form_fields'));
        if ($service->is_letter && $request->filled('form_fields') && !is_array($parsed)) {
            return back()->withErrors(['form_fields' => 'Field formulir harus berupa JSON array yang valid.']);
        }

        $service->update([
            'title' => $v['title'],
            'description' => $v['description'] ?? null,
            'icon' => $v['icon'] ?? '📄',
            'sort_order' => $v['sort_order'] ?? 0,
            'form_fields' => $service->is_letter ? ($parsed ?: ($service->form_fields ?: $this->defaultFields($v['title']))) : null,
            'requirements' => $service->is_letter ? $this->parseRequirements($v['requirements'] ?? '') : [],
            'active' => $request->boolean('active', true),
        ]);

        return back()->with('success', 'Layanan berhasil diperbarui.');
    }

    public function toggleService(int $id)
    {
        $service = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'service')->findOrFail($id);
        $service->update(['active' => !$service->active]);
        return back()->with('success', 'Status layanan berhasil diubah.');
    }

    /**
     * Hapus Layanan dari Database
     */
    public function destroyService(int $id)
    {
        $service = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'service')->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Layanan berhasil dihapus dari database.');
    }

    public function updateLetterRequest(Request $request, int $id)
    {
        $v = $request->validate([
            'status' => ['required', 'in:Menunggu,Diproses,Selesai,Ditolak'],
            'catatan_admin' => ['nullable', 'string', 'max:2000'],
        ]);

        LetterRequest::where('desa_id', $this->desaId())->findOrFail($id)->update($v);
        return back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function adminContacts()
    {
        $kontak = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'contact')->orderBy('sort_order')->orderBy('id')->get();
        return view('admin.kontak', compact('kontak'));
    }

    public function storeContact(Request $request)
    {
        $v = $request->validate([
            'type' => ['required', 'in:whatsapp,instagram,facebook,youtube,tiktok,email,website,phone,address,other'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'icon' => ['nullable', 'string', 'max:20'],
            'url' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $v['url'] = $this->normalizeContactValue($v['type'], $v['url'] ?? '');
        $v['icon'] = $v['icon'] ?: $this->contactIcon($v['type']);

        SiteSection::create([
            'desa_id' => $this->desaId(),
            'type' => 'contact',
            'title' => $v['title'],
            'description' => $v['description'] ?? null,
            'icon' => $v['icon'],
            'url' => $v['url'],
            'sort_order' => $v['sort_order'] ?? 0,
            'active' => true,
        ]);

        return back()->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function updateContact(Request $request, int $id)
    {
        $contact = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'contact')->findOrFail($id);

        $v = $request->validate([
            'type' => ['required', 'in:whatsapp,instagram,facebook,youtube,tiktok,email,website,phone,address,other'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'icon' => ['nullable', 'string', 'max:20'],
            'url' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $v['url'] = $this->normalizeContactValue($v['type'], $v['url'] ?? '');
        $v['icon'] = $v['icon'] ?: $this->contactIcon($v['type']);
        $contact->update($v);

        return back()->with('success', 'Kontak berhasil diperbarui.');
    }

    /**
     * Hapus Kontak dari Database
     */
    public function destroyContact(int $id)
    {
        $contact = SiteSection::where('desa_id', $this->desaId())
            ->where('type', 'contact')->findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Kontak berhasil dihapus dari database.');
    }

    private function normalizeContactValue(string $type, string $value): ?string
    {
        $value = trim($value);
        if ($value === '') return null;

        if ($type === 'whatsapp') {
            $number = preg_replace('/[^0-9]/', '', $value);
            if (str_starts_with($number, '0')) $number = '62' . substr($number, 1);
            elseif (str_starts_with($number, '8')) $number = '62' . $number;
            if (!preg_match('/^62[0-9]{8,15}$/', $number)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'url' => 'Nomor WhatsApp tidak valid. Contoh: 081234567890.'
                ]);
            }
            return 'https://wa.me/' . $number;
        }

        if ($type === 'phone') {
            $number = preg_replace('/[^0-9+]/', '', $value);
            if (strlen(preg_replace('/[^0-9]/', '', $number)) < 7) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'url' => 'Nomor telepon tidak valid.'
                ]);
            }
            return $number;
        }

        if ($type === 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'url' => 'Alamat email tidak valid.'
                ]);
            }
            return $value;
        }

        if (in_array($type, ['instagram','facebook','youtube','tiktok','website','other'], true)) {
            return preg_match('/^https?:\/\//i', $value) ? $value : 'https://' . $value;
        }

        return $value;
    }

    private function contactIcon(string $type): string
    {
        return [
            'whatsapp' => '💬', 'instagram' => '📷', 'facebook' => '📘',
            'youtube' => '▶️', 'tiktok' => '🎵', 'email' => '✉️',
            'website' => '🌐', 'phone' => '📞', 'address' => '📍',
            'other' => '🔗',
        ][$type] ?? '🔗';
    }

    public function destroy(int $id)
    {
        $section = SiteSection::where('desa_id', $this->desaId())->findOrFail($id);
        $section->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    private function parseFields($raw): ?array
    {
        if (is_array($raw)) return $raw;
        if (!is_string($raw) || trim($raw) === '') return null;
        $decoded = json_decode($raw, true);
        if (!is_array($decoded)) return null;

        return array_values(array_filter($decoded, function ($field) {
            $name = is_array($field) ? ($field['name'] ?? '') : '';
            return $name !== 'nik';
        }));
    }

    private function parseRequirements(string $raw): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $raw))));
    }

    private function defaultFields(string $title): array
    {
        $base = [
            ['name'=>'nama','label'=>'Nama Lengkap','type'=>'text','required'=>true],
            ['name'=>'no_hp','label'=>'No. HP / WhatsApp','type'=>'text','required'=>true],
        ];

        $map = [
            'usaha' => [['name'=>'nama_usaha','label'=>'Nama Usaha','type'=>'text','required'=>true],['name'=>'alamat_usaha','label'=>'Alamat Usaha','type'=>'textarea','required'=>true]],
            'domisili' => [['name'=>'alamat','label'=>'Alamat Domisili','type'=>'textarea','required'=>true]],
            'tidak mampu' => [['name'=>'penghasilan','label'=>'Penghasilan per Bulan','type'=>'text','required'=>true],['name'=>'alasan','label'=>'Alasan Pengajuan','type'=>'textarea','required'=>true]],
            'kelahiran' => [['name'=>'nama_bayi','label'=>'Nama Bayi','type'=>'text','required'=>true],['name'=>'tanggal_lahir','label'=>'Tanggal Lahir','type'=>'date','required'=>true]],
            'kematian' => [['name'=>'nama_almarhum','label'=>'Nama Almarhum','type'=>'text','required'=>true],['name'=>'tanggal_meninggal','label'=>'Tanggal Meninggal','type'=>'date','required'=>true]],
        ];

        foreach ($map as $needle => $fields) {
            if (stripos($title, $needle) !== false) return array_merge($base, $fields);
        }

        return array_merge($base, [['name'=>'keperluan','label'=>'Keperluan','type'=>'textarea','required'=>true]]);
    }
    /**
     * Update Nomor WhatsApp Petugas Pelayanan
     */
    public function updateWhatsapp(Request $request)
    {
        $request->validate([
            'no_whatsapp' => 'required|string|max:30',
        ]);

        $desaId = session('desa_id', 1);

        \Illuminate\Support\Facades\DB::table('isi_situs')->updateOrInsert(
            ['desa_id' => $desaId, 'key' => 'no_whatsapp'],
            ['value' => $request->no_whatsapp, 'updated_at' => now()]
        );

        return redirect()->back()->with('success', 'Nomor WhatsApp petugas pelayanan berhasil diperbarui!');
    }
}
    