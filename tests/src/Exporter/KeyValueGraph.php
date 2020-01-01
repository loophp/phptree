<?php

declare(strict_types=1);

namespace loophp\phptree\tests\Exporter;

use Fhaculty\Graph\Vertex;
use loophp\phptree\Exporter\Graph;
use loophp\phptree\Node\KeyValueNodeInterface;
use loophp\phptree\Node\NodeInterface;

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
