<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Exporter;

use drupol\phptree\Exporter\Graph;
use drupol\phptree\Node\ValueNode;
use drupol\phptree\Traverser\BreadthFirst;
use PhpSpec\ObjectBehavior;

class GraphSpec extends ObjectBehavior
{
    public function it_can_generate_a_graph()
    {
        $tree = new ValueNode('root');
        $child1 = new ValueNode('child1');
        $child2 = new ValueNode('child2');
        $child3 = new ValueNode('child3');
        $tree
            ->add($child1, $child2, $child3);

        $this
            ->export($tree)
            ->shouldReturnAnInstanceOf(\Fhaculty\Graph\Graph::class);

        $this
            ->getGraph()
            ->getVertices()
            ->shouldHaveCount(4);

        $this
            ->getGraph()
            ->getEdges()
            ->shouldHaveCount(3);

        $traverser = new BreadthFirst();

        $nodes = \iterator_to_array($traverser->traverse($tree));

        for ($i = 0; \count($nodes) - 1 > $i; ++$i) {
            $node0 = $nodes[0];
            $node1 = $nodes[$i + 1];

            $this
                ->getGraph()
                ->getVertices()
                ->getVertexId(\spl_object_hash($node0))
                ->hasEdgeTo($this->getGraph()->getVertices()->getVertexId(\spl_object_hash($node1)))
                ->shouldReturn(true);
        }
    }

    public function it_can_use_constructor_parameters()
    {
        $graph = new \Fhaculty\Graph\Graph();
        $traverser = new BreadthFirst();

        $this
            ->beConstructedWith($graph, $traverser);

        $this
            ->getGraph()
            ->shouldReturn($graph);

        $this
            ->getTraverser()
            ->shouldReturn($traverser);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Graph::class);
    }
}
