# Movie sample app

Goal here is to show how simple app with 3 api endpoints could look. Made with simple DDD structure.

Application contains all application logic: handler and services to coordinate communication. In Domain main files exists.
For this simple case there is no aggregate and all comes to one movie domain. Infrastructure coordinate communication 
with user (UI controllers and commands) - primary adapters and communication with external sources - secondary adapters.

When doing not only API backend application this could be a good simple MVC concept.

### File structure
Files are grouped into 3 directories: Application, Domain and Interface. 
Application is responsible for handling communication and creating DTOs. 
Domain contain all domain objects as well as other helpers like VO, Factories, Collections.
Interface is a place where external communication take place, with user request and with databases, other API etc.

### Domain
For this project only one domain is created: Movie. For start Movie contain only title (VO). In future duration and language can be added
making Movie more descriptive.

### Reading data from file
Provided data was as php file. To get the data I've decided to create a Client file to include this file and read varabile. 
In life case this Client should be provided by database or cloud provider (like Doctrine or AWS).

## Usage
To run this project docker compose is needed. Just run `docker compose up -d`. To test endpoints visit documentation page:
[localhost:8082](http://localhost:8082). You can test endpoints and see how they work.

To get latest information about request (in debug) debug is available [localhost/_profiler](http://localhost/_profiler)

## Clean code
To keep code clean two additional apps were installed: CS-Fixer and PHPStan. Both are responsible for static code verification and
additionally CS_Fixer checks code styling as well.

To run PHPStan: `vendor/bin/phpstan analyse src`

To run CS-Fixer for checking errors: `vendor/bin/php-cs-fixer check src` or `vendor/bin/php-cs-fixer fix src` for fix

## Testing
There are two types of test in this project: Unit and Integration. As tere is no frontend here only API part E2E test are missing.
Unit tests are located under `test/Unit` and integration under `test/Integration`.

PHPUnit unit tests: `vendor/bin/phpunit tests/Unit --bootstrap tests/bootstrap.php -c phpunit.xml.dist`

PHPUnit integration tests: `vendor/bin/phpunit tests/Integration --bootstrap tests/bootstrap.php -c phpunit.xml.dist`

## Tech stack
* Symfony 7.0
* PHP 8.3
* CS-Fixer
* PHP-Stan (level 9)
* PHPUnit (v.11)
* Docker (with compose)
* Twig (only used for development - debug toolbar)

## Initial work
Greg, Lord of Postgresql Databases, Master of Redis Realms, Messenger of Symfony Secrets, 
Champion of Domain-Driven Development, Guardian of PHPUnit Proclamations, and Sage of PHP Sorcery