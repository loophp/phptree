<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

use drupol\phptree\Traverser\BreadthFirst;
use drupol\phptree\Traverser\TraverserInterface;

/**
 * Class NaryNode.
 */
class NaryNode extends Node implements NaryNodeInterface
{
    /**
     * NaryNode constructor.
     *
     * @param int $capacity
     *   The maximum children a node can have
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     *   The parent
     * @param null|\drupol\phptree\Traverser\TraverserInterface $traverser
     *   The traverser
     */
    public function __construct(int $capacity = 0, NodeInterface $parent = null, TraverserInterface $traverser = null)
    {
        parent::__construct($parent);

        $this->storage()->set(
            'capacity',
            $capacity
        );

        $this->storage()->set('traverser', $traverser ?? new BreadthFirst());
    }

    /**
     * {@inheritdoc}
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        $capacity = $this->capacity();

        if (0 === $capacity) {
            return parent::add(...$nodes);
        }

        foreach ($nodes as $node) {
            if ($this->degree() < $capacity) {
                parent::add($node);

                continue;
            }

            if (null !== $parent = $this->findFirstAvailableNode($this)) {
                $parent->add($node);
            } else {
                throw new \Exception('Unable to add the node to the tree.');
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function capacity(): int
    {
        return $this->storage()->get('capacity');
    }

    /**
     * {@inheritdoc}
     */
    public function getTraverser(): TraverserInterface
    {
        return $this->storage()->get('traverser');
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (null === $offset) {
            $this->add($value);
        } else {
            if ($this->capacity() - 1 < $offset) {
                throw new \OutOfBoundsException('The offset is out of range.');
            }

            parent::offsetSet($offset, $value);
        }
    }

    /**
     * Find the first available node in the tree.
     *
     * When adding nodes to a NaryNode based tree, you must traverse the tree
     * and find the first node that can be used as a parent for the node to add.
     *
     * @param \drupol\phptree\Node\NodeInterface $tree
     *   The base node.
     *
     * @return null|\drupol\phptree\Node\NodeInterface
     *   A node, null if none are found.
     */
    protected function findFirstAvailableNode(NodeInterface $tree): ?NodeInterface
    {
        foreach ($this->getTraverser()->traverse($tree) as $candidate) {
            if (!($candidate instanceof NaryNodeInterface)) {
                continue;
            }

            $capacity = $candidate->capacity();

            if (0 > $capacity) {
                continue;
            }

            if (0 !== $capacity && $candidate->degree() >= $capacity) {
                continue;
            }

            return $candidate;
        }

        return null;
    }
}
