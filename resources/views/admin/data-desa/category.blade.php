@extends('layouts.admin')

@section('title', $config['title'])

@push('styles')
<style>
.admin-category-hero{display:flex;justify-content:space-between;align-items:center;gap:20px;padding:26px;border-radius:22px;background:linear-gradient(135deg,#0f766e,#155e75);color:#fff;margin-bottom:22px}
.admin-category-hero h1{margin:4px 0}.admin-category-hero p{margin:0;opacity:.9}.admin-category-icon{font-size:54px}
.admin-category-layout{display:grid;grid-template-columns:1.05fr .95fr;gap:22px}.admin-category-card{background:#fff;border:1px solid #e5e7eb;border-radius:20px;padding:24px;box-shadow:0 12px 30px #0000000a}
.admin-category-fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:15px}.admin-category-field{display:flex;flex-direction:column;gap:7px}.admin-category-field span{font-weight:700;font-size:.9rem}.admin-category-field input,.admin-category-field textarea,.admin-category-field select{width:100%;box-sizing:border-box;border:1px solid #d7dfdf;border-radius:12px;padding:11px 13px;background:#fff}.admin-category-chart{height:390px;position:relative}
.admin-category-tabs{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px}.admin-category-tabs a{padding:9px 13px;border-radius:999px;background:#f1f5f5;text-decoration:none;color:#334}.admin-category-tabs a.active{background:#0f766e;color:#fff}
@media(max-width:900px){.admin-category-layout{grid-template-columns:1fr}}@media(max-width:600px){.admin-category-fields{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<div class="admin-page-header">
    <div>
        <span class="section-label">PENGELOLAAN DATA</span>
        <h1>{{ $config['icon'] }} {{ $config['title'] }}</h1>
        <p>{{ $config['description'] }}</p>
    </div>
    <a href="{{ route('data-desa.category',$category) }}" target="_blank" class="admin-btn admin-btn-secondary">Lihat Halaman User ↗</a>
</div>

@if(session('success'))<div class="admin-alert admin-alert-success">{{ session('success') }}</div>@endif
@if($errors->any())
<div class="admin-alert admin-alert-error"><strong>Data belum dapat disimpan:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<div class="admin-category-tabs">
    <a href="{{ route('admin.data-desa') }}">📊 Ringkasan</a>
    <a href="{{ route('admin.data-desa.category','penduduk') }}" class="{{ $category==='penduduk'?'active':'' }}">👥 Penduduk</a>
    <a href="{{ route('admin.data-desa.category','pendidikan') }}" class="{{ $category==='pendidikan'?'active':'' }}">🎓 Pendidikan</a>
    <a href="{{ route('admin.data-desa.category','pekerjaan') }}" class="{{ $category==='pekerjaan'?'active':'' }}">💼 Pekerjaan</a>
    <a href="{{ route('admin.data-desa.category','sosial') }}" class="{{ $category==='sosial'?'active':'' }}">🤝 Sosial</a>
    <a href="{{ route('admin.data-desa.category','fasilitas') }}" class="{{ $category==='fasilitas'?'active':'' }}">🏫 Fasilitas</a>
    <a href="{{ route('admin.data-desa.category','umur') }}" class="{{ $category==='umur'?'active':'' }}">👶 Umur</a>
    <a href="{{ route('admin.data-desa.category','agama') }}" class="{{ $category==='agama'?'active':'' }}">🕌 Agama</a>
</div>
<div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px"><a class="admin-btn admin-btn-secondary" href="{{ route('admin.data-desa.export',['format'=>'csv','year'=>$selectedYear]) }}">⬇ CSV {{ $selectedYear }}</a><a class="admin-btn admin-btn-secondary" href="{{ route('admin.data-desa.export',['format'=>'pdf','year'=>$selectedYear]) }}">⬇ PDF {{ $selectedYear }}</a></div>

<div class="admin-category-layout">
    <form method="POST" action="{{ route('admin.data-desa.category.update',$category) }}" class="admin-category-card">
        @csrf
        <h2>Input {{ $config['title'] }}</h2>
        <p>Data yang disimpan akan menjadi snapshot untuk tahun yang dipilih dan otomatis digunakan oleh grafik halaman user.</p>

        <div class="admin-category-fields">
            <label class="admin-category-field"><span>Tahun Data</span><input type="number" name="tahun_data" min="2000" max="2100" value="{{ old('tahun_data',$selectedYear) }}" required></label>
            @foreach($config['fields'] as $field=>$label)
                <label class="admin-category-field">
                    <span>{{ $label }}</span>
                    <input type="number" name="{{ $field }}" min="0" step="{{ $field==='luas_wilayah'?'0.01':'1' }}" value="{{ old($field,$displayStats[$field]??0) }}" required>
                </label>
            @endforeach
        </div>

        <label class="admin-category-field" style="margin-top:15px">
            <span>Catatan</span>
            <textarea name="catatan" rows="4">{{ old('catatan',$displayStats['catatan']??'') }}</textarea>
        </label>

        <button class="admin-btn admin-btn-primary" type="submit" style="margin-top:18px">💾 Simpan {{ $config['title'] }}</button>
    </form>

    <div class="admin-category-card">
        <span class="section-label">PREVIEW GRAFIK</span>
        <h2>{{ $config['title'] }} — {{ $selectedYear }}</h2>
        <p>Preview menggunakan data yang sedang dipilih.</p>
        <div class="admin-category-chart"><div id="adminCategoryChart"></div></div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/data-charts.js') }}"></script>
<script>
const labels=@json(array_values($config['fields']));
const values=@json(array_map(fn($field)=>(float)($displayStats[$field]??0),array_keys($config['fields'])));
if(@json($config['chart'])==='donut') DesaCharts.donut(document.getElementById('adminCategoryChart'),labels,values); else DesaCharts.bar(document.getElementById('adminCategoryChart'),labels,values);
</script>
@endpush
