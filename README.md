Task
------------

Create simple web application that:

1) Provides user registration and authorization

2) User should have a portfolio of stocks

3) Data source: Yahoo Finance API

4) Show chart of stock history prices for the last 2 years.

Keywords: Symfony2, MySQL, Highcharts, Twitter bootstrap, Yahoo Finance API

Solution
--------------
![Screenshot](https://cloud.githubusercontent.com/assets/7060998/10016364/2092c042-612f-11e5-8cd2-7925888592e5.png "Screenshot")


Time required: `20 hours`

Used libraries: 

1) `FOSUserBundle` for user registration and authorization features.

2) `Twitter bootstrap` for base layouts and forms

3) `highcharts.js` for interactive chart

4) `Acme\YahooBundle` for interaction with Yahoo Finance API

5) `Acme\UserBundle` for customize registration and authorization process and user portfolio crud operations.


Installation
--------------
Pretty easy: 

Install composer dependencies:

`composer install`

Install database and fixture data (base stocks)

`app/console doctrine:database:create`

`app/console doctrine:schema:update --force`

`app/console doctrine:fixtures:load`

Run unit tests

`bin/phpunit -c app`

Run server

`app/console server:run`

Then go to:

`http://localhost:8000`






