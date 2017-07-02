# Start the project!
## Commands:

    php bin/console doctrine:schema:create
    php bin/console doctrine:fixtures:load --no-interaction
    php bin/console assets:install
    php bin/console assetic:dump
    php bin/console server:run

## Running tests

    php bin/phpspec run
    php bin/phpunit
    php bin/phpunit -c phpunit-smoke.xml


## Shorthands

    php bin/console d:s:c
    php bin/console d:f:l --no-interaction
    php bin/console a:i
    php bin/console a:d
    php bin/console s:r

## Running tests (on Windows)

    php vendor/phpspec/phpspec/bin/phpspec run
    php vendor/phpunit/phpunit/phpunit 
    php vendor/phpunit/phpunit/phpunit -c phpunit-smoke.xml

# Predefined user
    
    user: yoda@cleanphp.lt
    pass: cleanphp

@see AppBundle\DataFixtures\ORM\LoadUserData
