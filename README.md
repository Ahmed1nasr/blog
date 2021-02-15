Blog Base on WINK : https://github.com/themsaid/wink \
laravel project : https://github.com/elsayed85/my_blog \
Api V1 : https://documenter.getpostman.com/view/8692544/TWDTLyP6 \
To Run the project : \
git clone https://github.com/elsayed85/my_blog \
cd my_blog \
install dependencies : composer install \
copy .env.example and create .env file \
create a kay : php artisan key:generate \
update database configration and aother configtations in .env file to your own configrations \
For Fake data run : php artisan migrate:fresh --seed \
Run queue For reset password mails : php artisan queue:work
