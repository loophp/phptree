<?php

declare(strict_types = 1);

namespace drupol\phptree\tests\Exporter;

use drupol\phptree\Node\KeyValueNodeInterface;
use drupol\phptree\Node\NodeInterface;
use Fhaculty\Graph\Vertex;

/**
 * Class KeyValueGraph.
 */
class KeyValueGraph extends ValueGraph
{
    /**
     * {@inheritdoc}
     */
    protected function createVertex(NodeInterface $node): Vertex
    {
        $vertex = parent::createVertex($node);

        if ($node instanceof KeyValueNodeInterface) {
            $vertex->setAttribute('graphviz.label', $node->getValue());
        }

        return $vertex;
    }

    /**
     * {@inheritdoc}
     */
    protected function createVertexId(NodeInterface $node)
    {
        if ($node instanceof KeyValueNodeInterface) {
            return $node->getKey() . $node->getValue();
        }

        return \sha1((string) parent::createVertexId($node));
    }
}
