<?php

declare(strict_types=1);

namespace drupol\phptree\tests\Exporter;

use drupol\phptree\Exporter\Graph;
use drupol\phptree\Node\KeyValueNodeInterface;
use drupol\phptree\Node\NodeInterface;
use Fhaculty\Graph\Vertex;

/**
 * Class KeyValueGraph.
 */
class KeyValueGraph extends Graph
{
    /**
     * {@inheritdoc}
     */
    protected function createVertex(NodeInterface $node): Vertex
    {
        $vertex = parent::createVertex($node);

        if ($node instanceof KeyValueNodeInterface) {
            $vertex->setAttribute('graphviz.label', $node->getKey() . $vertex->getAttribute('graphviz.label'));
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

        return sha1((string) parent::createVertexId($node));
    }
}
