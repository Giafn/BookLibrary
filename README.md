# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. 
[Official Documentation](https://laravel.com/docs/9.x/installation)


Clone the repository

    git clone https://github.com/Giafn/BookLibrary.git

Switch to the repo folder

    cd BookLibrary

Install all the dependencies using composer

    composer install

Install all dependencies npm

    npm i

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/Giafn/BookLibrary.git
    cd BookLibrary
    composer install
    npm i
    cp .env.example .env
    php artisan key:generate

**insert variable google setting to .env**
    FILESYSTEM_CLOUD=google
    GOOGLE_DRIVE_CLIENT_ID=****.apps.googleusercontent.com
    GOOGLE_DRIVE_CLIENT_SECRET={Your Client Secret}
    GOOGLE_DRIVE_REFRESH_TOKEN={Your Refresh Token}
    GOOGLE_DRIVE_FOLDER={Youur Folder name in drive}
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

