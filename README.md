Browser sync
============

via: https://browsersync.io/

Installation
------------

```sh
$ composer require geniv/nette-browser-sync
```
or
```json
"geniv/nette-browser-sync": ">=1.0.0"
```

require:
```json
"php": ">=7.0.0",
"nette/nette": ">=2.4.0",
"geniv/nette-general-form": ">=1.0.0"
```

Include in application
----------------------

neon configure:
```neon
services:
    - BrowserSync
#or    
    - BrowserSync(other url)
```

base presenter:
```php
protected function createComponentBrowserSync(BrowserSync $browserSync): BrowserSync
{
    //$browserSync->setTemplatePath(__DIR__ . '/templates/browserSync.latte');
    return $browserSync;
}
```

usage:
```latte
{control browserSync}
```
