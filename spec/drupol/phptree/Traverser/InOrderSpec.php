<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Traverser;

use drupol\phptree\Node\ValueNode;
use drupol\phptree\Traverser\InOrder;
use PhpSpec\ObjectBehavior;

class InOrderSpec extends ObjectBehavior
{
    public function it_can_traverse_a_tree_of_degree2(): void
    {
        $tree = new ValueNode('root', 2);

        foreach (range('A', 'E') as $key => $value) {
            $nodes[$value] = new ValueNode($value, 2);
        }

        $tree->add(...array_values($nodes));

        $nodes['root'] = $tree;
        $nodes = [
            $nodes['C'],
            $nodes['A'],
            $nodes['D'],
            $nodes['root'],
            $nodes['B'],
            $nodes['E'],
        ];

        $this
            ->traverse($tree)
            ->shouldYield(new \ArrayIterator($nodes));
    }

    public function it_can_traverse_a_tree_of_degree4(): void
    {
        $tree = new ValueNode('root', 4);

        foreach (range('A', 'Z') as $key => $value) {
            $nodes[$value] = new ValueNode($value, 4);
        }

        $tree->add(...array_values($nodes));

        $nodes['root'] = $tree;
        $nodes = [
            $nodes['U'],
            $nodes['V'],
            $nodes['E'],
            $nodes['W'],
            $nodes['X'],
            $nodes['Y'],
            $nodes['F'],
            $nodes['Z'],
            $nodes['A'],
            $nodes['G'],
            $nodes['H'],
            $nodes['I'],
            $nodes['J'],
            $nodes['B'],
            $nodes['K'],
            $nodes['L'],
            $nodes['root'],
            $nodes['M'],
            $nodes['N'],
            $nodes['C'],
            $nodes['O'],
            $nodes['P'],
            $nodes['Q'],
            $nodes['R'],
            $nodes['D'],
            $nodes['S'],
            $nodes['T'],
        ];

        $this
            ->traverse($tree)
            ->shouldYield(new \ArrayIterator($nodes));
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(InOrder::class);
    }
}
