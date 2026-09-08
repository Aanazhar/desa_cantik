<?php
namespace App\Http\Controllers;

use App\Models\VillagePage;
use App\Models\DesaProfileSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VillagePageController extends Controller
{
    /**
     * Profil Desa:
     * - Utamakan section yang dikelola dari Admin > Profil Desa.
     * - Tetap dukung VillagePage kategori profil sebagai fallback untuk
     *   instalasi lama.
     */
    public function profile(string $slug)
    {
        $sectionType = str_replace('-', '_', Str::lower($slug));

        $section = DesaProfileSection::where('desa_profile_id', $this->desaId())
            ->where('section_type', $sectionType)
            ->where('is_active', true)
            ->first();

        if ($section) {
            $desa = $this->desa();
            return view('pages.profile-section', compact('section', 'desa'));
        }

        return $this->show('profil', $slug);
    }

    public function data(string $slug)
    {
        return $this->show('data', $slug);
    }

    private function show(string $category, string $slug)
    {
        $page = VillagePage::where('desa_id', $this->desaId())
            ->where('category', $category)
            ->where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        return view('pages.show', compact('page'));
    }

    public function adminIndex(Request $request)
    {
        $query = VillagePage::where('desa_id', $this->desaId())
            ->orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('title');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $pages = $query->paginate(20)->withQueryString();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.form', [
            'page' => new VillagePage(),
            'categories' => [
                'profil' => 'Profil Desa (halaman tambahan)',
                'data' => 'Data Desa',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $v = $this->validatePage($request);
        $v['desa_id'] = $this->desaId();
        $v['slug'] = $v['slug'] ?: Str::slug($v['title']);
        $v['active'] = $request->boolean('active', true);

        VillagePage::create($v);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit(VillagePage $page)
    {
        abort_unless($page->desa_id === $this->desaId(), 404);

        return view('admin.pages.form', [
            'page' => $page,
            'categories' => [
                'profil' => 'Profil Desa (halaman tambahan)',
                'data' => 'Data Desa',
            ],
        ]);
    }

    public function update(Request $request, VillagePage $page)
    {
        abort_unless($page->desa_id === $this->desaId(), 404);

        $v = $this->validatePage($request);
        $v['slug'] = $v['slug'] ?: Str::slug($v['title']);
        $v['active'] = $request->boolean('active');

        $page->update($v);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(VillagePage $page)
    {
        abort_unless($page->desa_id === $this->desaId(), 404);

        $page->delete();

        return back()->with('success', 'Halaman berhasil dihapus.');
    }

    private function validatePage(Request $r)
    {
        return $r->validate([
            'category' => 'required|in:profil,data',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'image' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ]);
    }
}
