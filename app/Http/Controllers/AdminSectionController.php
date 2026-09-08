<?php

namespace App\Http\Controllers;

use App\Models\SiteSection;
use Illuminate\Http\Request;

class AdminSectionController extends Controller
{
    public function index()
    {
        $sections = SiteSection::where('desa_id', $this->desaId())
            ->orderBy('type')->orderBy('sort_order')->orderBy('id')->get();
        return view('admin.sections', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'string', 'max:50'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
        ]);
        $data['desa_id'] = $this->desaId();
        $data['active'] = true;
        SiteSection::create($data);
        return back()->with('success', 'Data berhasil disimpan.');
    }

    public function destroy(int $id)
    {
        SiteSection::where('desa_id', $this->desaId())->findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
