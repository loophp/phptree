<?php

namespace drupol\phptree\Visitor;

use drupol\phptree\Node\NodeInterface;

abstract class AbstractVisitor
{
    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return \Traversable
     */
    abstract public function traverse(NodeInterface $node): \Traversable;
}
