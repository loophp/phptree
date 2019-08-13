<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Traverser;

use drupol\phptree\Node\Node;
use drupol\phptree\Traverser\BreadthFirst;
use PhpSpec\ObjectBehavior;

class BreadthFirstSpec extends ObjectBehavior
{
    public function it_can_traverse_a_tree(): void
    {
        $tree = new Node();

        $nodes = [];
        $nodes1 = [];
        $nodes2 = [];

        foreach (range('1', '5') as $lowercaseValue) {
            $node1 = new Node();

            foreach (range('A', 'E') as $uppercaseValue) {
                $node2 = new Node();

                $node1->add($node2);

                $nodes2[] = $node2;
            }

            $nodes1[] = $node1;
            $nodes[] = $node1;
        }

        $tree->add(...$nodes);

        $rootAndNodes = array_merge([$tree], $nodes1, $nodes2);

        $this
            ->traverse($tree)
            ->shouldYield(new \ArrayIterator($rootAndNodes));
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(BreadthFirst::class);
    }
}
