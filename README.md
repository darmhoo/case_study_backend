

## Case Study App

A Dockerized News Aggregator app that takes data from newsapi stores them and presents them in a nice way to a logged in user

## VSCode dev container

in the .devcontainer folder, there is a docker-compose file and a DockerFile that can be used in setting up the container

## Installation

After Docker setup, run composer install

copy the contents of .env.example to your .env file

run php artisan serve

run the scheduler with command:

php artisan schedule:work

This will prefill the db with news content



