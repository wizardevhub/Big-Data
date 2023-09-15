@echo off

composer install
php artisan key:generate && pause