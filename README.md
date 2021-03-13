<a href="https://www.buymeacoffee.com/jsafe00" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-black.png" alt="Buy Me A Coffee" style="height: 51px !important;width: 217px !important;" ></a>

Composer package that creates CRUD service-repository-controller format.
As of this writing, this only supports up to laravel 6. Still in progresss to work this on laravel later version.

<b>Installation</b> <br/>
composer require safventure/laravel-s-r-c
<br />
<br />
<b>Usage</b>
<br />
<b> Make CRUD service-repository-controller</b><br/>
php artisan make:src {Name} <br />
ex. php artisan make:src Post <br />

<b> Make CRUD service</b><br/>
php artisan make:service {Name} <br />
ex. php artisan make:service Post

<b> Make CRUD repository</b><br/>
php artisan make:repository {Name} <br />
ex. php artisan make:repository Post

<b> Make CRUD controller</b><br/>
php artisan make:rscontroller {Name} <br />
ex. php artisan make:rscontroller Post
