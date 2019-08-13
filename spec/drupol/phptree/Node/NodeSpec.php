<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Node\Node;
use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNode;

class NodeSpec extends NodeObjectBehavior
{
    public function it_can_add(): void
    {
        $this->add(new Node())
            ->shouldReturn($this);
    }

    public function it_can_check_if_its_a_leaf(): void
    {
        $this
            ->isLeaf()
            ->shouldReturn(true);

        $node = new Node();

        $this
            ->add($node)
            ->isLeaf()
            ->shouldReturn(false);
    }

    public function it_can_check_if_node_is_root(): void
    {
        $this
            ->isRoot()
            ->shouldReturn(true);

        $node = new Node();

        $node->add($this->getWrappedObject());

        $this
            ->isRoot()
            ->shouldReturn(false);
    }

    public function it_can_count_its_children(): void
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

    public function it_can_delete(): void
    {
        $node1 = new Node();
        $node2 = new Node();
        $node3 = new Node();
        $node4 = new Node();
        $node3->add($node4);

        $this
            ->add($node1, $node2, $node3);

        $this
            ->count()
            ->shouldReturn(4);

        $this
            ->delete($node2)
            ->shouldReturn($node2);

        $this
            ->degree()
            ->shouldReturn(2);

        $this
            ->count()
            ->shouldReturn(3);

        $this
            ->delete($node3)
            ->shouldReturn($node3);

        $this
            ->degree()
            ->shouldReturn(1);

        $node5 = new Node();

        $this
            ->delete($node5)
            ->shouldReturn(null);

        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('delete', [$this]);
    }

    public function it_can_get_and_set_the_parent(NodeInterface $parent): void
    {
        $this
            ->getParent()
            ->shouldReturn(null);

        $node = new Node();
        $node->add($this->getWrappedObject());

        $this
            ->getParent()
            ->shouldReturn($node);
    }

    public function it_can_get_its_ancestors(): void
    {
        $this
            ->getAncestors()
            ->shouldYield(new \ArrayIterator([]));

        $root = new Node();
        $level1 = new Node($root);
        $level2 = new Node($level1);

        $level2->add($this->getWrappedObject());

        $this
            ->getAncestors()
            ->shouldYield(new \ArrayIterator([$level2, $level1, $root]));
    }

    public function it_can_get_its_children(): void
    {
        $this
            ->children()
            ->shouldBeAnInstanceOf(\Generator::class);

        $this
            ->children()
            ->shouldYield(new \ArrayIterator([]));

        $node = new Node();

        $this
            ->add($node)
            ->add($node)
            ->children()
            ->shouldYield(new \ArrayIterator([$node, $node]));
    }

    public function it_can_get_its_depth(): void
    {
        $this
            ->depth()
            ->shouldReturn(0);

        $tree = new ValueNode('root', 2);

        $tree->add($this->getWrappedObject());

        $this
            ->depth()
            ->shouldReturn(1);

        $nodes = [];

        foreach (range('A', 'Z') as $v) {
            $nodes[] = new ValueNode($v, 2);
        }

        $tree->add(...$nodes);

        $this
            ->depth()
            ->shouldReturn(1);
    }

    public function it_can_get_its_height(): void
    {
        $this
            ->height()
            ->shouldReturn(0);

        $tree = $this;

        foreach (range('A', 'B') as $key => $v) {
            $node = new ValueNode($v, 1);
            $tree->add($node);
            $tree = $node;
        }

        $this
            ->height()
            ->shouldReturn(2);

        foreach (range('C', 'F') as $key => $v) {
            $node = new ValueNode($v, 1);
            $tree->add($node);
            $tree = $node;
        }

        $this
            ->height()
            ->shouldReturn(6);

        $this
            ->withChildren()
            ->height()
            ->shouldReturn(0);
    }

    public function it_can_get_its_sibblings(): void
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

    public function it_can_get_the_size(): void
    {
        $nodes = [];
        $linearNodes = [];

        foreach (range('a', 'e') as $lowercaseValue) {
            $node1 = new Node();
            $linearNodes[] = $node1;

            foreach (range('A', 'E') as $uppercaseValue) {
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

    public function it_can_remove(): void
    {
        $node1 = new Node();
        $node2 = new Node();
        $node3 = new Node();

        $this
            ->add($node1, $node2);

        $this
            ->remove($node2);

        $this
            ->count()
            ->shouldReturn(1);

        $this
            ->remove($node1);

        $this
            ->remove($node3);

        $this
            ->count()
            ->shouldReturn(0);
    }

    public function it_can_use_withChildren(): void
    {
        $this
            ->withChildren()
            ->shouldNotReturn($this);

        $child = new Node();

        $this
            ->withChildren($child)
            ->children()
            ->shouldYield(new \ArrayIterator([$child]));

        $this
            ->withChildren()
            ->children()
            ->shouldYield(new \ArrayIterator([]));
    }

    public function it_has_a_degree(): void
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

    public function it_is_a_traversable(): void
    {
        $node1 = new Node();
        $node2 = new Node();
        $node3 = new Node();

        $this
            ->add($node1, $node2, $node3);

        $this->shouldIterateLike($this->all());
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Node::class);
    }
}
