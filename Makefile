install:
	cd src && \
		composer install && \
		cp .env.example .env && \
		php artisan key:generate && \
		php artisan storage:link && \
		php artisan migrate:refresh
run:
	cd src && \
		php artisan serve
