# Mini Booking App

Mini Booking je aplikacija za rezervaciju apartmana napravljena pomocu **Laravel** i **React** tehnologija.

---

## Tehnologije 
- Laravel 11 (Backend)
- React (frontend)
- MySQL (Baza podataka)
- Bootstrap 5 (UI)
- Axios (API komunikacija)

---

## Instalacija

1.  Kloniraj repozitorijum:
    ```bash
    git clone https://github.com/njegosjerinic/mini-booking-app
    cd mini-booking

2.  Instaliraj pakete 
    composer install
    npm install

3.  Postavi .env fajl
    cp .env.example .env
    php artisan key:generate

4.  Pokreni migracije i seedere:
    php atisan serve 
    npm run dev

## Struktura

- /app - Laravel backend
- /resource/js - React frontend
- /routes - rute
- /database/seeders - testni podaci

## Autori

-Njegos Jerinic

## Napomena 

Ovaj projekat je u fazi usavrsavanja i sluzi kao platforma za praksu.
