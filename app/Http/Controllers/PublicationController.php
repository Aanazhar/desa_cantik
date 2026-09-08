<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicationController extends Controller
{
    /**
     * ID Desa Aktif
     */
    protected function desaId(): int
    {
        return session('desa_id', 1);
    }

    /**
     * KATEGORI RESMI PUBLIKASI DESA
     */
    protected function officialPublicationCategories()
    {
        return collect(['Publikasi', 'Infografis', 'Monografis']);
    }

    /**
     * 1. Halaman Publik Publikasi & Dokumen Desa (User)
     */
    public function index(Request $request)
    {
        $categories = $this->officialPublicationCategories();

        $query = Publication::where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('category')
                  ->orWhereRaw('LOWER(category) != ?', ['berita']);
            });

        if ($request->filled('category')) {
            $query->where('category', $request->string('category')->toString());
        }

        $publikasi = $query->latest('published_at')->paginate(9)->withQueryString();

        $viewName = view()->exists('publikasi') ? 'publikasi' : 'publikasi.index';

        return view($viewName, compact('publikasi', 'categories'));
    }

    /**
     * 2. Halaman Publik Khusus Berita Desa (User)
     */
    public function news(Request $request)
    {
        $query = Publication::where('status', 'published')
            ->whereRaw('LOWER(category) = ?', ['berita']);

        $publikasi = $query->latest('published_at')->paginate(9)->withQueryString();

        $viewName = view()->exists('berita') ? 'berita' : (view()->exists('publikasi') ? 'publikasi' : 'publikasi.index');

        return view($viewName, [
            'publikasi'       => $publikasi,
            'categories'      => collect(['Berita']),
            'pageTitle'       => 'Berita Desa',
            'pageDescription' => 'Kabar, kegiatan, program, dan informasi terbaru dari Pemerintah Desa.',
            'isNews'          => true,
        ]);
    }

    /**
     * 3. Halaman Detail Publikasi (User Warga) - DIJAMIN TAMPILAN BARU RAPI
     */
    public function show($publication)
    {
        if (!$publication instanceof Publication) {
            $id = is_array($publication) ? ($publication['id'] ?? $publication) : $publication;
            
            $publication = Publication::where('id', $id)
                ->orWhere('slug', $id)
                ->firstOrFail();
        }

        if (view()->exists('publikasi.show')) {
            return view('publikasi.show', compact('publication'));
        }
        if (view()->exists('publikasi-show')) {
            return view('publikasi-show', compact('publication'));
        }

        return view('publikasi.show', compact('publication'));
    }

    /**
     * 4. Halaman Admin Kelola Publikasi (Admin)
     */
    public function adminIndex(Request $request)
    {
        $categories = $this->officialPublicationCategories();

        $query = Publication::where(function ($q) {
                $q->whereNull('category')
                  ->orWhereRaw('LOWER(category) != ?', ['berita']);
            })
            ->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->string('category')->toString());
        }

        $publikasi = $query->paginate(15)->withQueryString();
        
        $possibleViews = ['admin.publikasi.index', 'admin.publikasi'];
        $viewName = 'admin.publikasi';
        foreach ($possibleViews as $v) {
            if (view()->exists($v)) {
                $viewName = $v;
                break;
            }
        }

        return view($viewName, compact('publikasi', 'categories'));
    }

    /**
     * 5. Halaman Admin Khusus Kelola Berita Desa (Admin)
     */
    public function adminNews(Request $request)
    {
        $query = Publication::whereRaw('LOWER(category) = ?', ['berita'])
            ->latest();

        $publikasi = $query->paginate(15)->withQueryString();

        $categories = collect(['Berita']);

        return view('admin.berita.berita', compact('publikasi', 'categories'));
    }

    /**
     * 6. Form Tambah Publikasi Baru
     */
    public function create()
    {
        $categories = $this->officialPublicationCategories();
        
        $possibleViews = ['admin.publikasi.create', 'admin.publikasi-create', 'admin.publikasi'];
        $viewName = 'admin.publikasi-create';
        foreach ($possibleViews as $v) {
            if (view()->exists($v)) {
                $viewName = $v;
                break;
            }
        }

        return view($viewName, compact('categories'));
    }

    /**
     * 7. Simpan Konten Baru Ke Database
     */
    public function store(Request $request)
    {
        $v = $this->validatePub($request);
        $v['desa_id']      = $this->desaId();
        $v['slug']         = Str::slug($v['title']) . '-' . Str::lower(Str::random(5));
        $v['published_at'] = $v['status'] === 'published' ? now() : null;

        if ($request->hasFile('image')) {
            $v['image'] = $this->upload($request->file('image'));
        }

        if ($request->hasFile('file')) {
            $fileObj  = $request->file('file');
            $fileName = $fileObj->getClientOriginalName();
            $fileType = $fileObj->getClientMimeType();
            $fileSize = $fileObj->getSize();

            $filePath = $this->upload($fileObj);
            
            $v['file']      = $filePath;
            $v['file_path'] = $filePath;
            $v['file_name'] = $fileName;
            $v['file_type'] = $fileType;
            $v['file_size'] = $fileSize;
        }

        Publication::create($v);

        if (strtolower($v['category'] ?? '') === 'berita') {
            return redirect()->route('admin.berita.index')->with('success', 'Berita desa berhasil ditambahkan.');
        }

        return redirect()->route('admin.publikasi.index')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    /**
     * 8. Form Edit Publikasi (TARIK DATA ASLI DATABASE BY ID/SLUG)
     */
    public function edit($publication)
    {
        if (!$publication instanceof Publication) {
            $publication = Publication::where('id', $publication)
                ->orWhere('slug', $publication)
                ->firstOrFail();
        }

        $categories = $this->officialPublicationCategories();

        $possibleViews = ['admin.publikasi.edit', 'admin.publikasi-edit'];
        $viewName = 'admin.publikasi.edit';
        foreach ($possibleViews as $v) {
            if (view()->exists($v)) {
                $viewName = $v;
                break;
            }
        }

        return view($viewName, compact('publication', 'categories'));
    }

    /**
     * 9. Update Konten di Database (JANGAN TIMPA FILE LAMA JIKA TIDAK PILIH FILE BARU)
     */
    public function update(Request $request, $publication)
    {
        if (!$publication instanceof Publication) {
            $publication = Publication::where('id', $publication)
                ->orWhere('slug', $publication)
                ->firstOrFail();
        }

        $v = $this->validatePub($request);
        $v['published_at'] = $v['status'] === 'published' ? ($publication->published_at ?? now()) : null;

        if ($request->hasFile('image')) {
            $this->delete($publication->image);
            $v['image'] = $this->upload($request->file('image'));
        } else {
            unset($v['image']);
        }

        if ($request->hasFile('file')) {
            $fileObj  = $request->file('file');
            $fileName = $fileObj->getClientOriginalName();
            $fileType = $fileObj->getClientMimeType();
            $fileSize = $fileObj->getSize();

            $this->delete($publication->file ?? $publication->file_path);
            $filePath = $this->upload($fileObj);

            $v['file']      = $filePath;
            $v['file_path'] = $filePath;
            $v['file_name'] = $fileName;
            $v['file_type'] = $fileType;
            $v['file_size'] = $fileSize;
        } else {
            unset($v['file'], $v['file_path'], $v['file_name'], $v['file_type'], $v['file_size']);
        }

        $publication->update($v);

        if (strtolower($v['category'] ?? '') === 'berita') {
            return redirect()->route('admin.berita.index')->with('success', 'Berita desa diperbarui.');
        }

        return redirect()->route('admin.publikasi.index')->with('success', 'Publikasi berhasil diperbarui.');
    }

    /**
     * 10. Hapus Konten dari Database
     */
    public function destroy($publication)
    {
        if (!$publication instanceof Publication) {
            $publication = Publication::where('id', $publication)
                ->orWhere('slug', $publication)
                ->firstOrFail();
        }

        $this->delete($publication->image);
        $this->delete($publication->file ?? $publication->file_path);
        $publication->delete();

        return back()->with('success', 'Konten berhasil dihapus.');
    }

    /**
     * 11. Download Lampiran File
     */
    public function downloadFile($publication)
    {
        if (!$publication instanceof Publication) {
            $publication = Publication::where('id', $publication)
                ->orWhere('slug', $publication)
                ->firstOrFail();
        }

        $filePath = $publication->file ?: $publication->file_path;
        abort_unless($filePath, 404);

        $fullPath = public_path(ltrim($filePath, '/'));
        abort_unless(file_exists($fullPath), 404);

        return response()->download($fullPath, $publication->file_name ?? null);
    }

    /**
     * 12. Export Data Ke CSV / PDF
     */
    public function export(Request $request, string $format)
    {
        $items = Publication::where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('category')
                  ->orWhereRaw('LOWER(category) != ?', ['berita']);
            })
            ->latest('published_at')
            ->get();

        if ($format === 'csv') {
            return response()->streamDownload(function () use ($items) {
                $o = fopen('php://output', 'w');
                fputcsv($o, ['Judul', 'Kategori', 'Tanggal', 'Ringkasan']);
                foreach ($items as $p) {
                    fputcsv($o, [$p->title, $p->category, $p->published_at?->format('Y-m-d'), $p->excerpt]);
                }
                fclose($o);
            }, 'publikasi.csv', ['Content-Type' => 'text/csv']);
        }

        return redirect()->back()->with('error', 'Format PDF belum tersedia.');
    }

    /* =========================================================
       HELPER FUNCTIONS (VALIDATION & FILE UPLOAD)
       ========================================================= */

    private function validatePub(Request $r): array
    {
        return $r->validate([
            'title'    => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'excerpt'  => 'nullable|string|max:1000',
            'content'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
            'file'     => 'nullable|file|mimes:pdf,csv,xls,xlsx,doc,docx,zip|max:20480',
            'status'   => 'required|in:draft,published',
        ]);
    }

    private function upload($file): string
    {
        $dir = public_path('uploads');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = time() . '_' . Str::random(6) . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $name);

        return '/uploads/' . $name;
    }

    private function delete($path): void
    {
        if ($path && str_starts_with($path, '/uploads/')) {
            $p = public_path(ltrim($path, '/'));
            if (is_file($p)) {
                @unlink($p);
            }
        }
    }
}