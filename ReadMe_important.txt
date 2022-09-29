add to env file:
SANCTUM_STATEFUL_DOMAINS=http://localhost:3000

run on docker

run commands:
sail artisan migrate
sail artisan db:seed
