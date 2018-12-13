<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\tests\Converter;

use drupol\phptree\Node\ValueNode;
use drupol\phptree\tests\Converter\ValueGraph;
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
            ->convert($tree)
            ->shouldReturnAnInstanceOf(\Fhaculty\Graph\Graph::class);
    }
}
