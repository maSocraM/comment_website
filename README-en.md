# Comments website

## The project
This is project of a PHP website using Laravel framework in back-end layer and frameworks Boostrap and jQuery in front-end layer.
You can use all this content to professional ou study purposes, don't have any type of licenses incorporated, but I only suggest if you get some money using this content please don't forgot me... ;)

## Objective
This project have the objective to create a simple website to insert and shows comments, using MongoDB non-relational database, muli-language support, with responsive front-end and capability to dynamicly change the styles. 
The resources below are used:
   1. **Laravel Framework** (PHP WEB Framework - *Version **5.4.36***) [1]
   2. **Moloquent** (Laravel Plugin Integration with MongoDB) [2]
   3. **Twitter Bootstrap** (Framework front-end - *Version **3.3***) [3]
   4. **Jumbotron** (Bootstrap Template) [4]
   5. **jQuery** (Javascript Framework - *Version **1.12.4***) [5]

## Requirements
- Local  WEB server;
- PHP version **5.6.30**;
- PHP MongoDB  module;
- MongoDB version **3.4.3**, with **localhost** and port **27017**;
- Virtualhost configured with  **jobtest.local** pointing the document root to _"public"_ folder.

## Install
- Clone or download this repository;
- Read and write permissions recursively to _"storage"_ e _"bootstrap/cache"_ foldes, in project root;
- Create **MongoDB** database with name _"jobtest"_ ;
- Execute command _"php artisan migrate --database=mongodb"_ (without quotes) in project root, to create database estructure.

## Add new language
1. Add the new language code in the file  _"app/config.php"_  (_code_ => _Language name_) in array key:
    ```php
    "locales"
    ```
    **Example:** Adding the Esperanto language:  
    ```php
    "locales" => ["pt" => "Português", "en" => "English", "eo" => "Esperanto"]
    ```
2. In _"resources/lang/"_  directory copy some _".json"_ language file and rename with the new language code.  
    **Example:** To Esperanto language, the file name will be  _"eo.json"_.
    
3. Edit all keys inside this file with the equivalent language values of the new language.  
    **Example:**
    ```json
    {
      "title": "Titolo en Esperanto",
      "company": "Kompanio de nomo en Esperanto",
      "author": "Aŭtoro",
      "project": "Nomo de projekto",
      ...
    }

## Referencies
   1. **Laravel change language** - <https://mydnic.be/post/laravel-5-and-his-fcking-non-persistent-app-setlocale>
   2. **Laravel Ajax Form** - <http://itsolutionstuff.com/post/laravel-5-ajax-request-validation-exampleexample.html>
   3. **jQuery Color switcher** - <https://codepen.io/nevan/pen/dmklG>

[1]: http://www.laravel.com   "Laravel Framework - Framework WEB PHP"
[2]: https://moloquent.github.io/master/basic "An Eloquent model and Query builder with support for MongoDB"
[3]: http://getbootstrap.com "Bootstrap Front-end Framework"
[4]: http://getbootstrap.com/docs/3.3/examples/jumbotron/ "Jumbotron Template for Bootstrap"
[5]: http://jQuery.org   "jQuery  - Framework Javascript"