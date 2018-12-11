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
    protected $graph;

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
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return \Fhaculty\Graph\Graph
     */
    public function convert(NodeInterface $node): OriginalGraph
    {
        foreach ($this->visitor->traverse($node) as $node_visited) {
            /** @var int $vertexId */
            $vertexId = $this->createVertexId($node_visited);
            $this->createVertex($node_visited);

            if (null === $parent = $node_visited->getParent()) {
                continue;
            }

            /** @var int $hash_parent */
            $hash_parent = $this->createVertexId($parent);

            $this->graph->getVertex($hash_parent)->createEdgeTo($this->graph->getVertex($vertexId));
        }

        return $this->graph;
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

        if (false === $this->graph->hasVertex($vertexId)) {
            $vertex = $this->graph->createVertex($vertexId);
        } else {
            $vertex = $this->graph->getVertex($vertexId);
        }

        return $vertex;
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
