<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Layanan & Kontak - Admin Desa Cantik
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/style.css') }}"
    >

</head>


<body class="admin-page">


<div class="admin-layout">


    {{-- SIDEBAR --}}

    <aside class="admin-sidebar">

        <div class="admin-brand">

            <strong>
                🌿 Desa Cantik
            </strong>

            <span>
                Panel Administrasi Desa
            </span>

        </div>


        <nav class="admin-nav">

            <div class="admin-nav-title">
                MENU UTAMA
            </div>


            <a href="{{ url('/admin/site-data') }}">
                🏠 Dashboard
            </a>


            <a href="{{ route('admin.data-desa') }}">
                📊 Data Desa
            </a>


            <a
                href="{{ route('admin.sections') }}"
                class="active"
            >
                📄 Layanan & Kontak
            </a>


            <div
                class="admin-nav-title"
                style="margin-top:25px;"
            >
                WEBSITE
            </div>


            <a
                href="{{ route('home') }}"
                target="_blank"
            >
                🌐 Lihat Website
            </a>


            <form
                method="POST"
                action="{{ route('admin.logout') }}"
                style="margin:0;"
            >

                @csrf

                <button type="submit">
                    🚪 Logout
                </button>

            </form>

        </nav>

    </aside>



    {{-- MAIN --}}

    <main class="admin-main">


        <header class="admin-topbar">

            <div>

                <h1>
                    Layanan & Kontak
                </h1>

                <p>
                    Kelola informasi layanan dan kontak Desa Cantik
                </p>

            </div>


            <div>

                👤
                {{ session('admin_name', 'Administrator') }}

            </div>

        </header>



        <div class="admin-content">


            {{-- SUCCESS --}}

            @if(session('success'))

                <div class="admin-alert admin-alert-success">

                    {{ session('success') }}

                </div>

            @endif


            {{-- ERROR --}}

            @if($errors->any())

                <div class="admin-alert admin-alert-error">

                    {{ $errors->first() }}

                </div>

            @endif



            {{-- ===============================================
                 TAMBAH DATA
            ================================================ --}}

            <div class="admin-card">

                <h2>
                    Tambah Layanan / Kontak
                </h2>

                <p class="admin-card-description">
                    Data yang ditambahkan di sini akan
                    ditampilkan pada website desa.
                </p>


                <form
                    method="POST"
                    action="{{ route('admin.sections.store') }}"
                >

                    @csrf


                    <div class="admin-grid">


                        <div class="admin-form-group">

                            <label>
                                Jenis Data
                            </label>

                            <select name="type" required>

                                <option value="service">
                                    Layanan
                                </option>

                                <option value="contact">
                                    Kontak
                                </option>

                            </select>

                        </div>


                        <div class="admin-form-group">

                            <label>
                                Ikon
                            </label>

                            <input
                                type="text"
                                name="icon"
                                placeholder="Contoh: 📄"
                            >

                        </div>


                    </div>


                    <div class="admin-form-group">

                        <label>
                            Judul
                        </label>

                        <input
                            type="text"
                            name="title"
                            placeholder="Contoh: Surat Pengantar"
                            required
                        >

                    </div>


                    <div class="admin-form-group">

                        <label>
                            Deskripsi / Informasi
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            placeholder="Masukkan informasi layanan atau kontak..."
                        ></textarea>

                    </div>


                    <button
                        type="submit"
                        class="admin-btn admin-btn-green"
                    >
                        💾 Simpan Data
                    </button>

                </form>

            </div>



            {{-- ===============================================
                 LAYANAN
            ================================================ --}}

            <div class="admin-card">

                <h2>
                    📄 Layanan Desa
                </h2>

                <p class="admin-card-description">
                    Daftar layanan yang ditampilkan kepada masyarakat.
                </p>


                <div class="admin-table-wrapper">

                    <table class="admin-table">

                        <thead>

                            <tr>

                                <th>
                                    No
                                </th>

                                <th>
                                    Ikon
                                </th>

                                <th>
                                    Layanan
                                </th>

                                <th>
                                    Deskripsi
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @php
                                $serviceNumber = 1;
                            @endphp


                            @forelse($sections->where('type', 'service') as $section)

                                <tr>

                                    <td>
                                        {{ $serviceNumber++ }}
                                    </td>

                                    <td>
                                        {{ $section->icon ?: '📄' }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $section->title }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $section->description }}
                                    </td>

                                    <td>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.sections.destroy', $section->id) }}"
                                            onsubmit="return confirm('Hapus layanan ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="admin-btn admin-btn-red"
                                            >
                                                🗑 Hapus
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        style="text-align:center;padding:35px;"
                                    >
                                        Belum ada layanan.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>



            {{-- ===============================================
                 KONTAK
            ================================================ --}}

            <div class="admin-card">

                <h2>
                    📞 Kontak Desa
                </h2>

                <p class="admin-card-description">
                    Informasi kontak yang dapat dihubungi masyarakat.
                </p>


                <div class="admin-table-wrapper">

                    <table class="admin-table">

                        <thead>

                            <tr>

                                <th>
                                    No
                                </th>

                                <th>
                                    Ikon
                                </th>

                                <th>
                                    Informasi
                                </th>

                                <th>
                                    Keterangan
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @php
                                $contactNumber = 1;
                            @endphp


                            @forelse($sections->where('type', 'contact') as $section)

                                <tr>

                                    <td>
                                        {{ $contactNumber++ }}
                                    </td>

                                    <td>
                                        {{ $section->icon ?: '📞' }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $section->title }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $section->description }}
                                    </td>

                                    <td>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.sections.destroy', $section->id) }}"
                                            onsubmit="return confirm('Hapus kontak ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="admin-btn admin-btn-red"
                                            >
                                                🗑 Hapus
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        style="text-align:center;padding:35px;"
                                    >
                                        Belum ada informasi kontak.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


        </div>

    </main>


</div>


</body>

</html>
