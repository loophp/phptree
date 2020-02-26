<?php

declare(strict_types=1);

namespace spec\loophp\phptree\Modifier;

use loophp\phptree\Modifier\Filter;
use loophp\phptree\Node\ValueNode;
use loophp\phptree\Node\ValueNodeInterface;
use PhpSpec\ObjectBehavior;

class FilterSpec extends ObjectBehavior
{
    public function it_can_filter_a_tree_with_a_callback()
    {
        $tree = new ValueNode('root', 10);

        $nodes = [];

        foreach (range(1, 11) as $value) {
            $nodes[] = new ValueNode($value);
        }
        $tree->add(...$nodes);

        $this
            ->modify($tree)
            ->count()
            ->shouldReturn(6);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Filter::class);
    }

    public function let()
    {
        $this->beConstructedWith(
            static function (ValueNodeInterface $node) {
                return 0 === ($node->getValue() % 2);
            }
        );
    }
}
