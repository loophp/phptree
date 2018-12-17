<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class Node
 */
class Node implements NodeInterface
{
    /**
     * The storage property.
     *
     * @var array
     */
    protected $storage;

    /**
     * Node constructor.
     *
     * @param \drupol\phptree\Node\NodeInterface|null $parent
     */
    public function __construct(NodeInterface $parent = null)
    {
        $this->storage = [
            'parent' => $parent,
            'children' => [],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        foreach ($nodes as $node) {
            $this->storage['children'][] = $node->setParent($this);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(NodeInterface ...$nodes): NodeInterface
    {
        $this->storage['children'] = \array_filter(
            $this->storage['children'],
            function ($child) use ($nodes) {
                return !\in_array($child, $nodes, true);
            }
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(NodeInterface $node): NodeInterface
    {
        $this->storage['parent'] = $node;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?NodeInterface
    {
        return $this->storage['parent'];
    }

    /**
     * {@inheritdoc}
     */
    public function children(): \Traversable
    {
        yield from new \ArrayIterator($this->storage['children']);
    }

    /**
     * {@inheritdoc}
     */
    public function lastChild(): ?NodeInterface
    {
        return (false === $end = \end($this->storage['children'])) ?
            null:
            $end;
    }

    /**
     * {@inheritdoc}
     */
    public function getAncestors(): \Traversable
    {
        $node = $this;

        while ($node = $node->getParent()) {
            yield $node;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isLeaf(): bool
    {
        return [] === $this->storage['children'];
    }

    /**
     * {@inheritdoc}
     */
    public function isRoot(): bool
    {
        return null === $this->storage['parent'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSibblings(): \Traversable
    {
        $parent = $this->storage['parent'];

        if (null === $parent) {
            return new \ArrayIterator([]);
        }

        foreach ($parent->children() as $child) {
            if ($child === $this) {
                continue;
            }

            yield $child;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function degree(): int
    {
        return \count($this->storage['children']);
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        $count = 0;

        /** @var \drupol\phptree\Node\NodeInterface $child */
        foreach ($this->children() as $child) {
            $count += 1 + $child->count();
        }

        return $count;
    }

    /**
     * {@inheritdoc}
     */
    public function withChildren(NodeInterface ...$nodes): NodeInterface
    {
        $clone = clone $this;
        $clone->storage['children'] = [];

        return [] === $nodes ?
            $clone:
            $clone->add(...$nodes);
    }

    /**
     * {@inheritdoc}
     */
    public function depth(): int
    {
        return \iterator_count($this->getAncestors());
    }
}
