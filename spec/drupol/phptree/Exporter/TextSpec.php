<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Exporter;

use drupol\phptree\Exporter\Text;
use drupol\phptree\Node\Node;
use drupol\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class TextSpec extends ObjectBehavior
{
    public function it_can_export_to_text()
    {
        $tree = new ValueNode('root', 2);

        $this
            ->export($tree)
            ->shouldReturn('[root]');

        $nodes = [];
        foreach (\range('A', 'J') as $value) {
            $nodes[$value] = new ValueNode($value, 2);
        }

        $tree->add(...\array_values($nodes));

        $this
            ->export($tree)
            ->shouldReturn('[root [A [C [G] [H]] [D [I] [J]]] [B [E] [F]]]');
    }

    public function it_can_throw_an_error_when_tree_is_not_a_valuenode()
    {
        $tree = new Node();

        foreach (\range('A', 'Z') as $key => $value) {
            $nodes[$value] = new Node();
        }

        $tree->add(...\array_values($nodes));

        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('export', [$tree]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Text::class);
    }
}
