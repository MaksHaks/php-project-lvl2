install:
	composer install
validate:
	composer validate
	composer dump-autoload	
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
test:
	vendor/bin/phpunit tests
run:
	./bin/gendiff --format json tests/fixtures/file1.yaml tests/fixtures/file2.yaml
test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml