<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Importer;

use drupol\phptree\Importer\SimpleArray;
use drupol\phptree\Node\NodeInterface;
use PhpSpec\ObjectBehavior;

class SimpleArraySpec extends ObjectBehavior
{
    public function it_can_import(): void
    {
        $array = [
            'value' => 'root',
            'children' => [
                0 => [
                    'value' => 'child1',
                ],
                1 => [
                    'value' => 'child2',
                ],
            ],
        ];

        $this
            ->import($array)
            ->shouldImplement(NodeInterface::class);

        $this
            ->import($array)
            ->count()
            ->shouldReturn(2);

        $this
            ->import($array)
            ->isRoot()
            ->shouldReturn(true);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(SimpleArray::class);
    }
}
