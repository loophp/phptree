<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Node\AttributeNode;
use PhpSpec\ObjectBehavior;

class AttributeNodeSpec extends ObjectBehavior
{
    public function it_can_set_and_get_the_attributes()
    {
        $attributes = [
            'foo' => 'bar',
        ];

        $attributes = new \ArrayObject($attributes);

        $this
            ->setAttributes($attributes)
            ->getAttributes()
            ->shouldReturn($attributes);

        $this
            ->setAttribute('bar', 'foo')
            ->getAttribute('bar')
            ->shouldReturn('foo');
    }
    public function it_is_initializable()
    {
        $this->shouldHaveType(AttributeNode::class);
    }
}
