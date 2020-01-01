<?php

declare(strict_types=1);

namespace loophp\phptree\benchmarks;

use loophp\phptree\Node\ValueNode;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;

/**
 * @Groups({"loophp/phptree"})
 * @BeforeMethods({"initObject"})
 */
class DrupolPhpTreeBench extends AbstractBench
{
    /**
     * @var \loophp\phptree\Node\NodeInterface
     */
    private $tree;

    /**
     * @Revs({1, 100, 1000})
     * @Iterations(5)
     * @Warmup(10)
     */
    public function benchTreeAdd(): void
    {
        $this->tree = new ValueNode('root', 2);

        foreach ($this->getData() as $value) {
            $this->tree->add(new ValueNode($value, 2));
        }
    }

    /**
     * Init the object.
     */
    public function initObject(): void
    {
    }
}
