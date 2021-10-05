## How To Install

First, make sure you have PHP, Apache2, Mysql installed on your local and then continue to this step :
- Install composer on your local https://getcomposer.org/doc/00-intro.md
- Clone repo
- Run `composer install`
- Run `php artisan key:generate`
- Duplicate `.env.example` file and rename it to `.env`
- Change the `DB_USERNAME`, and `DB_PASSWORD` value to your local value
- Create database named `abangexpress`
- Run `npm install` and `npm run dev`
- Run `php artisan serve`
- Open new terminal, run `npm run watch` to compile the CSS and JS
