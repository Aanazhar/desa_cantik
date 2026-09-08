@extends('layouts.admin')

@section('title', 'Profil Kepala Desa')

@section('content')

<div class="admin-page">

    {{-- HEADER --}}
    <div class="admin-page-header">

        <div>
            <span class="section-label">
                PROFIL DESA
            </span>

            <h1>
                Riwayat Kepala Desa
            </h1>

            <p>
                Kelola profil Kepala Desa dari setiap periode pemerintahan.
            </p>
        </div>

    </div>


    {{-- ALERT --}}
    @if(session('success'))

        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="admin-alert admin-alert-error">

            <strong>
                Terdapat kesalahan:
            </strong>

            <ul>
                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach
            </ul>

        </div>

    @endif


    {{-- FORM TAMBAH --}}
    <div class="admin-card">

        <div class="admin-card-header">

            <div>
                <h2>
                    Tambah Riwayat Kepala Desa
                </h2>

                <p>
                    Masukkan data Kepala Desa berdasarkan periode jabatannya.
                </p>
            </div>

        </div>


        <form
            action="{{ route('admin.profil-kepala-desa.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="admin-form-grid">

                {{-- NAMA --}}
                <div class="admin-form-group">

                    <label>
                        Nama Kepala Desa *
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Bapak John Doe"
                        required
                    >

                </div>


                {{-- TAHUN MULAI --}}
                <div class="admin-form-group">

                    <label>
                        Tahun Mulai Jabatan *
                    </label>

                    <input
                        type="number"
                        name="tahun_mulai"
                        value="{{ old('tahun_mulai') }}"
                        min="1900"
                        max="2100"
                        placeholder="2022"
                        required
                    >

                </div>


                {{-- TAHUN SELESAI --}}
                <div class="admin-form-group">

                    <label>
                        Tahun Selesai Jabatan
                    </label>

                    <input
                        type="number"
                        name="tahun_selesai"
                        value="{{ old('tahun_selesai') }}"
                        min="1900"
                        max="2100"
                        placeholder="2028"
                    >

                    <small>
                        Kosongkan jika masih menjabat.
                    </small>

                </div>


                {{-- PENDIDIKAN --}}
                <div class="admin-form-group">

                    <label>
                        Pendidikan
                    </label>

                    <input
                        type="text"
                        name="pendidikan"
                        value="{{ old('pendidikan') }}"
                        placeholder="S1 Administrasi Negara"
                    >

                </div>


                {{-- TEMPAT LAHIR --}}
                <div class="admin-form-group">

                    <label>
                        Tempat Lahir
                    </label>

                    <input
                        type="text"
                        name="tempat_lahir"
                        value="{{ old('tempat_lahir') }}"
                    >

                </div>


                {{-- TANGGAL LAHIR --}}
                <div class="admin-form-group">

                    <label>
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="tanggal_lahir"
                        value="{{ old('tanggal_lahir') }}"
                    >

                </div>


                {{-- FOTO --}}
                <div class="admin-form-group admin-form-full">

                    <label>
                        Foto Kepala Desa
                    </label>

                    <input
                        type="file"
                        name="foto"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <small>
                        Maksimal 2 MB. Format JPG, PNG atau WEBP.
                    </small>

                </div>


                {{-- BIOGRAFI --}}
                <div class="admin-form-group admin-form-full">

                    <label>
                        Biografi
                    </label>

                    <textarea
                        name="biografi"
                        rows="5"
                        placeholder="Tuliskan profil atau riwayat singkat Kepala Desa..."
                    >{{ old('biografi') }}</textarea>

                </div>


                {{-- VISI --}}
                <div class="admin-form-group">

                    <label>
                        Visi
                    </label>

                    <textarea
                        name="visi"
                        rows="5"
                        placeholder="Visi pada periode pemerintahan..."
                    >{{ old('visi') }}</textarea>

                </div>


                {{-- MISI --}}
                <div class="admin-form-group">

                    <label>
                        Misi
                    </label>

                    <textarea
                        name="misi"
                        rows="5"
                        placeholder="Misi pada periode pemerintahan..."
                    >{{ old('misi') }}</textarea>

                </div>


                {{-- KETERANGAN --}}
                <div class="admin-form-group admin-form-full">

                    <label>
                        Keterangan Tambahan
                    </label>

                    <textarea
                        name="keterangan"
                        rows="4"
                    >{{ old('keterangan') }}</textarea>

                </div>


                {{-- URUTAN --}}
                <div class="admin-form-group">

                    <label>
                        Urutan
                    </label>

                    <input
                        type="number"
                        name="urutan"
                        value="{{ old('urutan', 0) }}"
                        min="0"
                    >

                </div>


                {{-- AKTIF --}}
                <div class="admin-form-group admin-checkbox">

                    <label>

                        <input
                            type="checkbox"
                            name="aktif"
                            value="1"
                            checked
                        >

                        Tampilkan di halaman publik

                    </label>

                </div>

            </div>


            <div class="admin-form-actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    + Tambah Kepala Desa
                </button>

            </div>

        </form>

    </div>


    {{-- DAFTAR --}}
    <div class="admin-card">

        <div class="admin-card-header">

            <div>

                <h2>
                    Riwayat Kepala Desa
                </h2>

                <p>
                    Data yang tersimpan akan otomatis ditampilkan di halaman profil desa.
                </p>

            </div>

            <span class="admin-count">
                {{ $heads->count() }} Periode
            </span>

        </div>


        @forelse($heads as $head)

            <div class="head-admin-item">

                {{-- FOTO --}}
                <div class="head-admin-photo">

                    @if($head->foto)

                        <img
                            src="{{ asset('storage/'.$head->foto) }}"
                            alt="{{ $head->nama }}"
                        >

                    @else

                        <div class="head-photo-placeholder">
                            👤
                        </div>

                    @endif

                </div>


                {{-- DATA --}}
                <div class="head-admin-info">

                    <div class="head-admin-title">

                        <div>

                            <span class="period-badge">
                                {{ $head->periode }}
                            </span>

                            <h3>
                                {{ $head->nama }}
                            </h3>

                        </div>

                        @if($head->aktif)

                            <span class="status-badge status-active">
                                Aktif
                            </span>

                        @else

                            <span class="status-badge status-inactive">
                                Tidak Aktif
                            </span>

                        @endif

                    </div>


                    <div class="head-admin-meta">

                        @if($head->pendidikan)
                            <span>
                                🎓 {{ $head->pendidikan }}
                            </span>
                        @endif

                        @if($head->tempat_lahir)
                            <span>
                                📍 {{ $head->tempat_lahir }}
                            </span>
                        @endif

                    </div>


                    @if($head->biografi)

                        <p>
                            {{ \Illuminate\Support\Str::limit($head->biografi, 220) }}
                        </p>

                    @endif

                </div>


                {{-- ACTION --}}
                <div class="head-admin-actions">

                    <details>

                        <summary class="btn btn-small">
                            Edit
                        </summary>

                        <div class="edit-head-form">

                            <form
                                action="{{ route('admin.profil-kepala-desa.update', $head->id) }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >

                                @csrf

                                @method('PUT')


                                <div class="admin-form-grid">

                                    <div class="admin-form-group">

                                        <label>
                                            Nama
                                        </label>

                                        <input
                                            type="text"
                                            name="nama"
                                            value="{{ $head->nama }}"
                                            required
                                        >

                                    </div>


                                    <div class="admin-form-group">

                                        <label>
                                            Tahun Mulai
                                        </label>

                                        <input
                                            type="number"
                                            name="tahun_mulai"
                                            value="{{ $head->tahun_mulai }}"
                                            required
                                        >

                                    </div>


                                    <div class="admin-form-group">

                                        <label>
                                            Tahun Selesai
                                        </label>

                                        <input
                                            type="number"
                                            name="tahun_selesai"
                                            value="{{ $head->tahun_selesai }}"
                                        >

                                    </div>


                                    <div class="admin-form-group">

                                        <label>
                                            Pendidikan
                                        </label>

                                        <input
                                            type="text"
                                            name="pendidikan"
                                            value="{{ $head->pendidikan }}"
                                        >

                                    </div>


                                    <div class="admin-form-group">

                                        <label>
                                            Tempat Lahir
                                        </label>

                                        <input
                                            type="text"
                                            name="tempat_lahir"
                                            value="{{ $head->tempat_lahir }}"
                                        >

                                    </div>


                                    <div class="admin-form-group">

                                        <label>
                                            Tanggal Lahir
                                        </label>

                                        <input
                                            type="date"
                                            name="tanggal_lahir"
                                            value="{{ $head->tanggal_lahir?->format('Y-m-d') }}"
                                        >

                                    </div>


                                    <div class="admin-form-group admin-form-full">

                                        <label>
                                            Ganti Foto
                                        </label>

                                        <input
                                            type="file"
                                            name="foto"
                                            accept="image/jpeg,image/png,image/webp"
                                        >

                                    </div>


                                    <div class="admin-form-group admin-form-full">

                                        <label>
                                            Biografi
                                        </label>

                                        <textarea
                                            name="biografi"
                                            rows="5"
                                        >{{ $head->biografi }}</textarea>

                                    </div>


                                    <div class="admin-form-group">

                                        <label>
                                            Visi
                                        </label>

                                        <textarea
                                            name="visi"
                                            rows="4"
                                        >{{ $head->visi }}</textarea>

                                    </div>


                                    <div class="admin-form-group">

                                        <label>
                                            Misi
                                        </label>

                                        <textarea
                                            name="misi"
                                            rows="4"
                                        >{{ $head->misi }}</textarea>

                                    </div>


                                    <div class="admin-form-group admin-form-full">

                                        <label>
                                            Keterangan
                                        </label>

                                        <textarea
                                            name="keterangan"
                                            rows="4"
                                        >{{ $head->keterangan }}</textarea>

                                    </div>


                                    <div class="admin-form-group">

                                        <label>
                                            Urutan
                                        </label>

                                        <input
                                            type="number"
                                            name="urutan"
                                            value="{{ $head->urutan }}"
                                            min="0"
                                        >

                                    </div>


                                    <div class="admin-form-group admin-checkbox">

                                        <label>

                                            <input
                                                type="checkbox"
                                                name="aktif"
                                                value="1"
                                                @checked($head->aktif)
                                            >

                                            Tampilkan

                                        </label>

                                    </div>

                                </div>


                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Simpan Perubahan
                                </button>

                            </form>

                        </div>

                    </details>


                    <form
                        action="{{ route('admin.profil-kepala-desa.destroy', $head->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data Kepala Desa ini?')"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger btn-small"
                        >
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="empty-state">

                <div class="empty-icon">
                    👤
                </div>

                <h3>
                    Belum Ada Riwayat Kepala Desa
                </h3>

                <p>
                    Silakan tambahkan data Kepala Desa menggunakan formulir di atas.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection