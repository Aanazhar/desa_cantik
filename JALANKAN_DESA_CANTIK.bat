@echo off
title Desa Cantik - Jalankan Aplikasi
cd /d "%~dp0"

echo ==========================================
echo       DESA CANTIK - INSTALASI
echo ==========================================
echo.

if not exist "vendor\autoload.php" (
    echo [1/4] Memasang dependency Laravel...
    call composer install --no-interaction
    if errorlevel 1 (
        echo.
        echo GAGAL menjalankan Composer.
        echo Pastikan Composer sudah terpasang dan koneksi internet aktif.
        pause
        exit /b 1
    )
) else (
    echo [1/4] Dependency Laravel sudah tersedia.
)

echo.
echo [2/4] Membersihkan cache...
php artisan optimize:clear

echo.
echo [3/4] Menjalankan migration...
php artisan migrate --force

echo.
echo [4/4] Menjalankan server Laravel...
echo.
echo Buka: http://127.0.0.1:8000
echo Tekan Ctrl+C untuk menghentikan server.
echo.
php artisan serve
