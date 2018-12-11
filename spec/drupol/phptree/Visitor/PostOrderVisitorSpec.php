<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Visitor;

use drupol\phptree\Node\NaryNode;
use drupol\phptree\Node\Node;
use drupol\phptree\Node\ValueNode;
use drupol\phptree\Visitor\PostOrderVisitor;
use PhpSpec\ObjectBehavior;

class PostOrderVisitorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PostOrderVisitor::class);
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

        $nodes[] = $tree;

        $this
            ->traverse($tree)
            ->shouldYield(new \ArrayIterator($nodes));
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
            7 => $nodes['root'],
        ];

        $this
            ->traverse($tree, 0)
            ->shouldYield(new \ArrayIterator($order));

        $order = [
            3 => $nodes['A'],
            6 => $nodes['B'],
        ];

        $this
            ->traverse($tree, 1)
            ->shouldYield(new \ArrayIterator($order));
    }
}
