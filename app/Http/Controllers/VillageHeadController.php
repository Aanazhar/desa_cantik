<?php

namespace App\Http\Controllers;

use App\Models\DesaProfile;
use App\Models\VillageHeadHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VillageHeadController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC
    |--------------------------------------------------------------------------
    */

    public function publicIndex()
    {
        $desa = DesaProfile::query()->firstOrFail();

        $heads = VillageHeadHistory::query()
            ->where('desa_id', $desa->id)
            ->where('aktif', true)
            ->orderBy('tahun_mulai', 'desc')
            ->orderBy('urutan')
            ->get();

        return view(
            'publikasi.profil.profil-kepala-desa',
            compact('desa', 'heads')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $desa = DesaProfile::query()->firstOrFail();

        $heads = VillageHeadHistory::query()
            ->where('desa_id', $desa->id)
            ->orderBy('tahun_mulai', 'desc')
            ->orderBy('urutan')
            ->get();

        return view(
            'admin.profil-kepala-desa.index',
            compact('desa', 'heads')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $desa = DesaProfile::query()->firstOrFail();

        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'tahun_mulai' => [
                'required',
                'integer',
                'min:1900',
                'max:2100',
            ],

            'tahun_selesai' => [
                'nullable',
                'integer',
                'min:1900',
                'max:2100',
                'gte:tahun_mulai',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'pendidikan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tempat_lahir' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
            ],

            'biografi' => [
                'nullable',
                'string',
            ],

            'visi' => [
                'nullable',
                'string',
            ],

            'misi' => [
                'nullable',
                'string',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request
                ->file('foto')
                ->store('kepala-desa', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $validated['desa_id'] = $desa->id;

        $validated['aktif'] = $request->boolean(
            'aktif',
            true
        );

        $validated['urutan'] = $validated['urutan'] ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Simpan
        |--------------------------------------------------------------------------
        */

        VillageHeadHistory::create($validated);

        return redirect()
            ->route('admin.profil-kepala-desa')
            ->with(
                'success',
                'Profil Kepala Desa berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        VillageHeadHistory $head
    ) {
        $desa = DesaProfile::query()->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Pastikan data milik desa aktif
        |--------------------------------------------------------------------------
        */

        if ($head->desa_id !== $desa->id) {
            abort(404);
        }

        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'tahun_mulai' => [
                'required',
                'integer',
                'min:1900',
                'max:2100',
            ],

            'tahun_selesai' => [
                'nullable',
                'integer',
                'min:1900',
                'max:2100',
                'gte:tahun_mulai',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'pendidikan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tempat_lahir' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
            ],

            'biografi' => [
                'nullable',
                'string',
            ],

            'visi' => [
                'nullable',
                'string',
            ],

            'misi' => [
                'nullable',
                'string',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

            'urutan' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload foto baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            if ($head->foto) {
                Storage::disk('public')
                    ->delete($head->foto);
            }

            $validated['foto'] = $request
                ->file('foto')
                ->store('kepala-desa', 'public');
        }

        $validated['aktif'] = $request->boolean(
            'aktif',
            true
        );

        $validated['urutan'] = $validated['urutan'] ?? 0;

        $head->update($validated);

        return redirect()
            ->route('admin.profil-kepala-desa')
            ->with(
                'success',
                'Profil Kepala Desa berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(
        VillageHeadHistory $head
    ) {
        $desa = DesaProfile::query()->firstOrFail();

        if ($head->desa_id !== $desa->id) {
            abort(404);
        }

        if ($head->foto) {
            Storage::disk('public')
                ->delete($head->foto);
        }

        $head->delete();

        return redirect()
            ->route('admin.profil-kepala-desa')
            ->with(
                'success',
                'Profil Kepala Desa berhasil dihapus.'
            );
    }
}