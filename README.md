# laravel-make-extender
## Generate below stub
1. Generate and autoload custom helpers, It can generate multilevel helpers in the context of the directory.
2. Generate Service class for process chunk of codes
3. Generate Trait for process chunk of codes
4. Generate Enum
5. Generate Collections Macros
6. Generate View Composers


This package helps to generate and autoload custom helpers, It can generate multilevel helpers in the context of the
directory.

## Installation

You can install the package via composer:

```bash
composer require mrchetan/laravel-make-extender
```

## Generate Helper file

Generate UserHelper.php under App/Helpers directory
```php
php artisan make:helper UserHelper
```
Generate Module/UserHelper.php under App/Helpers/Module directory
```php
php artisan make:helper Module/UserHelper
```



## Generate Service
Generate UserService.php under App/Services directory
```php
php artisan make:service UserService
```
```php
(new UserService())->handle();
```

Generate invokable UserService.php under App/Services directory
```php
php artisan make:service UserService --invokable
```
```php
(new UserService())();
```

## Generate Enum
Generate UserEnum.php under App/Enums directory
```php
php artisan make:enum UserEnum
```
## Generate Trait
Generate UserTrait.php under App/Traits directory
```php
php artisan make:trait UserTrait
```

Generate bootable UserTrait.php under App/Traits directory
```php
php artisan make:trait UserTrait --bootable
```

## Generate Collections Macro
Generate toUpper.php under App/Macros directory
```php
php artisan make:macro toUpper
```
see document [here](https://laravel.com/docs/8.x/collections#extending-collections) for how to use Macro


## Generate View composers
Generate config file for register view composers
```php
php artisan vendor:publish --provider="Mrchetan\LaravelMakeExtender\LaravelMakeExtenderServiceProvider" --tag="config"
```

Generate view composers class
```php
php artisan make:composer MovieComposer
```
Register view composers Edit config (config/viewcomposers.php)

```php
use App\ViewComposers\MovieComposer;

return [
    MovieComposer::class => [
      'view1','view2'
    ],
];
```

see document [here](https://laravel.com/docs/8.x/views#view-composers) for how to use View Composers

## Customize Stubs
```php
php artisan vendor:publish --provider="Mrchetan\LaravelMakeExtender\LaravelMakeExtenderServiceProvider" --tag="stubs"
```
This will export stubs into /stubs/vendor/laravel-make-extender for customization


### Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
