[![Latest Stable Version](https://poser.pugx.org/drupol/phptree/v/stable)](https://packagist.org/packages/drupol/phptree)
 [![Total Downloads](https://poser.pugx.org/drupol/phptree/downloads)](https://packagist.org/packages/drupol/phptree)
 [![Build Status](https://travis-ci.org/drupol/phptree.svg?branch=master)](https://travis-ci.org/drupol/phptree)
 [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/drupol/phptree/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/drupol/phptree/?branch=master)
 [![Code Coverage](https://scrutinizer-ci.com/g/drupol/phptree/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/drupol/phptree/?branch=master)
 [![Mutation testing badge](https://badge.stryker-mutator.io/github.com/drupol/phptree/master)](https://stryker-mutator.github.io)
 [![License](https://poser.pugx.org/drupol/phptree/license)](https://packagist.org/packages/drupol/phptree)

# PhpTree

## Description

A PHP implementation of tree data structure.

## Documentation

API documentation is automatically generated with [APIGen](https://github.com/ApiGen/ApiGen) and available at [this address](https://not-a-number.io/phptree/).

## Requirements

* PHP >= 7.1

## Installation

```composer require drupol/phptree```

## Usage

```php
use drupol\phptree\Node\ValueNode;
use drupol\phptree\Node\KeyValueNode;

$tree = new KeyValueNode('root');

$nodes = [];
foreach (\range('a', 'e') as $lowercaseValue) {
    $node1 = new ValueNode($lowercaseValue);

    foreach (\range('A', 'E') as $uppercaseValue) {
        $node2 = new ValueNode($uppercaseValue);
        $node1->add($node2);
    }

    $nodes[] = $node1;
}

$tree->add(...$nodes);
```

## Code quality, tests and benchmarks

Every time changes are introduced into the library, [Travis CI](https://travis-ci.org/drupol/phptree/builds) run the tests and the benchmarks.

The library has tests written with [PHPSpec](http://www.phpspec.net/).
Feel free to check them out in the `spec` directory. Run `composer phpspec` to trigger the tests.

Before each commit some inspections are executed with [GrumPHP](https://github.com/phpro/grumphp), run `./vendor/bin/grumphp run` to check manually.

[PHPBench](https://github.com/phpbench/phpbench) is used to benchmark the library, to run the benchmarks: `composer bench`

[PHPInfection](https://github.com/infection/infection) is used to ensure that your code is properly tested, run `composer infection` to test your code.

## Contributing

Feel free to contribute to this library by sending Github pull requests. I'm quite reactive :-)
