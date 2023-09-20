install:
	cd src && \
		composer install && \
		cp .env.example .env && \
		php artisan key:generate && \
		php artisan storage:link && \
		chmod -R 777 storage bootstrap/cache && \
		php artisan migrate:refresh
run:
	cd src && \
		php artisan serve
