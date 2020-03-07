<?php

declare(strict_types=1);

namespace spec\loophp\phptree\Importer;

use loophp\phptree\Importer\Text;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class TextSpec extends ObjectBehavior
{
    public function it_can_import(): void
    {
        $string = '[root[A[C[G][H]][D[I][J]]][B[E][F]]]';

        $tree = new ValueNode('root', 2);

        $nodes = [];

        foreach (range('A', 'J') as $value) {
            $nodes[$value] = new ValueNode($value);
        }

        $tree->add(...array_values($nodes));

        $this
            ->import($string)
            ->shouldImplement(AttributeNodeInterface::class);

        $this
            ->import($string)
            ->count()
            ->shouldReturn(11);

        $this
            ->import($string)
            ->isRoot()
            ->shouldReturn(true);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Text::class);
    }
}
