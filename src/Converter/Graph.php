<?php

declare(strict_types = 1);

namespace drupol\phptree\Converter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Visitor\BreadthFirstVisitor;
use drupol\phptree\Visitor\VisitorInterface;
use Fhaculty\Graph\Graph as OriginalGraph;

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
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return \Fhaculty\Graph\Graph
     */
    public function convert(NodeInterface $node): OriginalGraph
    {
        foreach ($this->visitor->traverse($node) as $node_visited) {
            /** @var int $hash */
            $hash = $this->hash($node_visited);

            if (false === $this->graph->hasVertex($hash)) {
                $this->graph->createVertex($hash);
            }

            if (null === $parent = $node_visited->getParent()) {
                continue;
            }

            /** @var int $hash_parent */
            $hash_parent = $this->hash($parent);

            $this->graph->getVertex($hash_parent)->createEdgeTo($this->graph->getVertex($hash));
        }

        return $this->graph;
    }

    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return int|null|string
     */
    protected function hash(NodeInterface $node)
    {
        return \spl_object_hash($node);
    }
}
