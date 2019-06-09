<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Exporter;

use drupol\phptree\Exporter\Graph;
use drupol\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class GraphSpec extends ObjectBehavior
{
    public function it_can_generate_a_graph()
    {
        $tree = new ValueNode('root');
        $child1 = new ValueNode('child1');
        $child2 = new ValueNode('child2');
        $child3 = new ValueNode('child3');
        $child4 = new ValueNode('child3');
        $child1->add($child4);

        $tree
            ->add($child1, $child2, $child3);

        $this
            ->export($tree)
            ->shouldReturnAnInstanceOf(\Fhaculty\Graph\Graph::class);

        $this
            ->export($child1)
            ->shouldReturnAnInstanceOf(\Fhaculty\Graph\Graph::class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Graph::class);
    }
}
