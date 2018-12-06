<?php

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
    public function traverse(NodeInterface $node): \Traversable
    {
        $queue = new \SplQueue();
        $queue->enqueue($node);

        yield $node;

        while ($queue->count() > 0) {
            foreach ($queue->dequeue()->children() as $child) {
                $queue->enqueue($child);

                yield $child;
            }
        }
    }
}
