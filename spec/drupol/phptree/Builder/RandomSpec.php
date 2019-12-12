<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Builder;

use drupol\phptree\Builder\Random;
use drupol\phptree\Node\Node;
use drupol\phptree\Node\NodeInterface;
use PhpSpec\ObjectBehavior;

class RandomSpec extends ObjectBehavior
{
    public function it_can_build_a_random_tree()
    {
        $parameters = [Node::class];
        $nodes = [
            'foo' => $parameters,
            'bar' => $parameters,
        ];

        $this::create($nodes)
            ->shouldReturn(null);

        $nodes = array_values($nodes);

        $this::create($nodes)
            ->shouldBeAnInstanceOf(NodeInterface::class);

        $this::create($nodes)
            ->count()
            ->shouldReturn(1);

        $parameters = [static function () {
            return Node::class;
        }];

        $nodes = [
            $parameters,
            $parameters,
        ];

        $this::create($nodes)
            ->shouldBeAnInstanceOf(NodeInterface::class);

        $nodes = array_pad([], 20, $parameters);
        $this::create($nodes)
            ->shouldBeAnInstanceOf(NodeInterface::class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Random::class);
    }
}
