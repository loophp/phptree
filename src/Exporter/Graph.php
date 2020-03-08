<?php

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use Fhaculty\Graph\Graph as OriginalGraph;
use Fhaculty\Graph\Vertex;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;

/**
 * Class Graph.
 */
final class Graph implements ExporterInterface
{
    /**
     * The graph.
     *
     * @var \Fhaculty\Graph\Graph
     */
    private $graph;

    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node): OriginalGraph
    {
        $this->graph = new OriginalGraph();

        foreach ($node->all() as $node_visited) {
            $vertexFrom = $this->createVertex($node_visited);

            foreach ($node_visited->children() as $child) {
                $vertexTo = $this->createVertex($child);
                $vertexFrom->createEdgeTo($vertexTo);
            }
        }

        return $this->getGraph();
    }

    /**
     * Create a vertex.
     *
     * @param \loophp\phptree\Node\NodeInterface $node
     *   The node
     *
     * @return \Fhaculty\Graph\Vertex
     *   A vertex
     */
    private function createVertex(NodeInterface $node): Vertex
    {
        /** @var int $vertexId */
        $vertexId = $this->createVertexId($node);

        if (false === $this->getGraph()->hasVertex($vertexId)) {
            $vertex = $this->getGraph()->createVertex($vertexId);

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

        return $this->getGraph()->getVertex($vertexId);
    }

    /**
     * Create a vertex ID.
     *
     * @param \loophp\phptree\Node\NodeInterface $node
     *   The node
     *
     * @return string
     *   A vertex ID
     */
    private function createVertexId(NodeInterface $node): string
    {
        return sha1(spl_object_hash($node));
    }

    /**
     * @return \Fhaculty\Graph\Graph
     */
    private function getGraph(): OriginalGraph
    {
        return $this->graph;
    }
}
