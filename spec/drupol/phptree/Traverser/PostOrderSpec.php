<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Traverser;

use drupol\phptree\Node\Node;
use drupol\phptree\Traverser\PostOrder;
use PhpSpec\ObjectBehavior;

class PostOrderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PostOrder::class);
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
