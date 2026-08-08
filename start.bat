@echo off
echo =======================================================
echo Menunggu proses instalasi Composer selesai...
echo (Ini bisa memakan waktu karena menggunakan Git clone)
echo =======================================================

:loop
if not exist vendor\autoload.php (
    timeout /t 5 /nobreak > nul
    goto loop
)

echo.
echo =======================================================
echo Instalasi Composer selesai! 
echo Menjalankan migrasi database MySQL (bacapedia_db)...
echo =======================================================
C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe artisan migrate --force

echo.
echo =======================================================
echo Menyalakan server Laravel Bacapedia...
echo =======================================================
C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe artisan serve
