# Pizza POS

### Requirements:
- Docker
- Composer
- PHP
- SQL


### Setup Commands:
After cloning project, run the following commands in

project directory:<br>
- `composer install` : install composer packages
- `cp .env.example .env` : created env file
- `npm install` : install node packages
- `./vendor/bin/sail up` : start running docker container
- `./vendor/bin/sail artisan migrate:fresh --seed` : refresh and seed database

- `cd Modules/Order`: change directory to order modules

module directory:
- `npm run build`
- `npm run dev`


### Other Commands
- `./vendor/bin/sail down` : stop running docker containers
- `./vendor/bin/sail artisan test` : run tests
- `./vendor/bin/sail artisan test -filter "test_single"` : run single test
- `./vendor/bin/pint` : clean up back-end code
- `npx prettier . --write`: clean up front-end code


### Cypress Commands (module directory)
- `npx cypress run` : run front-end tests
- `npx cypress open` : open cypress


###  Module Commands
- `./vendor/bin/sail  artisan module:migrate Order` : migrate order module database
- `./vendor/bin/sail artisan module:seed Order` : seed order module seeders
- `./vendor/bin/sail artisan module:migrate-fresh Order --seed`: refresh and seed order module database

The [Laravel Modules package](https://github.com/nWidart/laravel-modules) was used to create this module, [more module commands](https://laravelmodules.com/docs/v11/artisan-commands#module-migrate).

###  Jobs (RabbitMQ)

When an order status gets updated, the `OrderStatusUpdated` gets fired which notifies other applications via RabbitMQ.

To test this:
- Visit [CloudAMPQ](https://customer.cloudamqp.com/login)
- Create an instance and update your RabbitMQ credentials in the `.env`
- Whenever an order gets updated on the module, you should see it on your queued messages ready to be processed, example in screenshot.

NB: My initial approach to this was to send a HTTP request to the website's API via `app(MainAppInterface::class)->updateOrder(..))`.

HTTP communication is ideal in some situations but it can at times create dependencies. By using an Event-driven architecture (EDA), 
we can keep the services will be loosely coupled and retry jobs if they happen to fail.

![readme.png](readme.png)

