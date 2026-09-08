@extends('layouts.app')

@section('title', $page->title.' - '.$activeDesa->name)

@section('content')
<section class="page-hero">
    <div class="container">
        <span class="section-label">{{ strtoupper($page->category === 'profil' ? 'PROFIL DESA' : 'DATA DESA') }}</span>
        <h1>{{ $page->title }}</h1>
        @if($page->excerpt)
            <p>{{ $page->excerpt }}</p>
        @endif
    </div>
</section>

<section class="section">
    <div class="container">
        <article class="content-card profile-single-card">
            @if($page->image)
                <img class="content-cover" src="{{ asset(ltrim($page->image,'/')) }}" alt="{{ $page->title }}">
            @endif

            <div class="rich-content">
                {!! $page->body !!}
            </div>
        </article>
    </div>
</section>
@endsection
