<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Visitor;

use drupol\phptree\Node\Node;
use drupol\phptree\Visitor\PreOrderVisitor;
use PhpSpec\ObjectBehavior;

class PreOrderVisitorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PreOrderVisitor::class);
    }

    public function it_can_traverse_a_tree()
    {
        $tree = new Node();

        $data = \range('A', 'E');

        $nodes = [];
        foreach ($data as $key => $value) {
            $nodes[] = new Node();
        }

        $tree->add(...$nodes);

        $rootAndNodes = \array_merge([$tree], $nodes);

        $this
            ->traverse($tree)
            ->shouldYield(new \ArrayIterator($rootAndNodes));
    }
}
