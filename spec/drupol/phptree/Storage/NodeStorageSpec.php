<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Storage;

use drupol\phptree\Storage\NodeStorage;
use PhpSpec\ObjectBehavior;

class NodeStorageSpec extends ObjectBehavior
{
    public function it_can_offsetUnset(): void
    {
        $this->set('foo', 'bar');

        $this->get('foo')->shouldBe('bar');

        $this->offsetUnset('foo');

        $this->shouldThrow(\InvalidArgumentException::class)
            ->during('get', ['foo']);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(NodeStorage::class);
    }
}
