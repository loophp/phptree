<?php

declare(strict_types=1);

namespace spec\loophp\phptree\Exporter;

use loophp\phptree\Exporter\Image;
use loophp\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class ImageSpec extends ObjectBehavior
{
    public function it_can_convert_a_tree_into_a_file(): void
    {
        $tree = new ValueNode('root');

        $this
            ->export($tree)
            ->shouldBeString();
    }

    public function it_can_set_and_get_the_executable(): void
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

    public function it_can_set_and_get_the_format(): void
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

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Image::class);

        $this
            ->getExecutable()
            ->shouldReturn('dot');
    }
}
