<?php

declare(strict_types = 1);

namespace drupol\phptree\Converter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Visitor\BreadthFirstVisitor;
use drupol\phptree\Visitor\VisitorInterface;
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
     * @var \drupol\phptree\Visitor\VisitorInterface
     */
    private $visitor;

    /**
     * Graph constructor.
     *
     * @param \Fhaculty\Graph\Graph $graph
     * @param \drupol\phptree\Visitor\VisitorInterface|null $visitor
     */
    public function __construct(OriginalGraph $graph = null, VisitorInterface $visitor = null)
    {
        $this->graph = $graph ?? new OriginalGraph();
        $this->visitor = $visitor ?? new BreadthFirstVisitor();
    }

    /**
     * @return \Fhaculty\Graph\Graph
     */
    public function getGraph(): OriginalGraph
    {
        return $this->graph;
    }

    /**
     * @return \drupol\phptree\Visitor\VisitorInterface
     */
    public function getVisitor(): VisitorInterface
    {
        return $this->visitor;
    }

    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return \Fhaculty\Graph\Graph
     */
    public function convert(NodeInterface $node): OriginalGraph
    {
        foreach ($this->getVisitor()->traverse($node) as $node_visited) {
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
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return \Fhaculty\Graph\Vertex
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
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return int|null|string
     */
    protected function createVertexId(NodeInterface $node)
    {
        return \spl_object_hash($node);
    }
}
