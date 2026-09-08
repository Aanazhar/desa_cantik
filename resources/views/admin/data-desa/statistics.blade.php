@extends('layouts.admin')

@section('title', 'Data Desa')

@section('content')

<div class="admin-page">

    <div class="admin-page-header">

        <div>
            <h2>Data Desa</h2>
            <p>
                Kelola data statistik desa yang akan ditampilkan
                pada halaman website.
            </p>
        </div>

    </div>


    <form
        method="POST"
        action="{{ route('admin.data-desa.statistics.update') }}"
    >

        @csrf
        @method('PUT')


        {{-- ================================
             DATA PENDUDUK
        ================================= --}}

        <div class="admin-card">

            <div class="admin-card-header">
                <h3>Data Penduduk</h3>
                <p>Masukkan data penduduk terbaru desa.</p>
            </div>

            <div class="admin-form-grid">

                <div class="form-group">
                    <label>Total Penduduk</label>
                    <input
                        type="number"
                        name="total_penduduk"
                        min="0"
                        value="{{ old('total_penduduk', $statistic->total_penduduk) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Laki-laki</label>
                    <input
                        type="number"
                        name="laki_laki"
                        min="0"
                        value="{{ old('laki_laki', $statistic->laki_laki) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Perempuan</label>
                    <input
                        type="number"
                        name="perempuan"
                        min="0"
                        value="{{ old('perempuan', $statistic->perempuan) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Kepala Keluarga</label>
                    <input
                        type="number"
                        name="kepala_keluarga"
                        min="0"
                        value="{{ old('kepala_keluarga', $statistic->kepala_keluarga) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Keluarga Miskin</label>
                    <input
                        type="number"
                        name="keluarga_miskin"
                        min="0"
                        value="{{ old('keluarga_miskin', $statistic->keluarga_miskin) }}"
                        required
                    >
                </div>

            </div>

        </div>


        {{-- ================================
             UMUR
        ================================= --}}

        <div class="admin-card">

            <div class="admin-card-header">
                <h3>Kategori Umur</h3>
            </div>

            <div class="admin-form-grid">

                @foreach([
                    'balita' => 'Balita',
                    'anak' => 'Anak',
                    'remaja' => 'Remaja',
                    'dewasa' => 'Dewasa',
                    'lansia' => 'Lansia',
                    'disabilitas' => 'Disabilitas'
                ] as $field => $label)

                    <div class="form-group">

                        <label>{{ $label }}</label>

                        <input
                            type="number"
                            name="{{ $field }}"
                            min="0"
                            value="{{ old($field, $statistic->{$field}) }}"
                            required
                        >

                    </div>

                @endforeach

            </div>

        </div>


        {{-- ================================
             PENDIDIKAN
        ================================= --}}

        <div class="admin-card">

            <div class="admin-card-header">
                <h3>Pendidikan</h3>
            </div>

            <div class="admin-form-grid">

                @foreach([
                    'belum_sekolah' => 'Belum Sekolah',
                    'sd' => 'SD',
                    'smp' => 'SMP',
                    'sma' => 'SMA',
                    'diploma' => 'Diploma',
                    'sarjana' => 'Sarjana'
                ] as $field => $label)

                    <div class="form-group">

                        <label>{{ $label }}</label>

                        <input
                            type="number"
                            name="{{ $field }}"
                            min="0"
                            value="{{ old($field, $statistic->{$field}) }}"
                            required
                        >

                    </div>

                @endforeach

            </div>

        </div>


        {{-- ================================
             PEKERJAAN
        ================================= --}}

        <div class="admin-card">

            <div class="admin-card-header">
                <h3>Pekerjaan</h3>
            </div>

            <div class="admin-form-grid">

                @foreach([
                    'petani' => 'Petani',
                    'nelayan' => 'Nelayan',
                    'pedagang' => 'Pedagang',
                    'wiraswasta' => 'Wiraswasta',
                    'pns' => 'PNS',
                    'karyawan' => 'Karyawan',
                    'pelajar' => 'Pelajar',
                    'belum_bekerja' => 'Belum Bekerja'
                ] as $field => $label)

                    <div class="form-group">

                        <label>{{ $label }}</label>

                        <input
                            type="number"
                            name="{{ $field }}"
                            min="0"
                            value="{{ old($field, $statistic->{$field}) }}"
                            required
                        >

                    </div>

                @endforeach

            </div>

        </div>


        {{-- ================================
             AGAMA
        ================================= --}}

        <div class="admin-card">

            <div class="admin-card-header">
                <h3>Agama</h3>
            </div>

            <div class="admin-form-grid">

                @foreach([
                    'islam' => 'Islam',
                    'kristen' => 'Kristen',
                    'katolik' => 'Katolik',
                    'hindu' => 'Hindu',
                    'buddha' => 'Buddha',
                    'konghucu' => 'Konghucu',
                    'kepercayaan_lainnya' => 'Kepercayaan Lainnya'
                ] as $field => $label)

                    <div class="form-group">

                        <label>{{ $label }}</label>

                        <input
                            type="number"
                            name="{{ $field }}"
                            min="0"
                            value="{{ old($field, $statistic->{$field}) }}"
                            required
                        >

                    </div>

                @endforeach

            </div>

        </div>


        {{-- ================================
             FASILITAS
        ================================= --}}

        <div class="admin-card">

            <div class="admin-card-header">
                <h3>Fasilitas Desa</h3>
            </div>

            <div class="admin-form-grid">

                @foreach([
                    'sekolah' => 'Sekolah',
                    'posyandu' => 'Posyandu',
                    'puskesmas' => 'Puskesmas',
                    'tempat_ibadah' => 'Tempat Ibadah'
                ] as $field => $label)

                    <div class="form-group">

                        <label>{{ $label }}</label>

                        <input
                            type="number"
                            name="{{ $field }}"
                            min="0"
                            value="{{ old($field, $statistic->{$field}) }}"
                            required
                        >

                    </div>

                @endforeach

            </div>

        </div>


        {{-- ================================
             LAINNYA
        ================================= --}}

        <div class="admin-card">

            <div class="admin-card-header">
                <h3>Informasi Tambahan</h3>
            </div>

            <div class="admin-form-grid">

                <div class="form-group">

                    <label>
                        Luas Wilayah
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="luas_wilayah"
                        min="0"
                        value="{{ old('luas_wilayah', $statistic->luas_wilayah) }}"
                        required
                    >

                </div>

            </div>


            <div class="form-group">

                <label>
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    rows="4"
                >{{ old('catatan', $statistic->catatan) }}</textarea>

            </div>

        </div>


        {{-- ================================
             BUTTON
        ================================= --}}

        <div class="admin-form-actions">

            <button
                type="submit"
                class="admin-btn admin-btn-primary"
            >
                Simpan Data Desa
            </button>

        </div>

    </form>

</div>

@endsection