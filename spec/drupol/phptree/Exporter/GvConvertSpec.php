<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Exporter;

use drupol\phptree\Exporter\GvConvert;
use drupol\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class GvConvertSpec extends ObjectBehavior
{
    public function it_can_convert_a_tree_into_a_file()
    {
        $tree = new ValueNode('root');

        $this
            ->export($tree)
            ->shouldBeString();
    }

    public function it_can_set_and_get_the_executable()
    {
        $this
            ->getExecutable()
            ->shouldBe('dot');

        $this
            ->setExecutable('foo')
            ->shouldReturn($this);

        $this
            ->getExecutable()
            ->shouldBe('foo');
    }

    public function it_can_set_and_get_the_format()
    {
        $this
            ->getFormat()
            ->shouldReturn('svg');

        $this
            ->setFormat('png')
            ->shouldReturn($this);

        $this
            ->getFormat()
            ->shouldReturn('png');
    }
    public function it_is_initializable()
    {
        $this->shouldHaveType(GvConvert::class);

        $this
            ->getExecutable()
            ->shouldReturn('dot');
    }
}
