<?php

namespace spec\drupol\phptree\Visitor;

use drupol\phptree\Node\Node;
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
}
