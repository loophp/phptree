<?php

declare(strict_types = 1);

namespace drupol\phptree\tests\Converter;

use drupol\phptree\Converter\Graph;
use drupol\phptree\Node\NodeInterface;
use Fhaculty\Graph\Vertex;

/**
 * Class ValueGraph
 */
class ValueGraph extends Graph
{
    /**
     * {@inheritdoc}
     */
    protected function createVertex(NodeInterface $node): Vertex
    {
        return parent::createVertex($node);
    }

    /**
     * {@inheritdoc}
     */
    protected function createVertexId(NodeInterface $node)
    {
        if (\method_exists($node, 'getValue')) {
            return $node->getValue();
        }

        return \sha1((string) parent::createVertexId($node));
    }
}
