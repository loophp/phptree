<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use Fhaculty\Graph\Graph as OriginalGraph;
use Fhaculty\Graph\Vertex;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;

final class Graph implements ExporterInterface
{
    public function export(NodeInterface $node): OriginalGraph
    {
        $graph = new OriginalGraph();

        foreach ($node->all() as $node_visited) {
            $vertexFrom = $this->createVertex($node_visited, $graph);

            foreach ($node_visited->children() as $child) {
                $vertexTo = $this->createVertex($child, $graph);
                $vertexFrom->createEdgeTo($vertexTo);
            }
        }

        return $graph;
    }

    /**
     * Create a vertex.
     *
     * @param NodeInterface $node
     *   The node
     *
     * @return Vertex
     *   A vertex
     */
    private function createVertex(NodeInterface $node, OriginalGraph $graph): Vertex
    {
        /** @var int $vertexId */
        $vertexId = $this->createVertexId($node);

        if (!$graph->hasVertex($vertexId)) {
            $vertex = $graph->createVertex($vertexId);

            $vertex->setAttribute(
                'graphviz.label',
                $node->label()
            );

            if ($node instanceof AttributeNodeInterface) {
                foreach ($node->getAttributes() as $key => $value) {
                    $vertex->setAttribute((string) $key, $value);
                }
            }
        }

        return $graph->getVertex($vertexId);
    }

    private function createVertexId(NodeInterface $node): string
    {
        return sha1(spl_object_hash($node));
    }
}
