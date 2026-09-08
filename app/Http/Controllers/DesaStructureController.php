<?php

namespace App\Http\Controllers;

use App\Models\DesaStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesaStructureController extends Controller
{
    public function publicIndex()
    {
        $desa = $this->desa();

        $structures = DesaStructure::query()
            ->where('desa_id', $desa->id)
            ->where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('perangkat-desa', compact('desa', 'structures'));
    }

    public function adminIndex()
    {
        $desa = $this->desa();

        $structures = DesaStructure::query()
            ->where('desa_id', $desa->id)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.perangkat-desa.index', compact('desa', 'structures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sort_order' => ['required', 'integer', 'min:1', 'max:9999'],
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $validated['desa_id'] = $this->desaId();
        $validated['active'] = true;
        $validated['parent_id'] = null;

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadPhoto($request->file('photo'));
        }

        DesaStructure::create($validated);

        return redirect()
            ->route('admin.perangkat-desa.index')
            ->with('success', 'Perangkat desa berhasil ditambahkan.');
    }

    public function update(Request $request, DesaStructure $structure)
    {
        $this->ensureOwned($structure);

        $validated = $request->validate([
            'sort_order' => ['required', 'integer', 'min:1', 'max:9999'],
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        if ($request->hasFile('photo')) {
            $this->deletePhoto($structure->photo);
            $validated['photo'] = $this->uploadPhoto($request->file('photo'));
        }

        $structure->update($validated);

        return redirect()
            ->route('admin.perangkat-desa.index')
            ->with('success', 'Data perangkat desa berhasil diperbarui.');
    }

    public function toggle(DesaStructure $structure)
    {
        $this->ensureOwned($structure);
        $structure->update(['active' => !$structure->active]);

        return back()->with('success', 'Status perangkat desa berhasil diubah.');
    }

    public function destroy(DesaStructure $structure)
    {
        $this->ensureOwned($structure);
        $this->deletePhoto($structure->photo);
        $structure->delete();

        return back()->with('success', 'Perangkat desa berhasil dihapus.');
    }

    private function ensureOwned(DesaStructure $structure): void
    {
        abort_unless((int) $structure->desa_id === $this->desaId(), 404);
    }

    private function uploadPhoto($file): string
    {
        $directory = public_path('uploads/perangkat-desa');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $name = now()->format('YmdHis') . '_' . Str::random(8) . '_' . Str::slug(
            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
        ) . '.' . $file->getClientOriginalExtension();

        $file->move($directory, $name);

        return '/uploads/perangkat-desa/' . $name;
    }

    private function deletePhoto(?string $photo): void
    {
        if (!$photo) {
            return;
        }

        $path = public_path(ltrim($photo, '/'));

        if (is_file($path)) {
            @unlink($path);
        }
    }
}
