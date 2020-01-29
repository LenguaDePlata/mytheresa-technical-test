# About this test and redoing it

After I was told to redo the test, I thought it would be a good idea to build it in another framework, as I've been working with Symfony and DDD for the last two years. However, as I tried to build the application from scratch, I learnt (too late) why I didn't use Symfony in the first place the last time: it lacked simplicity when it is most needed, and it didn't ease things when trying to build  a custom structure based more on DDD and CQRS -it consumed too much time. That, along with some issues with Windows when configuring Docker, made me drop the idea of the Symfony solution. It works better with long-term and wider projects. Laravel was faster and more elegant for something small (you can see the starting point of the Symfony half-baked solution in https://github.com/LenguaDePlata/mytheresa-technical-test-2)

So, after doing some tests and fixing the dockerization in Laravel, I still present this solution to your technical test, even if DDD and CQRS couldn't be added to the mix. It's still the best solution time-, test-, and functionality-wise. My focus from the beginning should have been working over this solution to improve and refactor where it would have been needed.

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

You can see the endpoints available with

    docker exec docker_app_1 php artisan route:list

There are three of them, although they fulfill the role of the two asked for the challenge:

- GET /carts/{cart}: given the id of a cart, returns its id and list of items
- PUT /carts/item/{item}: given the id of an item, adds it to the cart, when the cart has not yet been created (it's the first item of the cart); thus, it creates the cart, adds the item, and returns the info of the cart
- PUT /carts/{cart}/item/{item}: given the id of an item and the id of a cart, adds the item to the cart, and returns the updated cart's information