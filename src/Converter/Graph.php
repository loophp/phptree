<?php

declare(strict_types = 1);

namespace drupol\phptree\Converter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Traverser\BreadthFirst;
use drupol\phptree\Traverser\TraverserInterface;
use Fhaculty\Graph\Graph as OriginalGraph;
use Fhaculty\Graph\Vertex;

/**
 * Class Graph
 */
class Graph implements ConverterInterface
{
    /**
     * @var \Fhaculty\Graph\Graph
     */
    private $graph;

    /**
     * @var \drupol\phptree\Traverser\TraverserInterface
     */
    private $traverser;

    /**
     * Graph constructor.
     *
     * @param \Fhaculty\Graph\Graph $graph
     * @param \drupol\phptree\Traverser\TraverserInterface|null $traverser
     */
    public function __construct(OriginalGraph $graph = null, TraverserInterface $traverser = null)
    {
        $this->graph = $graph ?? new OriginalGraph();
        $this->traverser = $traverser ?? new BreadthFirst();
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
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return \Fhaculty\Graph\Graph
     */
    public function convert(NodeInterface $node): OriginalGraph
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

            $this->getGraph()->getVertex($hash_parent)->createEdgeTo($this->getGraph()->getVertex($vertexId));
        }

        return $this->getGraph();
    }

    /**
     * Create a vertex.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node.
     *
     * @return \Fhaculty\Graph\Vertex
     *   A vertex.
     */
    protected function createVertex(NodeInterface $node): Vertex
    {
        /** @var int $vertexId */
        $vertexId = $this->createVertexId($node);

        return false === $this->getGraph()->hasVertex($vertexId) ?
            $this->getGraph()->createVertex($vertexId):
            $vertex = $this->getGraph()->getVertex($vertexId);
    }

    /**
     * Create a vertex ID.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node.
     *
     * @return int|null|string
     *   A vertex ID.
     */
    protected function createVertexId(NodeInterface $node)
    {
        return \spl_object_hash($node);
    }
}
