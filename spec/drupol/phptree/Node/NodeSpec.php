<?php

namespace spec\drupol\phptree\Node;

use drupol\phptree\Node\Node;
use drupol\phptree\Node\NodeInterface;
use PhpSpec\ObjectBehavior;

class NodeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Node::class);
    }

    public function it_can_add(NodeInterface $node)
    {
        $node->setParent($this)->shouldBeCalledOnce();

        $this->add($node)
            ->shouldReturn($this);
    }

    public function it_can_get_the_size()
    {
        $nodes = [];
        $linearNodes = [];
        foreach (\range('a', 'e') as $lowercaseValue) {
            $node1 = new Node();
            $linearNodes[] = $node1;

            foreach (\range('A', 'E') as $uppercaseValue) {
                $node2 = new Node();
                $linearNodes[] = $node2;

                $node1->add($node2);
            }

            $nodes[] = $node1;
        }

        $this->add(...$nodes);

        $this
            ->count()
            ->shouldReturn(30);
    }

    public function it_can_get_and_set_the_parent(NodeInterface $parent)
    {
        $this
            ->getParent()
            ->shouldReturn(NULL);

        $this
            ->setParent($parent)
            ->getParent()
            ->shouldReturn($parent);
    }

    public function it_can_get_its_children()
    {
        $this
            ->children()
            ->shouldReturn([]);

        $node = new Node();

        $this
            ->add($node)
            ->add($node)
            ->children()
            ->shouldReturn([$node, $node]);
    }

    public function it_can_check_if_its_a_leaf()
    {
        $this
            ->isLeaf()
            ->shouldReturn(TRUE);

        $node = new Node();

        $this
            ->add($node)
            ->isLeaf()
            ->shouldReturn(FALSE);
    }

    public function it_has_a_degree()
    {
        $this
            ->degree()
            ->shouldReturn(0);

        $node = new Node();

        $this
            ->add($node)
            ->degree()
            ->shouldReturn(1);
    }

    public function it_can_count_its_children()
    {
        $this
            ->count()
            ->shouldReturn(0);

        $node = new Node();

        $this
            ->add($node)
            ->count()
            ->shouldReturn(1);
    }

    public function it_can_check_if_node_is_root()
    {
        $this
            ->isRoot()
            ->shouldReturn(TRUE);

        $node = new Node();

        $this
            ->setParent($node)
            ->isRoot()
            ->shouldReturn(FALSE);
    }

    public function it_can_get_its_ancestors()
    {
        $this
            ->getAncestors()
            ->shouldReturn([]);

        $node1 = new Node();
        $node2 = new Node($node1);
        $node3 = new Node($node2);

        $this->setParent($node3);

        $this
            ->getAncestors()
            ->shouldReturn([$node1, $node2, $node3]);
    }

    public function it_can_get_its_sibblings()
    {
        $this
            ->getSibblings()
            ->shouldReturn([]);

        $node1 = new Node();
        $node2 = new Node();
        $node3 = new Node();

        $node1->add($this->getWrappedObject(), $node2, $node3);

        $this
            ->getSibblings()
            ->shouldReturn([$node2, $node3]);
    }
}
