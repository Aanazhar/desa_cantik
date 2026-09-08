<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesaProfile;
use App\Models\DesaProfileSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesaProfileSectionController extends Controller
{
    public function index()
    {
        $desa_id = session('desa_id', 1);  // Default to 1 jika session kosong
        $desa = DesaProfile::findOrFail($desa_id);
        $sections = DesaProfileSection::where('desa_profile_id', $desa_id)
            ->orderBy('order')
            ->get();
        
        // Initialize missing sections
        foreach (DesaProfileSection::getAllSections() as $type) {
            if (!$sections->where('section_type', $type)->first()) {
                DesaProfileSection::create([
                    'desa_profile_id' => $desa_id,
                    'section_type' => $type,
                    'content' => '',
                    'is_active' => true,
                    'order' => count($sections)
                ]);
            }
        }
        
        $sections = DesaProfileSection::where('desa_profile_id', $desa_id)
            ->orderBy('order')
            ->get();
        
        // Add labels to sections
        $sections->each(function($section) {
            $section->label = DesaProfileSection::getSectionLabel($section->section_type);
        });
        
        return view('admin.desa-profile-sections', [
            'desa' => $desa,
            'sections' => $sections
        ]);
    }

    public function update(Request $request, $id)
    {
        $section = DesaProfileSection::findOrFail($id);
        
        $validated = $request->validate([
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($section->image && file_exists(public_path($section->image))) {
                unlink(public_path($section->image));
            }
            $validated['image'] = $this->uploadImage($request->file('image'));
        }

        $section->update($validated);

        return back()->with('success', 'Section ' . DesaProfileSection::getSectionLabel($section->section_type) . ' berhasil disimpan.');
    }

    public function toggleActive(Request $request, $id)
    {
        $section = DesaProfileSection::findOrFail($id);
        $section->is_active = !$section->is_active;
        $section->save();

        return back()->with('success', 'Status section berhasil diubah.');
    }

    public function reorder(Request $request)
    {
        $orders = $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|integer|exists:bagian_profil_desa,id',
            'orders.*.order' => 'required|integer'
        ]);

        foreach ($orders['orders'] as $item) {
            DesaProfileSection::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    private function uploadImage($file)
    {
        $dir = public_path('uploads');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        $name = time() . '_' . Str::random(6) . '_' . 
                Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . 
                '.' . $file->getClientOriginalExtension();
        
        $file->move($dir, $name);
        return '/uploads/' . $name;
    }
}
