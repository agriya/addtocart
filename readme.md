## Webshop - Addtocart Package
A Laravel 4 package for addtocart

## Installation

Add the following to you composer.json file

    "agriya/addtocart": "dev-master"

Run
    composer update

Add the following to app/config/app.php

    'Agriya\Addtocart\AddtocartServiceProvider',

Publish the config

    php artisan config:publish agriya/addtocart

Run the migration

    php artisan migrate --package="agriya/addtocart"

Add the following to app/routes.php

	Route::controller('cart', 'CartController');