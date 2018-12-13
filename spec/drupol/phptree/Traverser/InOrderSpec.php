<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Traverser;

use drupol\phptree\Node\ValueNode;
use drupol\phptree\Traverser\InOrder;
use PhpSpec\ObjectBehavior;

class InOrderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(InOrder::class);
    }

    public function it_can_traverse_a_tree()
    {
        $tree = new ValueNode('root', 2);

        foreach (\range('A', 'E') as $key => $value) {
            $nodes[$value] = new ValueNode($value, 2);
        }

        $tree->add(...\array_values($nodes));

        $nodes['root'] = $tree;
        $nodes = [
            $nodes['C'],
            $nodes['A'],
            $nodes['D'],
            $nodes['root'],
            $nodes['B'],
            $nodes['E'],
        ];

        $this
            ->traverse($tree)
            ->shouldYield(new \ArrayIterator($nodes));
    }
}
