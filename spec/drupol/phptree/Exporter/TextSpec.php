<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Exporter;

use drupol\phptree\Exporter\Text;
use drupol\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class TextSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Text::class);
    }

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
}
