
# Notes App

This is a Web Application leveraging on Vue.js and Laravel to create SPA(Single Page Application) application.

The following must be installed and available on your terminal:


## Screenshots

![App Screenshot](![image](https://github.com/Hilda003/no-pressure/assets/118154498/545f2125-eb17-438f-b985-943ce5f1bfa0)
)
![App Screenshot](![image](https://github.com/Hilda003/no-pressure/assets/118154498/320b87f8-3c63-48c4-b795-4ab5d2b70209))



## Installation

1. Clone the project git clone https://github.com/Hilda003/no-pressure.git
2. `cd` to the project and run `composer install` on the terminal to install php dependencies
3. copy the `.env-example` file to `.env` file
4. Create a Mysql database and edit the .env to reflect your connections as follows:
```javascript
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourdb
DB_USERNAME=yourusername
DB_PASSWORD=yourpassword
```
5. Migrate your migrations: `php artisan migrate`
6. Generate application encryption key: `php artisan key:generate`
7. Run `npm install && npm run dev` to install node.js dependencies
8. Start your development server and start testing the web app: `php artisan serve`
9. Done!!

