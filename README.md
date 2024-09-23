## Simple Task Management System with TDD Approach

## Requirements
- PHP ^8.2 - (https://www.php.net/downloads.php) 
- Node Js (https://nodejs.org/en/download/package-manager)
- Composer (https://getcomposer.org/download/)

## How to Install 
- Clone this repository in your local machine
- Open your terminal and navigate to your project using (cd <localpath>)
- Create .env file and copy the content of env.local
- Run the following command 
    - composer install
    - composer dump-autoload
    - php artisan migrate 
    - php artisan db:seed --class=CategorySeeder
    - php artisan serve
    - npm install && npm run dev 
