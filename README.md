[![PHP Composer](https://github.com/ONyklicek/Helper-tool/actions/workflows/php.yml/badge.svg)](https://github.com/ONyklicek/Helper-tool/actions/workflows/php.yml) [![PHPUnit](https://github.com/ONyklicek/Helper-tool/actions/workflows/phpUnit.yml/badge.svg)](https://github.com/ONyklicek/Helper-tool/actions/workflows/phpUnit.yml) [![PHPStan](https://github.com/ONyklicek/Helper-tool/actions/workflows/phpStan.yml/badge.svg)](https://github.com/ONyklicek/Helper-tool/actions/workflows/phpStan.yml) [![Latest Stable Version](http://poser.pugx.org/onyklicek/helper-tool/v)](https://packagist.org/packages/onyklicek/helper-tool) [![Latest Unstable Version](http://poser.pugx.org/onyklicek/helper-tool/v/unstable)](https://packagist.org/packages/onyklicek/helper-tool) [![License](http://poser.pugx.org/onyklicek/helper-tool/license)](https://packagist.org/packages/onyklicek/helper-tool) 

<!--[![PHP Version Require](http://poser.pugx.org/onyklicek/helper-tool/require/php)](https://packagist.org/packages/onyklicek/helper-tool)-->

# 🛠️ PHP Utils


This library is developed to make your work easier and more enjoyable.
The code is understandable and user-friendly
Simplify your work with strings, arrays, etc. 

## 📦 Install

It's best to use Composer for installation, and you can also find the package on [Packagist](https://packagist.org/packages/onyklicek/helper-tool).

To install, simply use the command:

```
composer require onyklicek/utils
```

## 📝 Usage

```
<?php

require_once 'vendor/autoload.php';


echo \ONyklicek\Utils\Str::make('your text')->remove('your', false, true)->get();
//return text

```

## 📚 Documentation

Documentation can be found on the [Wiki](https://github.com/ONyklicek/Helper-tool/wiki)