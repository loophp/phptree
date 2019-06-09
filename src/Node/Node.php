<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

use drupol\phptree\Storage\NodeStorage;
use drupol\phptree\Storage\StorageInterface;

/**
 * Class Node.
 */
class Node implements NodeInterface
{
    /**
     * The storage property.
     *
     * @var \drupol\phptree\Storage\NodeStorageInterface
     */
    private $storage;

    /**
     * Node constructor.
     *
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     */
    public function __construct(NodeInterface $parent = null)
    {
        $this->storage = new NodeStorage();
        $this->storage()->setParent($parent);
    }

    /**
     * {@inheritdoc}
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        foreach ($nodes as $node) {
            $this->storage()->getChildren()->append(
                $node->setParent($this)
            );
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function all(): \Traversable
    {
        yield $this;

        foreach ($this->children() as $candidate) {
            yield from $candidate->all();
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return \drupol\phptree\Node\NodeInterface|\Traversable
     */
    public function children(): \Traversable
    {
        yield from $this->storage()->getChildren();
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        $count = -1;

        foreach ($this->all() as $node) {
            ++$count;
        }

        return $count;
    }

    /**
     * {@inheritdoc}
     */
    public function degree(): int
    {
        return $this->storage()->getChildren()->count();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(NodeInterface $node, NodeInterface $root = null): ?NodeInterface
    {
        $root = $root ?? $this;

        if ($candidate = $this->find($node)) {
            if ($candidate === $root) {
                throw new \InvalidArgumentException('Unable to delete root node.');
            }

            if (null !== $parent = $candidate->getParent()) {
                $parent->remove($node);
            }

            return $candidate->setParent(null);
        }

        return null;
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
    public function find(NodeInterface $node): ?NodeInterface
    {
        foreach ($this->all() as $candidate) {
            if ($candidate === $node) {
                return $node;
            }
        }

        return null;
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
        yield from $this->all();
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?NodeInterface
    {
        return $this->storage()->getParent();
    }

    /**
     * {@inheritdoc}
     */
    public function getSibblings(): \Traversable
    {
        $parent = $this->storage()->getParent();

        if (null === $parent) {
            return $this->storage()->getChildren()->exchangeArray([]);
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
        return 0 === $this->degree();
    }

    /**
     * {@inheritdoc}
     */
    public function isRoot(): bool
    {
        return null === $this->storage()->getParent();
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->storage()->getChildren()->offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->storage()->getChildren()->offsetGet($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (!($value instanceof NodeInterface)) {
            throw new \InvalidArgumentException(
                'The value must implements NodeInterface.'
            );
        }

        $this->storage()->getChildren()
            ->offsetSet($offset, $value->setParent($this));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->storage()->getChildren()->offsetUnset($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(NodeInterface ...$nodes): NodeInterface
    {
        $this->storage()->getChildren()->exchangeArray(
            \array_filter(
                $this->storage()->getChildren()->getArrayCopy(),
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
    public function setParent(?NodeInterface $node): NodeInterface
    {
        $this->storage()->setParent($node);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withChildren(NodeInterface ...$nodes): NodeInterface
    {
        $clone = clone $this;
        $clone->storage()->getChildren()->exchangeArray([]);

        return [] === $nodes ?
            $clone :
            $clone->add(...$nodes);
    }

    /**
     * {@inheritdoc}
     *
     * @return \drupol\phptree\Storage\NodeStorageInterface
     */
    protected function storage(): StorageInterface
    {
        return $this->storage;
    }
}
