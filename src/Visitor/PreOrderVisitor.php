<?php

declare(strict_types = 1);

namespace drupol\phptree\Visitor;

use drupol\phptree\Node\NodeInterface;

/**
 * Class PreOrderVisitor
 */
class PreOrderVisitor extends AbstractVisitor
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
        if (null === $level || $level === $node->depth()) {
            yield $this->index => $node;
        }

        foreach ($node->children() as $child) {
            $this->index++;
            yield from $this->doTraverse($child, $level);
        }
    }
}
