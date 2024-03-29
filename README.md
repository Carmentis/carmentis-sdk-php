# carmentis-sdk-php

## SDK Installation

### Composer

To install the SDK first add the below to your `composer.json` file:

```json
{
    "repositories": [
        {
            "type": "package",
            "package": {
                "name": "carmentis/carmentis-sdk-php",
                "source": {
                    "url": "https://github.com/Carmentis/carmentis-sdk-php.git",
                    "type": "git",
                    "reference": "main"
                },
                "version": "v1.0.0"
            }
        }
    ],
    "require": {
        "carmentis-sdk-php": "*"
    },
    "autoload": {
      "psr-4": {
        "Carmentis\\": "vendor/carmentis/carmentis-sdk-php/src"
      }
    }
}
```
```bash
composer update
```
## SDK Example Usage

### Example

```php
<?php

use Carmentis\Operator\Operator;

try {
    $operator = new Operator("http://localhost:3005");

    $version = $operator->getOperatorVersion();
} catch (\Exception $e) {
    // handle exception
}
```

Documentation for the methods to call can be found on [the official Carmentis documentation](https://docs.carmentis.io/)
