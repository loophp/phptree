<?php

declare(strict_types = 1);

namespace drupol\phptree\Render;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Visitor\VisitorInterface;
use Fhaculty\Graph\Graph;
use Graphp\GraphViz\GraphViz as OriginalGraphViz;

/**
 * Class GraphViz
 */
class GraphViz implements RendererInterface
{
    /**
     * @var \drupol\phptree\Visitor\VisitorInterface
     */
    private $visitor;

    /**
     * @var \Fhaculty\Graph\Graph
     */
    private $graph;

    /**
     * @var \Graphp\GraphViz\GraphViz
     */
    private $graphviz;

    /**
     * GraphViz constructor.
     *
     * @param \drupol\phptree\Visitor\VisitorInterface $visitor
     */
    public function __construct(VisitorInterface $visitor, Graph $graph, OriginalGraphViz $graphViz)
    {
        $this->visitor = $visitor;
        $this->graph = $graph;
        $this->graphviz = $graphViz;
    }

    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return string
     */
    public function render(NodeInterface $node): string
    {
        return $this->graphviz->createScript($this->getGraph($node));
    }

    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return \Fhaculty\Graph\Graph
     */
    public function getGraph(NodeInterface $node): Graph
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
     * @return $this
     */
    public function display(NodeInterface $node): RendererInterface
    {
        $this->graphviz->display($this->getGraph($node));

        return $this;
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
