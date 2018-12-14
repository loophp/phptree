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

It provides 4 different trees implementations.
* **Node**: The base class.
* **N-ary node**: (or K-ary tree) extends the base class and allows you to specify the capacity of a node, the maximum children a node can have.
* **Value node**: extends the N-ary node and allows you to attach a value to the node.
* **KeyValue node**: extends the Value node and allows you to attach a key and a value to the node.

It also provides [4 trees traversals algorithm](https://en.wikipedia.org/wiki/Tree_traversal):
* In order
* Post order
* Pre order
* Breadth first

And it provides 1 converter for the [graphp/graphp](https://github.com/graphp/graph) library.

## Documentation

API documentation is automatically generated with [APIGen](https://github.com/ApiGen/ApiGen) and available at [this address](https://not-a-number.io/phptree/).

## Requirements

* PHP >= 7.1

## Installation

```composer require drupol/phptree```

## Optional packages

* [graphp/graphp](https://github.com/graphp/graph): To convert a tree into a graph.
* [graphp/graphviz](https://github.com/graphp/graphviz): To render a graph into dot format or an image.

## Usage

```php
<?php

declare(strict_types = 1);

use Graphp\GraphViz\GraphViz;
use drupol\phptree\Converter\Graph;
use drupol\phptree\Node\ValueNode;

include './vendor/autoload.php';

$tree = new ValueNode('root', 2);

$nodes = [];
foreach (\range('A', 'Z') as $v) {
    $nodes[] = new ValueNode($v);
}

$tree->add(...$nodes);

$graphViz = new GraphViz();
$converter = new Graph();

$graphViz->display($converter->convert($tree));
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
