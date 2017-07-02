all:
	bin/console doctrine:schema:drop --force
	bin/console doctrine:schema:create
	bin/console doctrine:fixtures:load --no-interaction
	bin/console assets:install
	bin/console assetic:dump