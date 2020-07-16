<?php

declare(strict_types=1);

namespace loophp\phptree\Node;

use InvalidArgumentException;
use Traversable;

use function array_key_exists;
use function count;
use function in_array;

/**
 * Class Node.
 */
class Node implements NodeInterface
{
    /**
     * @var array<\loophp\phptree\Node\NodeInterface>
     */
    private $children = [];

    /**
     * @var NodeInterface|null
     */
    private $parent;

    /**
     * Node constructor.
     */
    public function __construct(?NodeInterface $parent = null)
    {
        $this->parent = $parent;
        $this->children = [];
    }

    /**
     * {@inheritdoc}
     */
    public function __clone()
    {
        /** @var NodeInterface $child */
        foreach ($this->children as $id => $child) {
            $this->children[$id] = $child->clone()->setParent($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        foreach ($nodes as $node) {
            $this->children[] = $node->setParent($this);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function all(): Traversable
    {
        yield $this;

        /** @var NodeInterface $child */
        foreach ($this->children() as $child) {
            yield from $child->all();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function children(): Traversable
    {
        yield from $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function clone(): NodeInterface
    {
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return iterator_count($this->all()) - 1;
    }

    /**
     * {@inheritdoc}
     */
    public function degree(): int
    {
        return count($this->children);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(NodeInterface $node, ?NodeInterface $root = null): ?NodeInterface
    {
        $root = $root ?? $this;

        if (null !== ($candidate = $this->find($node))) {
            if ($candidate === $root) {
                throw new InvalidArgumentException('Unable to delete root node.');
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
        return iterator_count($this->getAncestors());
    }

    /**
     * {@inheritdoc}
     */
    public function find(NodeInterface $node): ?NodeInterface
    {
        /** @var NodeInterface $candidate */
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
    public function getAncestors(): Traversable
    {
        $node = $this;

        while ($node = $node->getParent()) {
            yield $node;
        }
    }

    /**
     * @return Traversable<\loophp\phptree\Node\NodeInterface>
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
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getSibblings(): Traversable
    {
        $parent = $this->parent;

        if (null === $parent) {
            return [];
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

        /** @var NodeInterface $child */
        foreach ($this->children() as $child) {
            $height = max($height, $child->height());
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
        return null === $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function label(): string
    {
        return sha1(spl_object_hash($this));
    }

    /**
     * {@inheritdoc}
     */
    public function level(int $level): Traversable
    {
        /** @var NodeInterface $node */
        foreach ($this->all() as $node) {
            if ($node->depth() === $level) {
                yield $node;
            }
        }
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->children);
    }

    /**
     * @param mixed $offset
     *
     * @return NodeInterface
     */
    public function offsetGet($offset)
    {
        return $this->children[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if (!($value instanceof NodeInterface)) {
            throw new InvalidArgumentException(
                'The value must implements NodeInterface.'
            );
        }

        $this->children[$offset] = $value->setParent($this);
    }

    /**
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->children[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(NodeInterface ...$nodes): NodeInterface
    {
        $this->children =
            array_filter(
                $this->children,
                static function ($child) use ($nodes) {
                    return !in_array($child, $nodes, true);
                }
            );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function replace(NodeInterface $node): ?NodeInterface
    {
        if (null === $parent = $this->getParent()) {
            return null;
        }

        // Find the key of the current node in the parent.
        foreach ($parent->children() as $key => $child) {
            if ($this === $child) {
                $parent[$key] = $node;

                break;
            }
        }

        return $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(?NodeInterface $node): NodeInterface
    {
        $this->parent = $node;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withChildren(?NodeInterface ...$nodes): NodeInterface
    {
        $clone = clone $this;
        $clone->children = [];

        $nodes = array_filter($nodes);

        return [] === $nodes ?
            $clone :
            $clone->add(...$nodes);
    }
}
