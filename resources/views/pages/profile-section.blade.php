@extends('layouts.app')

@section('title', $section->label ?? 'Profil Desa')

@section('content')
<section class="page-hero profile-single-hero">
    <div class="container">
        <span class="section-label">PROFIL DESA</span>
        <h1>{{ $section->label }}</h1>
        <p>{{ $desa->name }}</p>
    </div>
</section>

<section class="section profile-single-section">
    <div class="container">
        <article class="content-card profile-single-card">
            @if($section->image)
                <img class="content-cover" src="{{ asset(ltrim($section->image, '/')) }}"
                     alt="{{ $section->label }}">
            @endif

            <div class="rich-content">
                @if($section->content)
                    {!! $section->content !!}
                @else
                    <div class="empty-state">
                        Informasi <strong>{{ $section->label }}</strong> belum diisi oleh administrator.
                    </div>
                @endif
            </div>
        </article>
    </div>
</section>
@endsection
