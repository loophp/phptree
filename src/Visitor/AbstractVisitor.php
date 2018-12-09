<?php

declare(strict_types = 1);

namespace drupol\phptree\Visitor;

use drupol\phptree\Node\NodeInterface;

/**
 * Class AbstractVisitor
 */
abstract class AbstractVisitor implements VisitorInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public function traverse(NodeInterface $node): \Traversable;
}
