<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;
use Fhaculty\Graph\Graph as OriginalGraph;
use Fhaculty\Graph\Vertex;

/**
 * Class Graph.
 */
class Graph implements ExporterInterface
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
            /** @var int $vertexId */
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
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node
     *
     * @return \Fhaculty\Graph\Vertex
     *   A vertex
     */
    protected function createVertex(NodeInterface $node): Vertex
    {
        /** @var int $vertexId */
        $vertexId = $this->createVertexId($node);

        if (false === $this->getGraph()->hasVertex($vertexId)) {
            $vertex = $this->getGraph()->createVertex($vertexId);

            if ($node instanceof ValueNodeInterface) {
                $vertex->setAttribute('graphviz.label', $node->getValue());
            }
        }

        return $this->getGraph()->getVertex($vertexId);
    }

    /**
     * Create a vertex ID.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node
     *
     * @return null|int|string
     *   A vertex ID
     */
    protected function createVertexId(NodeInterface $node)
    {
        return \spl_object_hash($node);
    }

    /**
     * @return \Fhaculty\Graph\Graph
     */
    protected function getGraph(): OriginalGraph
    {
        return $this->graph;
    }
}
