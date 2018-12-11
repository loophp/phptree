<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Visitor;

use drupol\phptree\Node\NaryNode;
use drupol\phptree\Node\Node;
use drupol\phptree\Node\ValueNode;
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

    public function it_can_traverse_a_tree_with_a_specific_level()
    {
        $tree = new NaryNode(2);

        $data = \range('A', 'G');

        $nodes = [];
        foreach ($data as $key => $value) {
            $nodes[$value] = new ValueNode($value);
        }

        $tree->add(...\array_values($nodes));

        $nodes['root'] = $tree;

        $order = [
            0 => $nodes['root'],
        ];

        $this
            ->traverse($tree, 0)
            ->shouldYield(new \ArrayIterator($order));

        $order = [
            1 => $nodes['A'],
            5 => $nodes['B'],
        ];

        $this
            ->traverse($tree, 1)
            ->shouldYield(new \ArrayIterator($order));
    }
}
