# Laravel Categories project

This is a simple Laravel project showing how to print trees and add leaves

This is built on Laravel Framework 5.5.39 This was built for demonstrate purpose.

## Installation

Clone the repository

Then inside command promt cd into the folder where the project is

Then do a composer install
```
composer install
```

Then create a environment file using this command
```
copy .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these parameters(`DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE`=categories).

Then create a database named `categories` and then do a database migration using this command-
```
php artisan migrate
```

At last generate application key, which will be used for password hashing, session and cookie encryption etc.
```
php artisan key:generate
```
## Project info

php version used: 7.0.6

Laravel Framework: 5.5.39

Bootstrap version: 3.3.7
