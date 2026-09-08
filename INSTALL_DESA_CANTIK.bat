@echo off
setlocal
title INSTALL DESA CANTIK
cd /d "%~dp0"
echo ===============================================
echo   INSTALL / RESET WEBSITE DESA CANTIK
echo ===============================================
echo.
echo Pastikan MySQL XAMPP sudah RUNNING pada port 3306.
echo.
"C:\xampp\mysql\bin\mysql.exe" -h 127.0.0.1 -P 3306 -u root < database\create_database.sql
if errorlevel 1 goto fail
php artisan migrate:fresh --seed
if errorlevel 1 goto fail
php artisan optimize:clear
if errorlevel 1 goto fail
echo.
echo ===============================================
echo   INSTALLASI BERHASIL
 echo ===============================================
echo.
echo Website: http://127.0.0.1:8000
echo Admin  : http://127.0.0.1:8000/admin/login
echo Email  : admin@desacantik.id
echo Password: admin123
echo.
pause
exit /b 0
:fail
echo.
echo INSTALLASI GAGAL. Baca pesan error di atas.
pause
exit /b 1
