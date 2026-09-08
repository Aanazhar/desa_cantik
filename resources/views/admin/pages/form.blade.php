@extends('layouts.admin')
@section('title',$page->exists?'Edit Halaman':'Tambah Halaman')
@section('content')
<div class="admin-page-header"><div><span class="section-label">KONTEN WEBSITE</span><h1>{{ $page->exists?'Edit Halaman':'Tambah Halaman' }}</h1><p>Gunakan halaman ini untuk mengatur submenu dan isi informasi desa.</p></div><a class="admin-btn admin-btn-secondary" href="{{ route('admin.pages.index') }}">← Kembali</a></div>
@if($errors->any())<div class="admin-alert admin-alert-error"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ $page->exists?route('admin.pages.update',$page):route('admin.pages.store') }}" class="admin-data-panel">@csrf @if($page->exists) @method('PUT') @endif
<div class="admin-input-grid"><label class="admin-field"><span>Kategori</span><select name="category" required>@foreach($categories as $key=>$label)<option value="{{ $key }}" @selected(old('category',$page->category)===$key)>{{ $label }}</option>@endforeach</select></label><label class="admin-field"><span>Urutan</span><input type="number" name="sort_order" min="0" value="{{ old('sort_order',$page->sort_order??0) }}"></label></div>
<label class="admin-field"><span>Judul</span><input name="title" value="{{ old('title',$page->title) }}" required></label>
<label class="admin-field"><span>Slug (opsional)</span><input name="slug" value="{{ old('slug',$page->slug) }}" placeholder="contoh: sejarah-desa"></label>
<label class="admin-field"><span>Ringkasan</span><textarea name="excerpt" rows="3">{{ old('excerpt',$page->excerpt) }}</textarea></label>
<label class="admin-field"><span>Isi Halaman</span><textarea name="body" rows="16" required>{{ old('body',$page->body) }}</textarea><small>HTML sederhana diperbolehkan, misalnya &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;, &lt;li&gt;.</small></label>
<label class="admin-field"><span>URL Gambar (opsional)</span><input name="image" value="{{ old('image',$page->image) }}" placeholder="/uploads/nama-gambar.jpg"></label>
<label class="admin-check"><input type="checkbox" name="active" value="1" @checked(old('active',$page->exists?$page->active:true))> Aktifkan halaman</label>
<div class="admin-form-actions"><button class="admin-btn admin-btn-primary">Simpan Halaman</button></div>
</form>
@endsection
