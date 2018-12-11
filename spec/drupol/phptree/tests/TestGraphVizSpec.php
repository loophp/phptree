<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\tests;

use drupol\phptree\Node\ValueNode;
use drupol\phptree\tests\TestGraphViz;
use drupol\phptree\Visitor\BreadthFirstVisitor;
use Fhaculty\Graph\Graph;
use Graphp\GraphViz\GraphViz;
use PhpSpec\ObjectBehavior;

class TestGraphVizSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $visitor = new BreadthFirstVisitor();
        $graph = new Graph();
        $graphviz = new GraphViz();

        $this->beConstructedWith($visitor, $graph, $graphviz);

        $this->shouldHaveType(TestGraphViz::class);
    }

    public function it_can_generate_a_graph()
    {
        $visitor = new BreadthFirstVisitor();
        $graph = new Graph();
        $graphviz = new GraphViz();

        $this->beConstructedWith($visitor, $graph, $graphviz);

        $tree = new ValueNode('root', 2);

        $nodes = [0 => new ValueNode()];
        foreach (\range('A', 'F') as $letter) {
            $nodes[] = new ValueNode($letter, 2);
        }

        $tree->add(...$nodes);

        $this
            ->getGraph($tree)
            ->shouldReturnAnInstanceOf(Graph::class);
    }

    public function it_can_create_a_graph()
    {
        $visitor = new BreadthFirstVisitor();
        $graph = new Graph();
        $graphviz = new GraphViz();

        $this->beConstructedWith($visitor, $graph, $graphviz);

        $tree = new ValueNode('root', 2);

        $nodes = [];
        foreach (\range('A', 'F') as $letter) {
            $nodes[] = new ValueNode($letter, 2);
        }

        $tree->add(...$nodes);

        $result = <<< EOF
digraph G {
  "root" -> "A"
  "root" -> "B"
  "A" -> "C"
  "A" -> "D"
  "B" -> "E"
  "B" -> "F"
}
EOF;

        $this
            ->render($tree)
            ->shouldReturn($result . PHP_EOL);
    }

    public function it_can_display()
    {
        $visitor = new BreadthFirstVisitor();
        $graph = new Graph();
        $graphviz = new GraphViz();

        $this->beConstructedWith($visitor, $graph, $graphviz);

        $tree = new ValueNode('root', 2);

        $nodes = [];
        foreach (\range('A', 'F') as $letter) {
            $nodes[] = new ValueNode($letter, 2);
        }

        $tree->add(...$nodes);

        $this
            ->display($tree)
            ->shouldReturn($this);
    }
}
