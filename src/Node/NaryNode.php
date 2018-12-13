<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

use drupol\phptree\Traverser\BreadthFirst;

/**
 * Class NaryNode
 */
class NaryNode extends Node
{
    /**
     * @var int
     */
    private $capacity;

    /**
     * NaryNode constructor.
     *
     * @param int $capacity
     * @param \drupol\phptree\Node\NodeInterface|null $parent
     */
    public function __construct(int $capacity = 0, NodeInterface $parent = null)
    {
        parent::__construct($parent);

        $this->capacity = $capacity < 0 ?
            0:
            $capacity;
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
            $capacity = $this->capacity();

            if (0 === $capacity || $this->degree() < $capacity) {
                parent::add($node);

                continue;
            }

            // @todo Find a way to get rid of this.
            $traverser = new BreadthFirst();

            foreach ($traverser->traverse($this) as $node_visited) {
                if ($node_visited->degree() >= $capacity) {
                    continue;
                }

                $node_visited->add($node);

                break;
            }
        }

        return $this;
    }
}
