## laravel project : https://github.com/elsayed85/my_blog 
## Api V1 : https://documenter.getpostman.com/view/8692544/TWDTLyP6 
# To Run the project :

1. git clone https://github.com/elsayed85/my_blog 
2. cd my_blog 
3. install dependencies : composer install
4. copy .env.example and create .env file
5. create a kay : php artisan key:generate
6. update database configration and aother configtations in .env file to your own configrations
7. For Fake data run : php artisan migrate:fresh --seed
8. Run queue For reset password mails : php artisan queue:work
