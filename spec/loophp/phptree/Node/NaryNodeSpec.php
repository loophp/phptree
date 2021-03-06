<?php

declare(strict_types=1);

namespace spec\loophp\phptree\Node;

use Exception;
use loophp\phptree\Node\NaryNode;
use loophp\phptree\Node\Node;
use loophp\phptree\Node\ValueNode;
use loophp\phptree\Traverser\BreadthFirst;
use loophp\phptree\Traverser\PreOrder;
use loophp\phptree\Traverser\TraverserInterface;

class NaryNodeSpec extends NodeObjectBehavior
{
    public function it_can_be_counted(): void
    {
        $this->beConstructedWith(2);

        foreach (range('A', 'Z') as $value) {
            $this->add(new ValueNode($value, 3));
        }

        $this
            ->count()
            ->shouldReturn(26);
    }

    public function it_can_get_its_traverser(): void
    {
        $this->getTraverser()->shouldBeAnInstanceOf(TraverserInterface::class);
    }

    public function it_can_get_the_capacity(): void
    {
        $this
            ->capacity()
            ->shouldReturn(0);
    }

    public function it_can_get_the_capacity_when_using_a_custom_capacity(): void
    {
        $this->beConstructedWith(3);

        $this
            ->capacity()
            ->shouldReturn(3);
    }

    public function it_can_have_children(): void
    {
        $this->beConstructedWith(2);

        $child1 = new Node();
        $child2 = new NaryNode(2);
        $child3 = new Node();
        $child4 = new Node();

        $this
            ->add($child1, $child2, $child3, $child4);

        $this->degree()->shouldReturn(2);
        $this->count()->shouldReturn(4);

        $this->shouldThrow(Exception::class)
            ->during('add', [new Node()]);
    }

    public function it_can_throw_an_error_when_capacity_is_invalid(): void
    {
        $this->beConstructedWith();

        $this
            ->capacity()
            ->shouldBe(0);
    }

    public function it_can_use_a_different_traverser(): void
    {
        $this->beConstructedWith(2, new PreOrder());

        $this->getTraverser()->shouldBeAnInstanceOf(PreOrder::class);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(NaryNode::class);

        $this->getTraverser()->shouldBeAnInstanceOf(BreadthFirst::class);
    }
}
