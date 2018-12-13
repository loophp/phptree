<?php

declare(strict_types = 1);

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

    public function it_can_remove()
    {
        $node1 = new Node();
        $node2 = new Node();

        $this
            ->add($node1, $node2);

        $this
            ->remove($node2);

        $this->children()[0]->shouldReturn($node1);

        $this
            ->remove($node1);

        $this->children()->shouldReturn([]);
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

    public function it_can_get_the_last_children()
    {
        $this
            ->lastChild()
            ->shouldReturn(null);

        $node = new Node();

        $this
            ->add($node)
            ->lastChild()
            ->shouldReturn($node);
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
            ->shouldYield(new \ArrayIterator([]));

        $root = new Node();
        $level1 = new Node($root);
        $level2 = new Node($level1);

        $this->setParent($level2);

        $this
            ->getAncestors()
            ->shouldYield(new \ArrayIterator([$level2, $level1, $root]));
    }

    public function it_can_get_its_sibblings()
    {
        $this
            ->getSibblings()
            ->shouldYield(new \ArrayIterator([]));

        $node1 = new Node();
        $node2 = new Node();
        $node3 = new Node();

        $node1->add($this->getWrappedObject(), $node2, $node3);

        $this
            ->getSibblings()
            ->shouldYield(new \ArrayIterator([$node2, $node3]));
    }

    public function it_can_use_withChildren()
    {
        $this
            ->withChildren()
            ->shouldNotReturn($this);

        $child = new Node();

        $this
            ->withChildren($child)
            ->children()
            ->shouldReturn([$child]);

        $this
            ->withChildren()
            ->children()
            ->shouldReturn([]);
    }

    public function it_can_get_its_depth()
    {
        $this
            ->depth()
            ->shouldReturn(0);

        $tree = new \drupol\phptree\Node\ValueNode('root', 2);

        $tree->add($this->getWrappedObject());

        $this
            ->depth()
            ->shouldReturn(1);

        $nodes = [];
        foreach (\range('A', 'Z') as $v) {
            $nodes[] = new \drupol\phptree\Node\ValueNode($v);
        }

        $tree->add(...$nodes);

        $tree->add($this->getWrappedObject());

        $this
            ->depth()
            ->shouldReturn(4);
    }
}
