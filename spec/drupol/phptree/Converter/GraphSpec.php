<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Converter;

use drupol\phptree\Converter\Graph;
use drupol\phptree\Node\Node;
use drupol\phptree\Node\ValueNode;
use drupol\phptree\Visitor\BreadthFirstVisitor;
use PhpSpec\ObjectBehavior;

class GraphSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Graph::class);
    }

    public function it_can_generate_a_graph()
    {
        $root = new ValueNode('root');
        $child1 = new Node();
        $child2 = new Node();
        $child3 = new Node();
        $root
            ->add($child1, $child2, $child3);

        $this
            ->convert($root)
            ->shouldReturnAnInstanceOf(\Fhaculty\Graph\Graph::class);

        $this
            ->getGraph()
            ->getVertices()
            ->shouldHaveCount(4);

        $this
            ->getGraph()
            ->getEdges()
            ->shouldHaveCount(3);

        $visitor = new BreadthFirstVisitor();

        $nodes = \iterator_to_array($visitor->traverse($root));

        for ($i = 0; $i < \count($nodes) - 1; $i++) {
            $node0 = $nodes[0];
            $node1 = $nodes[$i + 1];

            $this
                ->getGraph()
                ->getVertices()
                ->getVertexId(\spl_object_hash($node0))
                ->hasEdgeTo($this->getGraph()->getVertices()->getVertexId(\spl_object_hash($node1)))
                ->shouldReturn(TRUE);
        }
    }

    public function it_can_use_constructor_parameters()
    {
        $graph = new \Fhaculty\Graph\Graph();
        $visitor = new BreadthFirstVisitor();

        $this
            ->beConstructedWith($graph, $visitor);

        $this
            ->getGraph()
            ->shouldReturn($graph);

        $this
            ->getVisitor()
            ->shouldReturn($visitor);
    }
}
