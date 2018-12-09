<?php

declare(strict_types = 1);

namespace drupol\phptree\Render;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Visitor\VisitorInterface;
use Fhaculty\Graph\Graph;

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
     * @var array
     */
    private $nodes;

    /**
     * @var \Graphp\GraphViz\GraphViz
     */
    private $graphviz;

    /**
     * GraphViz constructor.
     *
     * @param \drupol\phptree\Visitor\VisitorInterface $visitor
     */
    public function __construct(VisitorInterface $visitor)
    {
        $this->visitor = $visitor;
        $this->graph = new Graph();
        $this->graphviz = new \Graphp\GraphViz\GraphViz();
        $this->nodes = [];
    }

    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return string
     */
    public function render(NodeInterface $node): string
    {
        foreach ($this->visitor->traverse($node) as $child) {
            $hash_parent = $this->hash($child);

            if (!isset($this->nodes[$hash_parent])) {
                $this->nodes[$hash_parent] = $this->graph->createVertex($hash_parent);
            }

            if (null === $parent = $child->getParent()) {
                continue;
            }

            $hash = $this->hash($parent);

            if (!isset($this->nodes[$hash])) {
                $this->nodes[$hash] = $this->graph->createVertex($hash);
            }

            $this->nodes[$hash]->createEdgeTo($this->nodes[$hash_parent]);
        }

        return $this->graphviz->createScript($this->graph);
    }

    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return int
     */
    protected function hash(NodeInterface $node)
    {
        return (int) \spl_object_hash($node);
    }
}
