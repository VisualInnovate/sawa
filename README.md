
## Installation

### clone the repo
``` bash
git clone https://github.com/ali-visual-innovate/sawa_academy.git sawa_academy
```
### go into app's directory
``` bash
cd sawa_academy/laravel
```
### install app's dependencies
``` bash
composer install
```
### create new database sawa_academy
### add .env file update DB_DATABASE=sawa_academy
``` bash
php artisan migrate --seed
```
### passport install
``` bash
php artisan passport:install
```
### generate key
``` bash
php artisan key:generate
```
### run serve
``` bash
php artisan serve
```
### cd sawa_academy/vue
``` bash
npm install
```
### run dev
``` bash
npm run dev
```
### open browser in localhost:3000
### email: admin@admin.com
### password: password
