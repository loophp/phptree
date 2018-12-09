<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\tests;

use drupol\phptree\Node\ValueNode;
use drupol\phptree\tests\TestGraphViz;
use drupol\phptree\Visitor\BreadthFirstVisitor;
use PhpSpec\ObjectBehavior;

class TestGraphVizSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $visitor = new BreadthFirstVisitor();

        $this->beConstructedWith($visitor);

        $this->shouldHaveType(TestGraphViz::class);
    }

    public function it_can_create_a_graph()
    {
        $this->beConstructedWith(new BreadthFirstVisitor());

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
}
