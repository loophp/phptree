<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Node\NaryNode;
use drupol\phptree\Node\ValueNode;
use drupol\phptree\Traverser\TraverserInterface;

class NaryNodeSpec extends NodeObjectBehavior
{
    public function it_can_be_counted()
    {
        $this->beConstructedWith(2);

        foreach (\range('A', 'Z') as $value) {
            $this->add(new ValueNode($value, 3));
        }

        $this
            ->count()
            ->shouldReturn(26);
    }

    public function it_can_get_its_traverser()
    {
        $this->getTraverser()->shouldBeAnInstanceOf(TraverserInterface::class);
    }

    public function it_can_get_the_capacity()
    {
        $this
            ->capacity()
            ->shouldReturn(0);
    }

    public function it_can_get_the_capacity_when_using_a_custom_capacity()
    {
        $this->beConstructedWith(3);

        $this
            ->capacity()
            ->shouldReturn(3);
    }

    public function it_can_throw_an_error_when_capacity_is_invalid()
    {
        $this->beConstructedWith(-5);

        $this
            ->capacity()
            ->shouldReturn(0);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(NaryNode::class);
    }
}
