<?php

declare(strict_types=1);

namespace spec\loophp\phptree\Exporter;

use loophp\phptree\Exporter\Text;
use loophp\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class TextSpec extends ObjectBehavior
{
    public function it_can_export_to_text(): void
    {
        $tree = new ValueNode('root', 2);

        $this
            ->export($tree)
            ->shouldReturn('[root]');

        $nodes = [];

        foreach (range('A', 'J') as $value) {
            $nodes[$value] = new ValueNode($value, 2);
        }

        $tree->add(...array_values($nodes));

        $this
            ->export($tree)
            ->shouldReturn('[root[A[C[G][H]][D[I][J]]][B[E][F]]]');
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Text::class);
    }
}
