[![Latest Stable Version](https://img.shields.io/packagist/v/drupol/phptree.svg?style=flat-square)](https://packagist.org/packages/drupol/phptree)
 [![GitHub stars](https://img.shields.io/github/stars/drupol/phptree.svg?style=flat-square)](https://packagist.org/packages/drupol/phptree)
 [![Total Downloads](https://img.shields.io/packagist/dt/drupol/phptree.svg?style=flat-square)](https://packagist.org/packages/drupol/phptree)
 [![Build Status](https://img.shields.io/travis/drupol/phptree/master.svg?style=flat-square)](https://travis-ci.org/drupol/phptree)
 [![Scrutinizer code quality](https://img.shields.io/scrutinizer/quality/g/drupol/phptree/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/drupol/phptree/?branch=master)
 [![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/drupol/phptree/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/drupol/phptree/?branch=master)
 [![Mutation testing badge](https://badge.stryker-mutator.io/github.com/drupol/phptree/master)](https://stryker-mutator.github.io)
 [![License](https://img.shields.io/packagist/l/drupol/phptree.svg?style=flat-square)](https://packagist.org/packages/drupol/phptree)

# PhpTree

## Description

A PHP implementation of tree data structure.

It provides different trees implementations:
* **Node**: The base class.
* **N-ary node**: (or K-ary tree) extends the base class and allows you to specify the capacity of a node, the maximum children a node can have.
* **Value node**: extends the N-ary node and allows you to attach a value to the node.
* **KeyValue node**: extends the Value node and allows you to attach a key and a value to the node.
* **Trie node**: extends the KeyValue node, a simple [Trie tree](https://en.wikipedia.org/wiki/Trie).
* **Auto-balanced node**: extends the N-ary node and tries to keep the tree as symetric as possible. It automatically balance all the children as soon as they are added.

[4 trees traversal algorithms](https://en.wikipedia.org/wiki/Tree_traversal):
* **In order**
* **Post order**
* **Pre order**
* **Breadth first**

Exporters and importers:
* **Ascii**: Export a tree into an ascii graphic, just for swag and visualisation fun.
* **Graph**: Export a tree into a graph using the [graphp/graphp](https://github.com/graphp/graph) library.
* **Text**: Export a tree into a simple string, easy for storing in a database.

Modifier:
* **Reverse**: To reverse a tree, all the children are mirrored.

## Documentation

API documentation is automatically generated with [APIGen](https://github.com/ApiGen/ApiGen) and available at [this address](https://not-a-number.io/phptree/).

Blog post: [https://not-a-number.io/2018/phptree-a-fast-tree-implementation](https://not-a-number.io/2018/phptree-a-fast-tree-implementation)

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
use drupol\phptree\Exporter\Graph;
use drupol\phptree\Node\ValueNode;
use drupol\phptree\Exporter\Text;

include './vendor/autoload.php';

// Create the root node.
$tree = new ValueNode('root', 2);

$nodes = [];
foreach (\range('A', 'Z') as $v) {
    $nodes[] = new ValueNode($v);
}

// Add children to the root node.
$tree->add(...$nodes);

// Export to an image.
$graphViz = new GraphViz();
$graphExporter = new Graph();
$graphViz->display($graphExporter->export($tree));

// Export to text.
$textExporter = new Text();
echo $textExporter->export($tree); // [root [A [C [G [O] [P]] [H [Q] [R]]] [D [I [S] [T]] [J [U] [V]]]] [B [E [K [W] [X]] [L [Y] [Z]]] [F [M] [N]]]]⏎
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
