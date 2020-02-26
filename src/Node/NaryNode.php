<?php

declare(strict_types=1);

namespace loophp\phptree\Node;

use Exception;
use loophp\phptree\Traverser\BreadthFirst;
use loophp\phptree\Traverser\TraverserInterface;
use OutOfBoundsException;

/**
 * Class NaryNode.
 */
class NaryNode extends Node implements NaryNodeInterface
{
    /**
     * @var int
     */
    private $capacity;

    /**
     * @var \loophp\phptree\Traverser\TraverserInterface
     */
    private $traverser;

    /**
     * NaryNode constructor.
     *
     * @param int|null $capacity
     *   The maximum children a node can have. Null for no children,
     *   if 0 then any number of children is allowed.
     * @param \loophp\phptree\Traverser\TraverserInterface|null $traverser
     *   The traverser.
     * @param \loophp\phptree\Node\NodeInterface|null $parent
     *   The parent.
     */
    public function __construct(
        ?int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($parent);

        $this->capacity = $capacity;

        $this->traverser = $traverser ?? new BreadthFirst();
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
                throw new Exception('Unable to add the node to the tree.');
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function capacity(): ?int
    {
        return $this->capacity;
    }

    /**
     * {@inheritdoc}
     */
    public function getTraverser(): TraverserInterface
    {
        return $this->traverser;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value): void
    {
        if (null === $offset) {
            $this->add($value);
        } else {
            if (0 !== $this->capacity()) {
                if ($this->capacity() - 1 < $offset) {
                    throw new OutOfBoundsException('The offset is out of range.');
                }
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
     * @param \loophp\phptree\Node\NodeInterface $tree
     *   The base node.
     *
     * @return \loophp\phptree\Node\NodeInterface|null
     *   A node, null if none are found.
     */
    protected function findFirstAvailableNode(NodeInterface $tree): ?NodeInterface
    {
        foreach ($this->getTraverser()->traverse($tree) as $candidate) {
            if (!($candidate instanceof NaryNodeInterface)) {
                continue;
            }

            $capacity = $candidate->capacity();

            if (null === $capacity) {
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
