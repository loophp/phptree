<?php

declare(strict_types = 1);

namespace drupol\phptree\tests;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Render\GraphViz;

/**
 * Class TestGraphViz
 */
class TestGraphViz extends GraphViz
{
    /**
     * {@inheritdoc}
     */
    protected function hash(NodeInterface $node)
    {
        return $node->getValue();
    }
}
