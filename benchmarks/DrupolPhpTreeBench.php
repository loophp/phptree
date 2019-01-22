<?php

declare(strict_types = 1);

namespace drupol\phptree\benchmarks;

use drupol\phptree\Node\ValueNode;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;

/**
 * @Groups({"drupol/phptree"})
 * @BeforeMethods({"initObject"})
 */
class DrupolPhpTreeBench extends AbstractBench
{
    /**
     * @var \drupol\phptree\Node\NodeInterface
     */
    private $tree;

    /**
     * @Revs({1, 100, 1000})
     * @Iterations(5)
     * @Warmup(10)
     */
    public function benchTreeAdd()
    {
        $this->tree = new ValueNode('root', 2);

        foreach ($this->getData() as $value) {
            $this->tree->add(new ValueNode($value, 2));
        }
    }

    /**
     * Init the object.
     */
    public function initObject()
    {
    }
}
