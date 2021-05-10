<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
    protected function createVertex(NodeInterface $node): Vertex
    {
        $vertex = parent::createVertex($node);

        if ($node instanceof KeyValueNodeInterface) {
            $vertex->setAttribute('graphviz.label', $node->getKey() . $vertex->getAttribute('graphviz.label'));
        }

        return $vertex;
    }

    protected function createVertexId(NodeInterface $node)
    {
        if ($node instanceof KeyValueNodeInterface) {
            return $node->getKey() . $node->getValue();
        }

        return sha1((string) parent::createVertexId($node));
    }
}
