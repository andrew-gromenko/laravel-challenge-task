##Install

git clone 

cd laravel-challenge


--Set databese .env variables--

<!-- 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD= -->


composer install

php artisan migrate

php artisan import:challenge_data

php artisan serve


<!-- ***** -->

##Testings
You can find Postman collection example into root of project