install:
	cd src && \
		composer install && \
		php artisan key:generate && \
		php artisan storage:link && \
		php artisan migrate:refresh
run:
	cd src && \
		php artisan serve
