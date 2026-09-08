@extends('layouts.app')

@section('title', 'Perangkat Desa - '.($desa->name ?? 'Desa'))

@push('styles')
<style>
    .org-page{background:#f8fbff;padding-bottom:64px}
    .org-hero{position:relative;overflow:hidden;padding:58px 20px 46px;background:linear-gradient(135deg,#0f172a 0%,#134c8a 48%,#2563eb 100%);color:#fff}
    .org-hero:before,.org-hero:after{content:"";position:absolute;border:34px solid rgba(255,255,255,.07);border-radius:50%;width:330px;height:330px;transform:rotate(25deg)}
    .org-hero:before{left:-120px;top:-180px}.org-hero:after{right:-150px;bottom:-190px}
    .org-hero-inner{position:relative;z-index:1;max-width:1120px;margin:auto;text-align:center}
    .org-kicker{display:inline-flex;padding:7px 14px;border:1px solid rgba(255,255,255,.25);background:rgba(255,255,255,.1);border-radius:999px;font-size:12px;font-weight:900;letter-spacing:1.4px}
    .org-hero h1{margin:14px 0 8px;font-size:clamp(29px,4vw,50px);line-height:1.1}.org-hero p{margin:0 auto;max-width:780px;color:rgba(255,255,255,.88);line-height:1.7}
    .org-board-wrap{max-width:1240px;margin:-22px auto 0;padding:0 18px;position:relative;z-index:2}
    .org-board{background:#fff;border:1px solid #dbeafe;border-radius:24px;box-shadow:0 20px 50px rgba(15,23,42,.10);padding:30px 24px 38px;overflow-x:auto}
    .org-board-title{text-align:center;margin-bottom:32px}.org-board-title span{font-size:11px;letter-spacing:1.6px;font-weight:900;color:#166534}.org-board-title h2{margin:7px 0 5px;font-size:27px;color:#1d2a21}.org-board-title p{margin:0;color:#6b7280;font-size:13px}

    /* Setiap nomor urut = satu level. Nomor yang sama berada sejajar. */
    .org-level{position:relative;padding-top:24px;margin:0 auto 38px;min-width:0}
    .org-level:first-child{padding-top:0}
    .org-level:not(:first-child):before{content:"";position:absolute;left:50%;top:-18px;width:2px;height:42px;background:#bfdbfe;transform:translateX(-50%);border-radius:4px}
    .org-level:not(:first-child):after{content:"";position:absolute;left:var(--line-left,8%);right:var(--line-right,8%);top:24px;height:2px;background:#bfdbfe;border-radius:4px}
    .org-level-grid{display:grid;grid-template-columns:repeat(var(--count),minmax(190px,250px));justify-content:center;gap:20px;align-items:start;position:relative;max-width:1080px;margin:0 auto}
    .org-level-grid .org-card:before{content:"";position:absolute;left:50%;top:-24px;width:2px;height:24px;background:#bfdbfe;transform:translateX(-50%);border-radius:4px}
    .org-level:first-child .org-level-grid .org-card:before{display:none}
    .org-card{background:#fff;border:1px solid #bfdbfe;border-radius:12px;min-width:0;width:100%;box-shadow:0 8px 22px rgba(37,99,235,.09);position:relative;overflow:hidden;transition:transform .2s ease,box-shadow .2s ease}
    .org-card:hover{transform:translateY(-3px);box-shadow:0 14px 28px rgba(37,99,235,.14)}
    .org-card-head{background:linear-gradient(135deg,#134c8a,#2563eb);color:#fff;padding:10px 10px;text-align:center;font-weight:800;font-size:12px;text-transform:uppercase;line-height:1.25;min-height:40px;display:flex;align-items:center;justify-content:center}
    .org-card-body{display:grid;grid-template-columns:68px 1fr;min-height:84px}.org-photo{width:68px;height:84px;background:#eff6ff;border-right:1px solid #dbeafe;display:flex;align-items:center;justify-content:center;overflow:hidden}.org-photo img{width:100%;height:100%;object-fit:cover}.org-initial{font-size:21px;font-weight:900;color:#2563eb}.org-name{padding:10px 8px;display:flex;align-items:center;justify-content:center;text-align:center;font-size:13px;font-weight:800;color:#1f2937;line-height:1.3}
    .org-level:first-child .org-card{max-width:310px;margin:auto}.org-level:first-child .org-card-head{font-size:14px}
    .org-level:first-child .org-card-body{min-height:96px;grid-template-columns:76px 1fr}.org-level:first-child .org-photo{width:76px;height:96px}
    .org-empty{padding:70px 25px;text-align:center;color:#64748b}.org-empty strong{display:block;font-size:20px;color:#334155;margin-bottom:7px}
    .org-note{margin:4px auto 0;max-width:900px;text-align:center;color:#64748b;font-size:12px;line-height:1.7;background:#f8fbff;border:1px solid #dbeafe;border-radius:12px;padding:11px 14px}
    @media(max-width:850px){.org-board{padding:26px 16px 32px}.org-level-grid{grid-template-columns:repeat(var(--count),minmax(170px,220px));gap:14px}.org-card-body{grid-template-columns:62px 1fr}.org-photo{width:62px;height:80px}.org-card-body{min-height:80px}}
    @media(max-width:620px){.org-board-wrap{padding:0 8px}.org-board{border-radius:18px;padding:22px 10px 28px}.org-level{padding-top:20px;margin-bottom:30px}.org-level:not(:first-child):after,.org-level:not(:first-child):before,.org-level-grid .org-card:before{display:none}.org-level-grid{grid-template-columns:repeat(2,minmax(0,1fr))!important;gap:12px}.org-level-grid .org-card{max-width:none}.org-level:first-child .org-card{max-width:280px}.org-level:first-child .org-level-grid{grid-template-columns:1fr!important}.org-card-head{font-size:11px;padding:9px 7px}.org-card-body{grid-template-columns:56px 1fr;min-height:74px}.org-photo{width:56px;height:74px}.org-name{font-size:12px;padding:8px 6px}.org-hero{padding:50px 16px 40px}}
</style>
@endpush

@section('content')
@php
    $levels = $structures
        ->sortBy(fn($item) => [(int) $item->sort_order, (int) $item->id])
        ->groupBy(fn($item) => (int) $item->sort_order);
    $initials = fn($name) => collect(preg_split('/\s+/', trim($name)))->filter()->take(2)->map(fn($part) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($part, 0, 1)))->implode('');
@endphp

<div class="org-page">
    <section class="org-hero">
        <div class="org-hero-inner">
            <span class="org-kicker">PEMERINTAH DESA</span>
            <h1>Bagan Susunan Perangkat Desa</h1>
            <p>Struktur organisasi {{ $desa->name ?? 'desa' }} berdasarkan nomor urut yang dikelola oleh admin.</p>
        </div>
    </section>

    <div class="org-board-wrap">
        <section class="org-board">
            <div class="org-board-title">
                <span>STRUKTUR ORGANISASI DAN TATA KERJA</span>
                <h2>{{ $desa->name ?? 'Desa' }}</h2>
                <p>Nomor urut menentukan tingkatan. Nomor yang sama ditampilkan sejajar.</p>
            </div>

            @if($levels->count())
                @foreach($levels as $number => $items)
                    @php
                        $count = $items->count();
                        $lineInset = $count <= 1 ? 50 : round(50 / $count, 2);
                    @endphp
                    <div class="org-level" style="--count: {{ $count }}; --line-left: {{ $lineInset }}%; --line-right: {{ $lineInset }}%;">
                        <div class="org-level-grid">
                            @foreach($items as $item)
                                <article class="org-card">
                                    <div class="org-card-head">{{ $item->position }}</div>
                                    <div class="org-card-body">
                                        <div class="org-photo">
                                            @if($item->photo)
                                                <img src="{{ asset($item->photo) }}" alt="Foto {{ $item->name }}">
                                            @else
                                                <span class="org-initial">{{ $initials($item->name) }}</span>
                                            @endif
                                        </div>
                                        <div class="org-name">{{ $item->name }}</div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <p class="org-note"><strong>Aturan struktur:</strong> No urut 1 berada di tingkat pertama, No urut 2 berada di bawahnya, No urut 3 berada di bawah No urut 2, dan seterusnya. Jika ada dua atau lebih perangkat dengan nomor urut yang sama, semuanya otomatis berada pada tingkat yang sama dan ditampilkan sejajar.</p>
            @else
                <div class="org-empty"><strong>Data perangkat desa belum tersedia</strong>Silakan admin mengisi data melalui menu <b>Kelola Profil Desa → Perangkat Desa</b> di panel administrasi.</div>
            @endif
        </section>
    </div>
</div>
@endsection
