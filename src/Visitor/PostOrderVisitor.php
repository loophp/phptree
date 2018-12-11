<?php

declare(strict_types = 1);

namespace drupol\phptree\Visitor;

use drupol\phptree\Node\NodeInterface;

/**
 * Class PostOrderVisitor
 */
class PostOrderVisitor extends AbstractVisitor
{
    /**
     * @var int
     */
    private $index = 0;

    /**
     * {@inheritdoc}
     */
    public function traverse(NodeInterface $node, int $level = null): \Traversable
    {
        $this->index = 0;

        return $this->doTraverse($node, $level);
    }

    /**
     * {@inheritdoc}
     */
    private function doTraverse(NodeInterface $node, int $level = null): \Traversable
    {
        foreach ($node->children() as $child) {
            yield from $this->doTraverse($child, $level);
            $this->index++;
        }

        if (null === $level || $level === $node->depth()) {
            yield $this->index => $node;
        }
    }
}
