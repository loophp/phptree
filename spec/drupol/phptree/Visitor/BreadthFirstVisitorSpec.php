<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Visitor;

use drupol\phptree\Node\Node;
use drupol\phptree\Visitor\BreadthFirstVisitor;
use PhpSpec\ObjectBehavior;

class BreadthFirstVisitorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(BreadthFirstVisitor::class);
    }

    public function it_can_traverse_a_tree()
    {
        $tree = new Node();

        $nodes = [];
        $nodes1 = [];
        $nodes2 = [];
        foreach (\range('1', '5') as $lowercaseValue) {
            $node1 = new Node();

            foreach (\range('A', 'E') as $uppercaseValue) {
                $node2 = new Node();

                $node1->add($node2);

                $nodes2[] = $node2;
            }

            $nodes1[] = $node1;
            $nodes[] = $node1;
        }

        $tree->add(...$nodes);

        $rootAndNodes = \array_merge([$tree], $nodes1, $nodes2);

        $this
            ->traverse($tree)
            ->shouldYield(new \ArrayIterator($rootAndNodes));
    }
}
