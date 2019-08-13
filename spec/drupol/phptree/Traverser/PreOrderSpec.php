<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Traverser;

use drupol\phptree\Node\Node;
use drupol\phptree\Traverser\PreOrder;
use PhpSpec\ObjectBehavior;

class PreOrderSpec extends ObjectBehavior
{
    public function it_can_traverse_a_tree(): void
    {
        $tree = new Node();

        $data = range('A', 'E');

        $nodes = [];

        foreach ($data as $key => $value) {
            $nodes[] = new Node();
        }

        $tree->add(...$nodes);

        $rootAndNodes = array_merge([$tree], $nodes);

        $this
            ->traverse($tree)
            ->shouldYield(new \ArrayIterator($rootAndNodes));
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(PreOrder::class);
    }
}
