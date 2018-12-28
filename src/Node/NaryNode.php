<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

use drupol\phptree\Traverser\BreadthFirst;
use drupol\phptree\Traverser\TraverserInterface;

/**
 * Class NaryNode.
 */
class NaryNode extends Node
{
    /**
     * The capacity of a node, the maximum children a node can have.
     *
     * @var int
     */
    private $capacity;

    /**
     * The traverser.
     *
     * @var TraverserInterface
     */
    private $traverser;

    /**
     * NaryNode constructor.
     *
     * @param int $capacity
     *   The maximum children a node can have.
     * @param \drupol\phptree\Node\NodeInterface|null $parent
     *   The parent.
     * @param \drupol\phptree\Traverser\TraverserInterface|null $traverser
     *   The traverser.
     */
    public function __construct(int $capacity = 0, NodeInterface $parent = null, TraverserInterface $traverser = null)
    {
        parent::__construct($parent);

        $this->capacity = $capacity < 0 ?
            0:
            $capacity;

        $this->traverser = $traverser ?? new BreadthFirst();
    }

    /**
     * {@inheritdoc}
     */
    public function capacity(): int
    {
        return $this->capacity;
    }

    /**
     * {@inheritdoc}
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        foreach ($nodes as $node) {
            /** @var \drupol\phptree\Node\Node $parent */
            $parent = $this->findFirstAvailableNode();
            $parent->storage['children'][] = $node->setParent($parent);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTraverser()
    {
        return $this->traverser;
    }

    /**
     * Find first node in the tree that could have a new children.
     *
     * @return \drupol\phptree\Node\NodeInterface
     */
    private function findFirstAvailableNode(): NodeInterface
    {
        $capacity = $this->capacity();

        foreach ($this->getTraverser()->traverse($this) as $node) {
            if (\method_exists($node, 'capacity')) {
                $capacity = $node->capacity();
            }

            if ($node->degree() >= $capacity) {
                continue;
            }

            return $node;
        }

        return $this;
    }
}
