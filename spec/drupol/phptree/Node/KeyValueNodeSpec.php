<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Node\KeyValueNode;

class KeyValueNodeSpec extends NodeObjectBehavior
{
    public function it_can_be_set_with_a_key_and_value(): void
    {
        $this
            ->beConstructedWith('key', 'root');

        $this
            ->getKey()
            ->shouldReturn('key');

        $this
            ->getValue()
            ->shouldReturn('root');
    }

    public function it_can_throw_an_error_when_capacity_is_invalid(): void
    {
        $this->beConstructedWith('key', 'value', -5);

        $this
            ->capacity()
            ->shouldReturn(-5);
    }

    public function it_is_initializable(): void
    {
        $this->beConstructedWith('key', 'value');
        $this->shouldHaveType(KeyValueNode::class);
    }
}
