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
"geniv/nette-browser-sync": "^1.0"
```

require:
```json
"php": ">=7.0",
"nette/nette": ">=2.4",
"geniv/nette-general-form": ">=1.0"
```

Include in application
----------------------

neon configure:
```neon
services:
    - BrowserSync
#or    
    - BrowserSync(other url, other check url)
```

base presenter:
```php
protected function createComponentBrowserSync(IBrowserSync $browserSync): IBrowserSync
{
    //$browserSync->setTemplatePath(__DIR__ . '/templates/browserSync.latte');
    //$browserSync->setCheckByUrl(false);
    return $browserSync;
}
```

usage:
```latte
{control browserSync}
```
