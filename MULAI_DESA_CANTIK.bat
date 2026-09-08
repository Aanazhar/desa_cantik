@echo off
cd /d "%~dp0"
php artisan optimize:clear
php artisan serve
