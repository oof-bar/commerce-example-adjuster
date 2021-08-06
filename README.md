# Example Adjuster Module

A simplest-case `AdjusterInterface` implementation. Scaffolded with [pluginfactory.io](https://pluginfactory.io).

## Requirements

This module requires Craft CMS 3.0.0-RC1 or later, and Craft Commerce 2.0.0-beta11

## Installation

To install the module, download this repository as a ZIP, unpack it, and put the folder into your project's `modules` directory, named `exampleadjuster`.

Ensure the module is loaded on every request by adding entries to your `app.php` file:

```php
return [
    'modules' => [
        'exampleadjuster' => [
            'class' => \modules\exampleadjuster\Example::class,
        ],
    ],
    'bootstrap' => ['exampleadjuster']
];
```

You'll also need to make sure that you add the following to your project's `composer.json` file so that Composer can find your module:

```json
"autoload": {
    "psr-4": {
        "modules\\exampleadjuster\\": "modules/exampleadjuster/src/"
    }
}
```

After you have added this, you will need to do:

```bash
composer dump-autoload
```
 
 …from the project’s root directory, to rebuild the Composer autoload map. This will happen automatically any time you do a `composer install` or `composer update` as well.

🌳
