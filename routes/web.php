<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminSiteContentController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\SiteSectionController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\DesaProfileController;
use App\Http\Controllers\VillagePageController;
use App\Http\Controllers\Admin\DesaProfileSectionController;
use App\Http\Controllers\Admin\DesaStatisticController;
use App\Http\Controllers\AdminSectionController;
use App\Http\Controllers\VillageHeadController;
use App\Http\Controllers\DesaStructureController;
use App\Http\Controllers\KontakController;


/*
|--------------------------------------------------------------------------
| WEBSITE PUBLIK
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// TEST ROUTE
Route::get('/test-desa-profile', function() {
    return response()->json(['status' => 'OK', 'message' => 'Routes working']);
});

// TEST PUBLIC PROFILE
Route::get('/debug-profil-desa', function() {
    $desa = \App\Models\DesaProfile::first();
    if (!$desa) {
        return response()->json(['error' => 'No DesaProfile found'], 404);
    }
    $sections = \App\Models\DesaProfileSection::where('desa_profile_id', $desa->id)
        ->orderBy('order')
        ->get();
    return response()->json([
        'desa_id' => $desa->id,
        'desa_name' => $desa->name,
        'total_sections' => $sections->count(),
        'sections' => $sections->map(function($s) {
            return [
                'id' => $s->id,
                'type' => $s->section_type,
                'is_active' => $s->is_active,
                'content' => substr($s->content ?? '', 0, 50),
                'image' => $s->image
            ];
        })
    ]);
});

/*
|--------------------------------------------------------------------------
| PROFIL DESA
|--------------------------------------------------------------------------
*/

Route::get('/profil-desa', [HomeController::class,'profile'])->name('profil');
Route::get('/profil/{slug}', [VillagePageController::class,'profile'])->name('profil.page');


/*
|--------------------------------------------------------------------------
| DATA DESA - USER
|--------------------------------------------------------------------------
*/

Route::get('/data-desa', [DataDesaController::class,'index'])->name('data-desa');
Route::get('/data-desa/export-excel', [DataDesaController::class, 'exportExcel'])->name('data-desa.export-excel');
Route::get('/data-desa/export/{format}', [DataDesaController::class,'export'])->whereIn('format',['csv','pdf'])->name('data-desa.export');
Route::get('/data-desa/tahunan', [DataDesaController::class,'yearly'])->name('data-desa.yearly');
Route::get('/data-desa/{category}', [DataDesaController::class,'category'])
    ->whereIn('category', ['perumahan','jaminan_sosial','sosial_demografis','penduduk','pendidikan','pekerjaan','sosial','fasilitas','umur','agama'])
    ->name('data-desa.category');
Route::get('/data/{slug}', [VillagePageController::class,'data'])->name('data.page');


/*
|--------------------------------------------------------------------------
| LAYANAN - USER
|--------------------------------------------------------------------------
*/

Route::get('/layanan', [SiteSectionController::class, 'services'])->name('layanan');
Route::get('/layanan/{id}', [SiteSectionController::class, 'service'])->whereNumber('id')->name('layanan.show');


/*
|--------------------------------------------------------------------------
| PENGAJUAN SURAT - USER
|--------------------------------------------------------------------------
*/

Route::post('/layanan/pengajuan-surat', [SiteSectionController::class, 'submitLetterRequest'])->name('layanan.pengajuan-surat');
Route::get('/layanan/status', [SiteSectionController::class, 'status'])->name('layanan.status');
Route::post('/layanan/status', [SiteSectionController::class, 'checkStatus'])->name('layanan.status.check');
Route::post('/admin/layanan/whatsapp', [SiteSectionController::class, 'updateWhatsapp'])->name('admin.layanan.whatsapp.update');


/*
|--------------------------------------------------------------------------
| PUBLIKASI & BERITA - USER
|--------------------------------------------------------------------------
*/

Route::get('/publikasi', [PublicationController::class, 'index'])->name('publikasi');
Route::get('/berita', [PublicationController::class, 'news'])->name('berita');

