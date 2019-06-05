<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class Node.
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
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     */
    public function __construct(NodeInterface $parent = null)
    {
        $this->storage = [
            'parent' => $parent,
            'children' => new \ArrayObject(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        foreach ($nodes as $node) {
            $this->storage['children']->append(
                $node->setParent($this)
            );
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function children(): \Traversable
    {
        yield from $this->storage['children'];
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
    public function degree(): int
    {
        return $this->storage['children']->count();
    }

    /**
     * {@inheritdoc}
     */
    public function depth(): int
    {
        return \iterator_count($this->getAncestors());
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
    public function getIterator()
    {
        yield from $this->children();
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
    public function height(): int
    {
        $height = $this->depth();

        foreach ($this->children() as $child) {
            $height = \max($height, $child->height());
        }

        return $height;
    }

    /**
     * {@inheritdoc}
     */
    public function isLeaf(): bool
    {
        return 0 === $this->storage['children']->count();
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
    public function offsetExists($offset)
    {
        return $this->storage['children']->offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->storage['children']->offsetGet($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (!($value instanceof NodeInterface)) {
            throw new \InvalidArgumentException('The value must implements NodeInterface.');
        }

        $this->storage['children']
            ->offsetSet($offset, $value->setParent($this));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->storage['children']->offsetUnset($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(NodeInterface ...$nodes): NodeInterface
    {
        $this->storage['children']->exchangeArray(
            \array_filter(
                $this->storage['children']->getArrayCopy(),
                static function ($child) use ($nodes) {
                    return !\in_array($child, $nodes, true);
                }
            )
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(NodeInterface $node = null): NodeInterface
    {
        $this->storage['parent'] = $node;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withChildren(NodeInterface ...$nodes): NodeInterface
    {
        $clone = clone $this;
        $clone->storage['children'] = new \ArrayObject();

        return [] === $nodes ?
            $clone :
            $clone->add(...$nodes);
    }
}
