<?php

declare(strict_types = 1);

namespace drupol\phptree\Visitor;

use drupol\phptree\Node\NodeInterface;

/**
 * Class BreadthFirstVisitor
 */
class BreadthFirstVisitor extends AbstractVisitor
{
    /**
     * {@inheritdoc}
     */
    public function traverse(NodeInterface $node, int $level = null): \Traversable
    {
        $queue = new \SplQueue();
        $queue->enqueue($node);

        if (null === $level || $level === $node->depth()) {
            yield $node;
        }

        while ($queue->count() > 0) {
            foreach ($queue->dequeue()->children() as $child) {
                $queue->enqueue($child);

                if (null === $level || $level === $child->depth()) {
                    yield $child;
                }
            }
        }
    }
}
