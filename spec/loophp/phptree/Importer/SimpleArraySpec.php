<?php

declare(strict_types=1);

namespace spec\loophp\phptree\Importer;

use loophp\phptree\Importer\SimpleArray;
use loophp\phptree\Node\NodeInterface;
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
            ->shouldReturn(3);

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
