@extends('layouts.admin')

@section('title', 'Data Website')

@section('content')

<div class="admin-page-header">

    <div>

        <span class="admin-eyebrow">
            DATA WEBSITE
        </span>

        <h2>
            Data Website
        </h2>

        <p>
            Kelola informasi yang ditampilkan
            pada website Desa Cantik.
        </p>

    </div>

</div>


<div class="admin-card">

    <h2>
        Informasi Website
    </h2>

    <p class="admin-card-description">
        Gunakan formulir berikut untuk mengubah
        informasi halaman depan.
    </p>


    <form
        method="POST"
        action="{{ route('admin.site-data.store') }}"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="admin-grid">

            <div>

                <div class="admin-form-group">

                    <label>
                        Judul Hero
                    </label>

                    <input
                        type="text"
                        name="hero_title"
                        value="{{ old(
                            'hero_title',
                            $contents['hero_title']
                            ?? 'Selamat Datang di Desa Cantik'
                        ) }}"
                    >

                </div>


                <div class="admin-form-group">

                    <label>
                        Deskripsi Hero
                    </label>

                    <textarea
                        name="hero_description"
                    >{{ old(
                        'hero_description',
                        $contents['hero_description']
                        ?? 'Membangun desa yang maju, mandiri, transparan dan sejahtera bersama masyarakat.'
                    ) }}</textarea>

                </div>


                <div class="admin-form-group">

                    <label>
                        Badge Hero
                    </label>

                    <input
                        type="text"
                        name="hero_badge"
                        value="{{ old(
                            'hero_badge',
                            $contents['hero_badge']
                            ?? 'Website Resmi Pemerintah Desa Cantik'
                        ) }}"
                    >

                </div>

            </div>


            <div>

                <div class="admin-form-group">

                    <label>
                        Jumlah Penduduk
                    </label>

                    <input
                        type="text"
                        name="stat_population"
                        value="{{ old(
                            'stat_population',
                            $contents['stat_population']
                            ?? '4.825'
                        ) }}"
                    >

                </div>


                <div class="admin-form-group">

                    <label>
                        Jumlah Kepala Keluarga
                    </label>

                    <input
                        type="text"
                        name="stat_households"
                        value="{{ old(
                            'stat_households',
                            $contents['stat_households']
                            ?? '1.352'
                        ) }}"
                    >

                </div>


                <div class="admin-form-group">

                    <label>
                        Jumlah Dusun
                    </label>

                    <input
                        type="text"
                        name="stat_dusun"
                        value="{{ old(
                            'stat_dusun',
                            $contents['stat_dusun']
                            ?? '6'
                        ) }}"
                    >

                </div>


                <div class="admin-form-group">

                    <label>
                        Potensi Desa
                    </label>

                    <input
                        type="text"
                        name="stat_potentials"
                        value="{{ old(
                            'stat_potentials',
                            $contents['stat_potentials']
                            ?? '12'
                        ) }}"
                    >

                </div>

            </div>

        </div>


        <div class="admin-form-group">

            <label>
                Gambar Hero
            </label>

            <input
                type="file"
                name="hero_image"
                accept="image/*"
            >

        </div>


        <div class="admin-form-group">

            <label>
                Judul Tentang Desa
            </label>

            <input
                type="text"
                name="about_title"
                value="{{ old(
                    'about_title',
                    $contents['about_title']
                    ?? 'Desa Cantik yang Maju dan Berdaya'
                ) }}"
            >

        </div>


        <div class="admin-form-group">

            <label>
                Deskripsi Tentang Desa
            </label>

            <textarea
                name="about_description"
            >{{ old(
                'about_description',
                $contents['about_description']
                ?? 'Desa Cantik merupakan desa yang terus berkembang dengan semangat gotong royong dan pelayanan publik yang terbuka.'
            ) }}</textarea>

        </div>


        <div class="admin-actions">

            <button
                type="submit"
                class="admin-btn admin-btn-green"
            >
                💾 Simpan Data
            </button>


            <a
                href="{{ route('home') }}"
                target="_blank"
                class="admin-btn admin-btn-dark"
            >
                🌐 Lihat Website
            </a>

        </div>

    </form>

</div>

@endsection