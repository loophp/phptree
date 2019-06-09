<?php

declare(strict_types = 1);

namespace drupol\phptree\tests\Exporter;

use drupol\phptree\Exporter\Graph;
use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;
use Fhaculty\Graph\Vertex;

/**
 * Class ValueGraph.
 */
class ValueGraph extends Graph
{
    /**
     * {@inheritdoc}
     */
    protected function createVertex(NodeInterface $node): Vertex
    {
        $vertex = parent::createVertex($node);

        if ($node instanceof ValueNodeInterface) {
            $vertex->setAttribute('value', $node->getValue());
        }

        return $vertex;
    }

    /**
     * {@inheritdoc}
     */
    protected function createVertexId(NodeInterface $node)
    {
        if ($node instanceof ValueNodeInterface) {
            return $node->getValue();
        }

        return \sha1((string) parent::createVertexId($node));
    }
}
