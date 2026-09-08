<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use App\Models\SiteSection;
use App\Models\DesaVillage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSiteContentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        // Pastikan hanya admin yang bisa masuk
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }

        // Statistik penduduk (Ambil dari tabel baru statistik_kependudukan)
        $statistics = DB::table('statistik_kependudukan')->where('desa_id', $this->desaId())->first();

        // Jumlah dusun
        $villages = DesaVillage::where('desa_id', $this->desaId())->count();

        // Jumlah layanan
        $services = SiteSection::where('desa_id', $this->desaId())->where('type', 'service')->count();

        // Jumlah kontak
        $kontak = SiteSection::where('desa_id', $this->desaId())->where('type', 'contact')->count();

        // Data website
        $contents = SiteContent::where('desa_id', $this->desaId())->pluck('value', 'key');

        return view('admin.dashboard', compact(
            'statistics',
            'villages',
            'services',
            'kontak',
            'contents'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | DATA WEBSITE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }

        $contents = SiteContent::where('desa_id', $this->desaId())->pluck('value', 'key');

        return view('admin.site-data', compact('contents'));
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA WEBSITE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }

        $data = $request->only([
            'hero_title',
            'hero_description',
            'hero_badge',
            'stat_population',
            'stat_households',
            'stat_dusun',
            'stat_potentials',
            'about_title',
            'about_description',

            'publication_badge',
            'publication_title',
            'publication_description',
            'publication_button',
            'publication_link',
        ]);

        foreach ($data as $key => $value) {
            SiteContent::updateOrCreate(
                ['desa_id' => $this->desaId(), 'key' => $key],
                ['value' => $value]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD HERO IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');

            $filename =
                time() .
                '_' .
                Str::slug(
                    pathinfo(
                        $file->getClientOriginalName(),
                        PATHINFO_FILENAME
                    )
                ) .
                '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads'),
                $filename
            );

            SiteContent::updateOrCreate(
                ['desa_id' => $this->desaId(), 'key' => 'hero_image'],
                [
                    'value' => '/uploads/' . $filename
                ]
            );
        }


        return redirect('/admin/site-data')
            ->with(
                'success',
                'Data berhasil disimpan.'
            );
    }
}