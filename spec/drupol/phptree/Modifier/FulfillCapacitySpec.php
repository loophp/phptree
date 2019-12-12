<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Modifier;

use drupol\phptree\Modifier\FulfillCapacity;
use drupol\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class FulfillCapacitySpec extends ObjectBehavior
{
    public function it_can_fulfill_missing_node()
    {
        $tree = new ValueNode('root', 10);

        $nodes = [];

        foreach (range('A', 'E') as $value) {
            $nodes[] = new ValueNode($value);
        }
        $tree->add(...$nodes);

        $this
            ->modify($tree)
            ->count()
            ->shouldReturn(10);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FulfillCapacity::class);
    }
}
