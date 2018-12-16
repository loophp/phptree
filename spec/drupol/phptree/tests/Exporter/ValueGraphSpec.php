<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\tests\Exporter;

use drupol\phptree\Node\ValueNode;
use drupol\phptree\tests\Exporter\ValueGraph;
use Fhaculty\Graph\Vertex;
use PhpSpec\ObjectBehavior;

class ValueGraphSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ValueGraph::class);
    }

    public function it_can_be_extended()
    {
        $tree = new ValueNode('root');

        $this
            ->export($tree)
            ->getVertex('root')
            ->shouldReturnAnInstanceOf(Vertex::class);

        $this
            ->export($tree)
            ->getVertex('root')
            ->getAttribute('value')
            ->shouldReturn('root');
    }
}
