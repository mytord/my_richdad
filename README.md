Task
------------

Create simple web application that:

1) Provides user registration and authorization
2) User should have a portfolio of stocks
3) Data source: Yahoo Finance API
4) Show chart of stock history prices for the last 2 years.

Keywords: Symfony2, MySQL, Highcharts, Yahoo Finance API

Solution
--------------

Time required: `20 hours`


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
`phpunit -c app`
Run server
`app/console server:run`
Then go to:
`http://localhost:8000`






