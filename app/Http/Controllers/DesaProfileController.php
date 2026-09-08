<?php

namespace App\Http\Controllers;

use App\Models\DesaProfile;
use App\Models\DesaProfileSection;
use App\Models\DesaStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesaProfileController extends Controller
{
    /**
     * Menampilkan halaman Admin Profil Desa
     */
    public function admin()
    {
        $desaId = $this->desaId();
        $desa   = DesaProfile::findOrFail($desaId);

        // Ambil section profil desa
        $sections = DesaProfileSection::where('desa_profile_id', $desaId)
            ->orderBy('order')
            ->get();

        // Buat section otomatis jika belum ada
        foreach (DesaProfileSection::getAllSections() as $type) {
            if (!$sections->where('section_type', $type)->first()) {
                DesaProfileSection::create([
                    'desa_profile_id' => $desaId,
                    'section_type'    => $type,
                    'content'         => '',
                    'is_active'       => true,
                    'order'           => $sections->count()
                ]);
            }
        }

        // Ambil ulang section yang sudah diperbarui
        $sections = DesaProfileSection::where('desa_profile_id', $desaId)
            ->orderBy('order')
            ->get();

        $sections->each(function ($s) {
            $s->label = DesaProfileSection::getSectionLabel($s->section_type);
        });

        // Ambil data Perangkat Desa
        $structures = DesaStructure::where('desa_id', $desaId)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.desa-profiles', [
            'profiles'   => DesaProfile::orderBy('id')->get(),
            'active'     => $desaId,
            'desa'       => $desa,
            'sections'   => $sections,
            'structures' => $structures
        ]);
    }

    /**
     * Menyimpan data Profil Utama Desa
     */
    public function save(Request $r)
    {
        $v = $r->validate([
            'id'              => 'nullable|integer|exists:profil_desa,id',
            'name'            => 'required|string|max:150',
            'code'            => 'nullable|string|max:50',
            'address'         => 'nullable|string|max:255',
            'district'        => 'nullable|string|max:150',
            'regency'         => 'nullable|string|max:150',
            'province'        => 'nullable|string|max:150',
            'description'     => 'nullable|string',
            'history'         => 'nullable|string',
            'boundaries'      => 'nullable|string',
            'vision'          => 'nullable|string',
            'mission'         => 'nullable|string',
            'head_name'       => 'nullable|string|max:150',
            'head_photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'map_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // ✅ DITAMBAHKAN VALIDASI PETA
            'structure_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'hero_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'
        ]);

        $p = isset($v['id']) && $v['id'] ? DesaProfile::findOrFail($v['id']) : new DesaProfile();
        unset($v['id']);

        // Upload berkas gambar jika ada (SUDAH DITAMBAHKAN 'map_image')
        foreach (['head_photo', 'map_image', 'structure_image', 'hero_image'] as $f) {
            if ($r->hasFile($f)) {
                $v[$f] = $this->upload($r->file($f));
            }
        }

        $p->fill($v);
        $p->is_active = true;
        $p->save();

        session(['desa_id' => $p->id]);

        return back()->with('success', 'Profil desa berhasil disimpan dan desa aktif diganti.');
    }

    /**
     * Mengganti Desa Aktif dalam Session
     */
    public function switch(Request $r)
    {
        $id = $r->validate([
            'desa_id' => 'required|exists:profil_desa,id'
        ])['desa_id'];

        session(['desa_id' => (int) $id]);

        return back()->with('success', 'Desa aktif berhasil diganti.');
    }

    /**
     * Helper protected dengan tipe kembalian :int
     */
    protected function desaId(): int
    {
        return (int) session('desa_id', 1);
    }

    /**
     * Helper protected untuk mengunggah berkas gambar
     */
    protected function upload($f)
    {
        $dir = public_path('uploads');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $n = time() . '_' . Str::random(6) . '_' . Str::slug(pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $f->getClientOriginalExtension();
        $f->move($dir, $n);

        return '/uploads/' . $n;
    }
}