## How To Install

First, make sure you have PHP, Apache2, Mysql installed on your local and then continue to this step :
- Install composer on your local https://getcomposer.org/doc/00-intro.md
- Clone repo
- Run `composer install`
- Run `php artisan key:generate`
- Duplicate `.env.example` file and rename it to `.env`
- Change the `DB_USERNAME`, and `DB_PASSWORD` value to your local value
- Create database named `abangexpress`
- Run `npm install` and `npm run watch`
- Open new terminal, run `php artisan migrate --seed` or 
`php artisan migrate:fresh --seed` to generate dummy record

- TASK
[X] Fix button login template 1, add border radius and change color to dark blue
[X] Change FAQ component template 1, make it same as template 2
[X] Integrasi kolom input `recipient_previous`, ambil data dari ajax kemudian
kolom lain otomatis terisi dari data ajax tersebut
[X] Di dashboard shipping bisa search resi jg, kaya ditemplate 1
[X] Siapin controller buat search resi
[X] Fix hide section result resi
[X] Integrasi controller search resi (TrackingOrderController)

[X] Trackingnya di kasih kotak keterangan status dan penerima
[X] Trackingnya di taro tempalate 2
[X] Pake bahasa indonesia
[X] Hapus section "hubungi kami"

[ ] Update servis heimao (taiwan)
Requirements biar bisa pake heimao :

1. Ngecek kodepos, klo kodepos nya valid dan punya servis heimao, nampilin inputan jumlah dimensi (3 inputan, panjang lebar tinggi)
2. Range berat tidak boleh lebih dari 4-23kg, dan jumlah dimensi(P+L+T) maksimum 150cm
3. Jika memenuhi requirement, tampilkan opsi kurir heimao
