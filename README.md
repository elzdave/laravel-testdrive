# Laravel TestDrive

## Description

This is a proof-of-concept on how to use Google Drive as Laravel Storage System, built on top of [Flysystem adapter](https://github.com/thephpleague/flysystem).

## General Information

-   Author : David Eleazar [[elzdave@student.untan.ac.id](mailto:elzdave@student.untan.ac.id)]
-   Prog. Lang : PHP 7.4.\*
-   Framework : Laravel 8.x
-   System Requirements :
    -   [Composer](https://getcomposer.org/)
    -   Any [databases supported](https://laravel.com/docs/8.x/database) by [Laravel](https://laravel.com)
-   3rd Party Lib :
    -   [Flysystem Adapter for Google Drive](https://github.com/nao-pon/flysystem-google-drive) by [Naoki Sawada](https://github.com/nao-pon)

## Usage

1. Clone this repository
2. Using Terminal/Command Prompt, `cd` to this project's folder
3. Copy `.env.example` to `.env`
4. Run `composer install`
5. Set application key by executing `php artisan key:generate`
6. Setup database connection on `.env` file
7. Create Google OAuth2.0 client ID, client secret, refresh token, and Google Drive folder ID by using [this tutorial](https://github.com/ivanvermeyen/laravel-google-drive-demo#create-your-google-drive-api-keys)
8. Set the following entries in your `.env`
    ```
    GOOGLE_DRIVE_CLIENT_ID=<your-google-oauth2-client-id>
    GOOGLE_DRIVE_CLIENT_SECRET=<your-google-oauth2-client-secret>
    GOOGLE_DRIVE_REFRESH_TOKEN=<your-google-oauth2-refresh-token>
    GOOGLE_DRIVE_FOLDER_ID=<your-google-drive-folder-id>
    ```
    If you use Team Drive, don't forget to set the following entry
    ```
      GOOGLE_DRIVE_TEAM_DRIVE_ID=<your-google-drive-team-drive-id>
    ```
9. Run `php artisan migrate` to create database structure
10. To run app, run `php artisan serve`

## Features

1. Upload file to Google Drive
2. Index and show files from Google Drive
3. Delete file from Google Drive

## Contribution

Feel free to lend your help to improve this apps !
