# php-google-login
It is an mvc example project for login with google api web pplication.

![google_login_api](https://github.com/PHPMohamedNabil/php-google-login-api/assets/29188634/401d8d11-710e-485c-a308-4666bf21c932)

Features
--------
* mvc google login api.
* ability to register your logedin user data into database.
* using well orginzied code.

Installation
------------

1. download zip folder.
2. install composer.
3. goto .env to put your google client_id and secret_key.
4. run command composer install to install pacakge.
5. open command prompot and write php migrate (optional :if you are storing user data to database)
6. open public folder and run command php -S localhost:8000 (to start php local server you can choose and localhost port you want)

# install composer project packages:
    ``` composer install ```
### run migration command for storing data to database mysql
    ``` php migrate  ```
### go to public folder and start your localhost server
    ``` php -S localhost:8000   ```

# put your google api setting 

```php
APP_NAME=GoogleLogin
ENVIROMENT=development

DB=mysql
HOSTNAME=localhost
USERNAME=root
PASSWORD=
DBNAME=google

Google_Client_ID= your google client_id
Google_Client_Secret= your google secret_key

SESSION_LIFE_TIME=1800
SESSION_IDLE_TIME=1000
```
# Routing
 go to app\route\web.php and edit your routing settings
```php
use App\Core\Route\Router as Route;
use App\Controllers\GoogleController;

Route::get('/google/login',[GoogleController::class,'index'])->name('google_login')->middleware('checkLogin');
Route::get('/google/user',[GoogleController::class,'home'])->name('home_page')->middleware('authCheck');
Route::get('/logout',[GoogleController::class,'logout'])->name('logout')->middleware('authCheck');

Route::get('/','start');

//Route::get('/google/user',[GoogleController::class,'profile'])->name('home_page')->middleware('authCheck');
// use this route if you are storing user data in database
```

# main site url
 go to app\config\config_constants.php and edit your configration your website url settings
//webiste address and routes
**edit SITE_URL constant to be your website url**
```php
define('SITE_URL','http://localhost:8000/');
define('SITE_AD_URL','http://bookstore.local/admin/');
define('VENDOR',ROOT_PATH.'vendor'.DS);
```

#congiration trait
 go to app\traits\GoogleConfigrationTrait.php and edit your configration your website url settings
 ### edit redirect url to be match one you wrote in google cloud api setting **!imporatant**
 ```php
namespace App\Traits;

use Google_Service_Oauth2;
use App\Core\Database\NativeDB;

trait GoogleConfigrationTrait{

    protected Const REDIRECT_URL = SITE_URL.'google/login';
```
