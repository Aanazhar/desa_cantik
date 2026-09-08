@extends('layouts.app')

@section('title', $config['title'])

@push('styles')
<style>
.data-category-hero{padding:58px 0 40px;background:linear-gradient(135deg,#0f766e,#155e75);color:#fff}
.data-category-hero .container{display:flex;justify-content:space-between;gap:30px;align-items:center}
.data-category-eyebrow{font-size:.78rem;letter-spacing:.16em;font-weight:800;opacity:.8}
.data-category-hero h1{margin:8px 0;font-size:clamp(2rem,4vw,3.4rem)}
.data-category-hero p{max-width:720px;margin:0;opacity:.9}
.data-category-icon{font-size:76px;filter:drop-shadow(0 10px 20px #0002)}
.data-category-nav{display:flex;flex-wrap:wrap;gap:10px;margin:26px 0}
.data-category-nav a{padding:10px 15px;border:1px solid #dbe5e5;border-radius:999px;text-decoration:none;color:#31504f;background:#fff}
.data-category-nav a.active{background:#0f766e;color:#fff;border-color:#0f766e}
.data-category-layout{display:grid;grid-template-columns:1.2fr .8fr;gap:22px;align-items:stretch}
.data-category-card{background:#fff;border:1px solid #e5eeee;border-radius:22px;padding:25px;box-shadow:0 15px 40px #164e6320}
.data-category-card h2{margin:0 0 6px}
.data-category-card p{color:#667; margin-top:0}
.data-category-chart{height:380px;position:relative}
.data-category-stats{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;margin-top:20px}
.data-category-stat{padding:18px;border-radius:16px;background:#f4f8f8}
.data-category-stat span{display:block;color:#667;font-size:.85rem}
.data-category-stat strong{display:block;font-size:1.6rem;margin-top:5px;color:#0f766e}
@media(max-width:850px){.data-category-layout{grid-template-columns:1fr}.data-category-hero .container{align-items:flex-start}.data-category-icon{font-size:50px}}
</style>
@endpush

@section('content')
<section class="data-category-hero">
    <div class="container">
        <div>
            <span class="data-category-eyebrow">TRANSPARANSI DATA DESA</span>
            <h1>{{ $config['icon'] }} {{ $config['title'] }}</h1>
            <p>{{ $config['description'] }}</p>
        </div>
        <div class="data-category-icon">{{ $config['icon'] }}</div>
    </div>
</section>

<section class="section">
<div class="container">
    <nav class="data-category-nav">
        <a href="{{ route('data-desa') }}">📊 Ringkasan</a>
        <a href="{{ route('data-desa.category','penduduk') }}" class="{{ $category==='penduduk'?'active':'' }}">👥 Penduduk</a>
        <a href="{{ route('data-desa.category','pendidikan') }}" class="{{ $category==='pendidikan'?'active':'' }}">🎓 Pendidikan</a>
        <a href="{{ route('data-desa.category','pekerjaan') }}" class="{{ $category==='pekerjaan'?'active':'' }}">💼 Pekerjaan</a>
        <a href="{{ route('data-desa.category','sosial') }}" class="{{ $category==='sosial'?'active':'' }}">🤝 Sosial</a>
        <a href="{{ route('data-desa.category','fasilitas') }}" class="{{ $category==='fasilitas'?'active':'' }}">🏫 Fasilitas</a>
        <a href="{{ route('data-desa.category','umur') }}" class="{{ $category==='umur'?'active':'' }}">👶 Umur</a>
        <a href="{{ route('data-desa.category','agama') }}" class="{{ $category==='agama'?'active':'' }}">🕌 Agama</a>
    </nav>

    <div class="data-year-panel">
        <div>
            <span class="section-label">ARSIP DATA</span>
            <h2>Data Tahun {{ $selectedYear }}</h2>
            <p>Pilih tahun untuk melihat snapshot data yang tersimpan.</p>
        </div>
        <form method="GET" action="{{ route('data-desa.category',$category) }}" class="data-year-form">
            <label for="year">Tahun</label>
            <select id="year" name="year" onchange="this.form.submit()">
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ (int)$year===(int)$selectedYear?'selected':'' }}>{{ $year }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="data-download-buttons" style="margin-top:14px"><a class="btn-download" href="{{ route('data-desa.export',['format'=>'csv','year'=>$selectedYear]) }}">⬇ CSV {{ $selectedYear }}</a><a class="btn-download secondary" href="{{ route('data-desa.export',['format'=>'pdf','year'=>$selectedYear]) }}">⬇ PDF {{ $selectedYear }}</a></div>

    <div class="data-category-layout" style="margin-top:22px">
        <div class="data-category-card">
            <span class="section-label">VISUALISASI</span>
            <h2>{{ $config['title'] }}</h2>
            <p>Grafik otomatis mengambil data dari database dan berubah sesuai tahun yang dipilih.</p>
            <div class="data-category-chart"><div id="categoryChart"></div></div>
        </div>

        <div class="data-category-card">
            <span class="section-label">ANGKA UTAMA</span>
            <h2>Rincian Data</h2>
            <div class="data-category-stats">
                @foreach($config['fields'] as $field=>$label)
                    <div class="data-category-stat">
                        <span>{{ $label }}</span>
                        <strong>{{ $field==='luas_wilayah' ? number_format((float)($displayStats[$field]??0),2,',','.') : number_format((int)($displayStats[$field]??0),0,',','.') }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</section>

@push('scripts')
<script src="{{ asset('js/data-charts.js') }}"></script>
<script>
const labels=@json(array_values($config['fields']));
const values=@json(array_map(fn($field)=>(float)($displayStats[$field]??0),array_keys($config['fields'])));
if(@json($config['chart'])==='donut') DesaCharts.donut(document.getElementById('categoryChart'),labels,values); else DesaCharts.bar(document.getElementById('categoryChart'),labels,values);
</script>
@endpush
@endsection
