# How to run the app and its tests

After pulling the code from the repo, set the dotenv environment file from the example one:

    cp .env.example .env

Move to the docker folder and execute docker-compose

    cd docker
    docker-compose up -d

When all containers are up and running, install the composer dependencies

    docker exec docker_app_1 composer install

Then initialize the Laravel application key and its database from scratch:

    docker exec docker_app_1 php artisan key:generate
    docker exec docker_app_1 php artisan migrate:fresh

Now you can run the unit and integration tests:

    docker exec docker_app_1 vendor/bin/phpunit