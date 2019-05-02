<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Traverser\PreOrder;
use drupol\phptree\Traverser\TraverserInterface;
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
     * The traverser.
     *
     * @var \drupol\phptree\Traverser\TraverserInterface
     */
    private $traverser;

    /**
     * Graph constructor.
     *
     * @param \Fhaculty\Graph\Graph $graph
     * @param null|\drupol\phptree\Traverser\TraverserInterface $traverser
     */
    public function __construct(OriginalGraph $graph = null, TraverserInterface $traverser = null)
    {
        $this->graph = $graph ?? new OriginalGraph();
        $this->traverser = $traverser ?? new PreOrder();
    }

    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node): OriginalGraph
    {
        foreach ($this->getTraverser()->traverse($node) as $node_visited) {
            /** @var int $vertexId */
            $vertexId = $this->createVertexId($node_visited);
            $this->createVertex($node_visited);

            if (null === $parent = $node_visited->getParent()) {
                continue;
            }

            /** @var int $hash_parent */
            $hash_parent = $this->createVertexId($parent);
            $this->createVertex($parent);

            $this->getGraph()->getVertex($hash_parent)->createEdgeTo($this->getGraph()->getVertex($vertexId));
        }

        return $this->getGraph();
    }

    /**
     * @return \Fhaculty\Graph\Graph
     */
    public function getGraph(): OriginalGraph
    {
        return $this->graph;
    }

    /**
     * @return \drupol\phptree\Traverser\TraverserInterface
     */
    public function getTraverser(): TraverserInterface
    {
        return $this->traverser;
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

            $label = null;
            if (\method_exists($node, 'getValue')) {
                $label = $node->getValue();
            }

            $vertex->setAttribute('graphviz.label', $label);
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
}
