<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Importer;

use drupol\phptree\Importer\Text;
use drupol\phptree\Node\ValueNode;
use drupol\phptree\Node\ValueNodeInterface;
use PhpSpec\ObjectBehavior;

class TextSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Text::class);
    }

    public function it_can_import()
    {
        $string = '[root [A [C [G] [H]] [D [I] [J]]] [B [E] [F]]]';

        $tree = new ValueNode('root', 2);

        $nodes = [];
        foreach (\range('A', 'J') as $value) {
            $nodes[$value] = new ValueNode($value);
        }

        $tree->add(...\array_values($nodes));

        $this
            ->import($string)
            ->shouldImplement(ValueNodeInterface::class);

        $this
            ->import($string)
            ->count()
            ->shouldReturn(10);

        $this
            ->import($string)
            ->isRoot()
            ->shouldReturn(TRUE);
    }
}
