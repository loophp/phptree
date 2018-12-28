<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Exporter;

use drupol\phptree\Exporter\SimpleArray;
use drupol\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class SimpleArraySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(SimpleArray::class);
    }

    public function it_can_export_to_an_array()
    {
        $tree = new ValueNode('root', 2);

        $this
            ->export($tree)
            ->shouldReturn(['value' => 'root']);

        $nodes = [];
        foreach (\range('A', 'J') as $value) {
            $nodes[$value] = new ValueNode($value, 2);
        }

        $tree->add(...\array_values($nodes));

        $return = [
            'value' => 'root',
            'children' => [
                0 => [
                    'value' => 'A',
                    'children' => [
                        0 => [
                            'value' => 'C',
                            'children' => [
                                0 => [
                                    'value' => 'G',
                                ],
                                1 => [
                                    'value' => 'H',
                                ],
                            ],
                        ],
                        1 => [
                            'value' => 'D',
                            'children' => [
                                0 => [
                                    'value' => 'I',
                                ],
                                1 => [
                                    'value' => 'J',
                                ],
                            ],
                        ],
                    ],
                ],
                1 => [
                    'value' => 'B',
                    'children' => [
                        0 => [
                            'value' => 'E',
                        ],
                        1 => [
                            'value' => 'F',
                        ],
                    ],
                ],
            ],
        ];

        $this
            ->export($tree)
            ->shouldReturn($return);
    }
}
