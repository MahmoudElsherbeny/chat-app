## Chat App

This is a simple realtime chat app project .
User can register and login with his account, After login user can add new friends from recomended user.
User have all control on other user relations add request, cancel request, accept request from others, block user, unblock user.
User can chat only with friends, or with unfriend user if there chat between them before.

For now live chat created by livewire polling (i know it's wrong because it make a huge load on server and server will crach on long data), but i have error with laravel websocket working to solve it.
this is the error if you could help: WebSocket connection to 'ws://localhost:6001/app/anyKey?protocol=7&client=js&version=7.3.0&flash=false' failed

## Technolgies used

- **[laravel](https://laravel.com/docs)**
- **[livewire](https://livewire.com/docs)**

## Packages downloaded

- **[laravel ui](https://github.com/laravel/ui)** for authintication


# Getting started

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation#installation)

After clone the repository, Switch to the repo folder

    cd ms-watches-app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database storage link for files

    php artisan storage:link

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000 



***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

----------