Route::get('/publikasi/export/{format}', [PublicationController::class,'export'])->whereIn('format',['csv','pdf'])->name('publikasi.export');
Route::get('/publikasi/{publication}/download', [PublicationController::class,'downloadFile'])->name('publikasi.download');
Route::get('/publikasi/{publication}', [PublicationController::class,'show'])->name('publikasi.show');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // 🛠️ Rute Halaman Tambah Berita (admin/berita/berita-create.blade.php):
    Route::get('/berita/create', function() {
        return view('admin.berita.berita-create');
    })->name('berita.create');

});


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::get('/test-admin-desa-sections', [DesaProfileSectionController::class,'index'])->name('test.desa-profile-sections');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function(){ 
    
    // Desa Profiles
    Route::get('/desa-profiles',[DesaProfileController::class,'admin'])->name('desa-profiles'); 
    Route::post('/desa-profiles',[DesaProfileController::class,'save'])->name('desa-profiles.save'); 
    Route::post('/desa-profiles/switch',[DesaProfileController::class,'switch'])->name('desa-profiles.switch');
    
    // Desa Profile Sections
    Route::get('/desa-profile-sections',[DesaProfileSectionController::class,'index'])->name('desa-profile-sections.index');
    Route::put('/desa-profile-sections/{id}',[DesaProfileSectionController::class,'update'])->name('desa-profile-sections.update');
    Route::patch('/desa-profile-sections/{id}/toggle',[DesaProfileSectionController::class,'toggleActive'])->name('desa-profile-sections.toggle-active');
    Route::post('/desa-profile-sections/reorder',[DesaProfileSectionController::class,'reorder'])->name('desa-profile-sections.reorder');
    
    // Dashboard
    Route::get('/', [AdminSiteContentController::class,'dashboard'])->name('dashboard');
    
    // Logout
    Route::post('/logout', [AdminAuthController::class,'logout'])->name('logout');
    
    // Data Website
    Route::get('/site-data', [AdminSiteContentController::class,'index'])->name('site-data');
    Route::post('/site-data', [AdminSiteContentController::class,'store'])->name('site-data.store');
    
    // Pages
    Route::get('/pages', [VillagePageController::class,'adminIndex'])->name('pages.index');
    Route::get('/pages/create', [VillagePageController::class,'create'])->name('pages.create');
    Route::post('/pages', [VillagePageController::class,'store'])->name('pages.store');
    Route::get('/pages/{page}/edit', [VillagePageController::class,'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [VillagePageController::class,'update'])->name('pages.update');
    Route::delete('/pages/{page}', [VillagePageController::class,'destroy'])->name('pages.destroy');
    
    // Legacy sections compatibility
    Route::get('/sections', [AdminSectionController::class,'index'])->name('sections');
    Route::post('/sections', [AdminSectionController::class,'store'])->name('sections.store');
    Route::delete('/sections/{id}', [AdminSectionController::class,'destroy'])->name('sections.destroy');

    // Data Desa
    Route::get('/data-desa/statistics', [DesaStatisticController::class,'index'])->name('data-desa.statistics');
    Route::post('/data-desa/statistics', [DesaStatisticController::class,'update'])->name('data-desa.statistics.update');
    Route::get('/data-desa', [DataDesaController::class,'admin'])->name('data-desa');
    Route::get('/data-desa/tahunan', [DataDesaController::class,'adminYearly'])->name('data-desa.yearly');
    Route::get('/data-desa/{category}', [DataDesaController::class,'adminCategory'])
        ->whereIn('category', ['perumahan','jaminan_sosial','sosial_demografis','penduduk','pendidikan','pekerjaan','sosial','fasilitas','umur','agama'])
        ->name('data-desa.category');
    Route::post('/data-desa', [DataDesaController::class,'updateStatistics'])->name('data-desa.update');
    Route::get('/data-desa/export/{format}', [DataDesaController::class,'export'])->whereIn('format',['csv','pdf'])->name('data-desa.export');
    Route::post('/data-desa/{category}', [DataDesaController::class,'updateCategory'])
        ->whereIn('category', ['perumahan','jaminan_sosial','sosial_demografis','penduduk','pendidikan','pekerjaan','sosial','fasilitas','umur','agama'])
        ->name('data-desa.category.update');
    Route::post('/data-desa/wilayah', [DataDesaController::class,'storeVillage'])->name('data-desa.wilayah.store');
    Route::delete('/data-desa/wilayah/{id}', [DataDesaController::class,'destroyVillage'])->name('data-desa.wilayah.destroy');
    Route::delete('/data-desa/riwayat/{id}', [DataDesaController::class,'destroyHistory'])->name('data-desa.riwayat.destroy');

    // Layanan & Pengajuan (ADMIN)
    Route::get('/layanan', [SiteSectionController::class,'adminServices'])->name('layanan');
    Route::post('/layanan', [SiteSectionController::class,'storeService'])->name('layanan.store');
    Route::put('/layanan/{id}', [SiteSectionController::class,'updateService'])->name('layanan.update');
    Route::patch('/layanan/{id}/toggle', [SiteSectionController::class,'toggleService'])->name('layanan.toggle');
    Route::delete('/layanan/{id}', [SiteSectionController::class,'destroyService'])->name('layanan.destroy'); // 🟢 SEKARANG RESMI dikoordinasi admin.layanan.destroy

    Route::get('/pengajuan', [SiteSectionController::class,'adminRequests'])->name('pengajuan.index');
    Route::put('/pengajuan/{id}', [SiteSectionController::class,'updateLetterRequest'])->name('pengajuan.update');
    Route::put('/layanan/pengajuan/{id}', [SiteSectionController::class,'updateLetterRequest'])->name('layanan.pengajuan.update');    
    Route::delete('/sections/{id}', [SiteSectionController::class,'destroy'])->name('sections.destroy');
    
    // Publikasi & Berita (Admin)
    Route::get('/publikasi', [PublicationController::class,'adminIndex'])->name('publikasi.index');
    Route::get('/berita', [PublicationController::class,'adminNews'])->name('berita.index');
    Route::get('/publikasi/create', [PublicationController::class,'create'])->name('publikasi.create');
    Route::post('/publikasi', [PublicationController::class,'store'])->name('publikasi.store');
    Route::get('/publikasi/{publication}/edit', [PublicationController::class,'edit'])->name('publikasi.edit');
    Route::put('/publikasi/{publication}', [PublicationController::class,'update'])->name('publikasi.update');
    Route::delete('/publikasi/{publication}', [PublicationController::class,'destroy'])->name('publikasi.destroy');

    // Profil Kepala Desa
    Route::get('/profil-kepala-desa', [VillageHeadController::class, 'adminIndex'])->name('profil-kepala-desa');
    Route::post('/profil-kepala-desa', [VillageHeadController::class, 'store'])->name('profil-kepala-desa.store');
    Route::put('/profil-kepala-desa/{head}', [VillageHeadController::class, 'update'])->name('profil-kepala-desa.update');
    Route::delete('/profil-kepala-desa/{head}', [VillageHeadController::class, 'destroy'])->name('profil-kepala-desa.destroy');
    
});

/*
|--------------------------------------------------------------------------
| PROFIL KEPALA DESA - USER
|--------------------------------------------------------------------------
*/

Route::get('/profil/profil-kepala-desa', [VillageHeadController::class, 'publicIndex'])->name('profil.kepala-desa');

/*
|--------------------------------------------------------------------------
| KONTAK - USER & ADMIN
|--------------------------------------------------------------------------
*/

// ROUTE PUBLIK USER
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// ROUTE ADMIN PANEL
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/kontak', [KontakController::class, 'adminIndex'])->name('kontak.index');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
    Route::put('/kontak/{id}', [KontakController::class, 'update'])->name('kontak.update');
    Route::delete('/kontak/{id}', [KontakController::class, 'destroy'])->name('kontak.destroy');
});

/*
|--------------------------------------------------------------------------
| PERANGKAT DESA / STRUKTUR ORGANISASI
|--------------------------------------------------------------------------
*/

Route::get('/perangkat-desa', function () {
    return redirect()->route('profil');
})->name('perangkat-desa');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/perangkat-desa', [DesaStructureController::class, 'adminIndex'])->name('perangkat-desa.index');
    Route::post('/perangkat-desa', [DesaStructureController::class, 'store'])->name('perangkat-desa.store');
    Route::put('/perangkat-desa/{structure}', [DesaStructureController::class, 'update'])->name('perangkat-desa.update');
    Route::patch('/perangkat-desa/{structure}/toggle', [DesaStructureController::class, 'toggle'])->name('perangkat-desa.toggle');
    Route::delete('/perangkat-desa/{structure}', [DesaStructureController::class, 'destroy'])->name('perangkat-desa.destroy');
});

Route::delete('/data-desa/file', [DataDesaController::class, 'destroyFile'])->name('admin.data-desa.file.destroy');
