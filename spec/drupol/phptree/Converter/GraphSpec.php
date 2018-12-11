<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Converter;

use drupol\phptree\Converter\Graph;
use drupol\phptree\Node\Node;
use PhpSpec\ObjectBehavior;

class GraphSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Graph::class);
    }

    public function it_can_generate_a_graph()
    {
        $root = new Node();
        $level1 = new Node();
        $level2 = new Node();

        $root
            ->add($level1, $level2, $level2);

        $this
            ->convert($root)
            ->shouldReturnAnInstanceOf(\Fhaculty\Graph\Graph::class);
    }
}
