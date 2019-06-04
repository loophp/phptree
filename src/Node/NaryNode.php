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
     *   The maximum children a node can have
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     *   The parent
     * @param null|\drupol\phptree\Traverser\TraverserInterface $traverser
     *   The traverser
     */
    public function __construct(int $capacity = 0, NodeInterface $parent = null, TraverserInterface $traverser = null)
    {
        parent::__construct($parent);

        $this->capacity = 0 > $capacity ?
            0 :
            $capacity;

        $this->traverser = $traverser ?? new BreadthFirst();
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

            foreach ($this->traverser->traverse($this) as $candidate) {
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
