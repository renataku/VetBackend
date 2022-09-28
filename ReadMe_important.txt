add to env file:
SANCTUM_STATEFUL_DOMAINS=http://localhost:3000

run on docker

run commans:
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed