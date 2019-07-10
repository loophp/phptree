<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Node\ABNode;

class ABNodeSpec extends NodeObjectBehavior
{
    public function it_balance_a_tree(): void
    {
        $this->beConstructedWith(1);

        $data = \range(0, 40);

        $nodes = [];

        foreach ($data as $key => $value) {
            $nodes[$key] = new ABNode(2);
        }

        $this
            ->add(...$nodes);

        $this->offsetGet(0)->count()->shouldReturn(40);
        $this
            ->offsetGet(0)
            ->offsetGet(0)
            ->count()
            ->shouldReturn(19);
        $this
            ->offsetGet(0)
            ->offsetGet(1)
            ->count()
            ->shouldReturn(19);

        $this
            ->add(new ABNode(2));

        $this
            ->offsetGet(0)
            ->offsetGet(0)
            ->count()
            ->shouldReturn(19);
        $this
            ->offsetGet(0)
            ->offsetGet(1)
            ->count()
            ->shouldReturn(20);

        $this
            ->add(new ABNode(2));

        $this
            ->offsetGet(0)
            ->offsetGet(0)
            ->count()
            ->shouldReturn(20);
        $this
            ->offsetGet(0)
            ->offsetGet(1)
            ->count()
            ->shouldReturn(20);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ABNode::class);
    }
}
