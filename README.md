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
                "version": "v0.0.1"
            }
        }
    ],
    "require": {
        "carmentis-sdk-php": "*"
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
    $operator = new Operator(config('carmentis.operator_url'));

    $version = $operator->getVersion();
} catch (\Exception $e) {
    // handle exception
}
```
