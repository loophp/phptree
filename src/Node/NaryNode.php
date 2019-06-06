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

        $capacity = 0 > $capacity ?
            0 :
            $capacity;

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
        foreach ($nodes as $node) {
            $capacity = $this->capacity();

            if (0 === $capacity || ($this->degree() < $capacity)) {
                parent::add($node);

                continue;
            }

            foreach ($this->getTraverser()->traverse($this) as $candidate) {
                if (!($candidate instanceof NaryNodeInterface)) {
                    continue;
                }

                if ($candidate->degree() >= $candidate->capacity()) {
                    continue;
                }

                $candidate->add($node);

                break;
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
}
