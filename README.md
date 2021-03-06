# chubbyphp-session

[![Build Status](https://api.travis-ci.org/chubbyphp/chubbyphp-session.png?branch=master)](https://travis-ci.org/chubbyphp/chubbyphp-session)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-session/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-session/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-session/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-session/?branch=master)
[![Total Downloads](https://poser.pugx.org/chubbyphp/chubbyphp-session/downloads.png)](https://packagist.org/packages/chubbyphp/chubbyphp-session)
[![Monthly Downloads](https://poser.pugx.org/chubbyphp/chubbyphp-session/d/monthly)](https://packagist.org/packages/chubbyphp/chubbyphp-session)
[![Latest Stable Version](https://poser.pugx.org/chubbyphp/chubbyphp-session/v/stable.png)](https://packagist.org/packages/chubbyphp/chubbyphp-session)
[![Latest Unstable Version](https://poser.pugx.org/chubbyphp/chubbyphp-session/v/unstable)](https://packagist.org/packages/chubbyphp/chubbyphp-session)

## Description

A simple session solution, based on the [PSR7Session][2] (client side session).

## Requirements

 * php: ~7.0
 * psr7-sessions/storageless: ~3.0

## Suggest

 * pimple/pimple: ~3.0

## Installation

Through [Composer](http://getcomposer.org) as [chubbyphp/chubbyphp-session][1].

```sh
composer require chubbyphp/chubbyphp-session "~1.1"
```

## Usage

### Session

```php
<?php

use Chubbyphp\Session\FlashMessage;
use Chubbyphp\Session\Session;
use Psr\Http\Message\ServerRequestInterface as Request;

$session = new Session();

// check for existing key
$session->has($request, 'some.key');

// get value for existing key
$session->get($request, 'some.key', null);

// set value for key
$session->set($request, 'some.key', 'some.value');

// remove existing key
$session->remove($request, 'some.key');

// add flash message
$session->addFlash($request, new FlashMessage(FlashMessage::TYPE_SUCCESS, 'successfully saved'));

// get flash message
$flashMessage = $session->getFlash($request); // removes the flash from session
```

### SessionMiddleware

```php
<?php

$app = ...

// sample for slim
$app->add($container['session.middleware']);
```

### SessionProvider (Pimple)

```php
<?php

use Chubbyphp\Session\Session;
use Chubbyphp\Session\SessionProvider;
use Pimple\Container;

$container->register(new SessionProvider);

// replaceable configuration (set before first middleware use)
$container['session.expirationTime'] = 1200;
$container['session.privateRsaKey'] = '';
$container['session.publicRsaKey'] = '';

$container['session.setCookieHttpOnly'] = true;
$container['session.setCookiePath'] = '/';
$container['session.setCookieSecureOnly'] = true;

/** @var Session $session */
$session = $container['session'];
```

[1]: https://packagist.org/packages/chubbyphp/chubbyphp-session
[2]: https://github.com/psr7-sessions/storageless

## Copyright

Dominik Zogg 2016
