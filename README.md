# A minimal notes package for Laravel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alphaolomi/laravel-notes.svg?style=flat-square)](https://packagist.org/packages/alphaolomi/laravel-notes)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/alphaolomi/laravel-notes/run-tests?label=tests)](https://github.com/alphaolomi/laravel-notes/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/alphaolomi/laravel-notes/Check%20&%20fix%20styling?label=code%20style)](https://github.com/alphaolomi/laravel-notes/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/alphaolomi/laravel-notes.svg?style=flat-square)](https://packagist.org/packages/alphaolomi/laravel-notes)

Add Notes to your models in your Laravel Applications.

## Installation

You can install the package via Composer:

```bash
composer require alphaolomi/laravel-notes
```

The package automatically registers migrations so there's no need to publish anything, just run them.

```
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-notes-config"
```

This is the contents of the published config file:

```php
return [

    'model' => \AlphaOlomi\Notes\Models\Note::class,

    'user' => \App\Models\User::class,

];
```

## Usage

Start by using the `AlphaOlomi\Notes\Concerns\HasNotes` trait on your model.

```php
use AlphaOlomi\Notes\Concerns\HasNotes;

class Project extends Model
{
    use HasNotes;
}
```

This trait adds a `notes(): MorphMany` relationship on your model. It also adds a new `Note()` method that can be used to quickly add a Note to your model.

```php
$project = Project::first();

$project->addNote('This is a note.');
```

By default, the package will use the authenticated user's ID as the "Noteor". You can customise this by providing a custom `User` to the `Note()` method.

```php
$project->addNote('This ia a another note.', user: User::first());
```

The package also supports `parent -> children` relationships for notes. This means that a Note can `belongTo` another Note.

```php
$project->addNote('Thanks you!', parent: Note::find(2));
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Alpha Olomi](https://github.com/alphaolomi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
