# System Requirements

-   PHP Version ^7.2
-   [Node](https://nodejs.org/en/) (at least the latest LTS)
-   [NPM](https://www.npmjs.com/) ( atleast the LTS)
-   [Composer](https://getcomposer.org/) ( atleast the LTS)
-   MySQL atleast version 5.1

# Getting started

1. Install dependencies, execute the following commands in project directory:
    - `npm install`
    - `composer install`
2. Create environment variables on .env
   cp .env.example .env
3. Configure ENV for APP KEY
    - `php artisan key:generate`
4. Configure ENV for Database
5. Compile Javascript resources by executing the command:
    - `npm run dev`
