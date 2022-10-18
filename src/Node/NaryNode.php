<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

use Exception;
use loophp\phptree\Traverser\BreadthFirst;
use loophp\phptree\Traverser\TraverserInterface;
use OutOfBoundsException;

class NaryNode extends Node implements NaryNodeInterface
{
    private int $capacity;

    private TraverserInterface $traverser;

    /**
     * @param int $capacity
     *   The maximum children a node can have. Null for no children,
     *   if 0 then any number of children is allowed.
     */
    public function __construct(
        int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($parent);

        $this->capacity = $capacity;
        $this->traverser = $traverser ?? new BreadthFirst();
    }

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

    public function capacity(): int
    {
        return $this->capacity;
    }

    public function getTraverser(): TraverserInterface
    {
        return $this->traverser;
    }

    public function offsetSet($offset, $value): void
    {
        if (null === $offset) {
            $this->add($value);
        } else {
            if (0 !== $this->capacity() && $this->capacity() - 1 < $offset) {
                throw new OutOfBoundsException('The offset is out of range.');
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
     * @param NodeInterface $tree
     *   The base node.
     *
     * @return NodeInterface|null
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
