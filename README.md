Reinfi\RequestListener
==============

### Deprecated

This module is deprecated as laminas/laminas-mvc-console and laminas-console is deprecated.
Using laminas-cli does not trigger any listeners.

Move your `http_listener` to `listeners` in your configuration.

### Description


This module can add listeners only for HTTP or Console Requests.

Installation
------------

Module can be easily installed with composer. Just ask a composer to download the bundle with dependencies by running the command:

```bash
$ composer require reinfi/zf-request-listener
```

Add the `Reinfi\RequestListener` to your list of modules in the config/application.config.php `modules` array:
```php
// config/application.config.php

    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Reinfi\RequestListener',
        'Application',
    ),
```

Configuration
-------------

Instead of adding every listener to `listeners` you can add the following:

```
[
    'cli_listeners' => [
        NameSpace\YourClass::class,
    ],
    'http_listeners' => [
        NameSpace\YourClass::class,
    ],
]
```

License
-------

This module is under the MIT license. See the complete LICENSE in the root directory
