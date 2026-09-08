<?php

namespace App\Http\Controllers;

use App\Models\DesaProfileSection;
use App\Models\DesaStructure;
use App\Models\DesaVillage;
use App\Models\Publication;
use App\Models\SiteContent;
use App\Models\SiteSection;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $desa = $this->desa();
        $contents = SiteContent::where('desa_id', $desa->id)->pluck('value', 'key');
        $services = SiteSection::where('desa_id', $desa->id)
            ->where('type', 'service')
            ->where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->limit(6)
            ->get();
        $kontak = SiteSection::where('desa_id', $desa->id)
            ->where('type', 'contact')
            ->where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        // 🟢 AMBIL DARI TABEL BARU statistik_kependudukan
        $statistics = DB::table('statistik_kependudukan')->where('desa_id', $desa->id)->first();
        $villages = DesaVillage::where('desa_id', $desa->id)->get();
        $latestPublications = Publication::where('desa_id', $desa->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('home', compact(
            'contents', 'services', 'kontak', 'desa', 'statistics', 'villages', 'latestPublications'
        ));
    }

    public function profile()
    {
        $desa = $this->desa();
        $sections = DesaProfileSection::where('desa_profile_id', $desa->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $sections->each(function ($section) {
            $section->label = DesaProfileSection::getSectionLabel($section->section_type);
        });

        $structures = DesaStructure::where('desa_id', $desa->id)
            ->where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('profil-desa-tabbed', [
            'contents' => SiteContent::where('desa_id', $desa->id)->pluck('value', 'key'),
            'desa' => $desa,
            'sections' => $sections,
            'structures' => $structures,
        ]);
    }
}