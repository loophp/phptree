<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Node;

use drupol\phpmerkle\Hasher\DoubleSha256;
use drupol\phptree\Node\MerkleNode;
use drupol\phpmerkle\Hasher\DummyHasher;
use PhpSpec\ObjectBehavior;

class MerkleNodeSpec extends ObjectBehavior
{
    public function it_can_get_a_hash()
    {
        $this
            ->beConstructedWith('root', 2, new DoubleSha256());

        $input = [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'Science',
            'is',
            'made',
            'up',
            'of',
            'so',
            'many',
            'things',
            'that',
            'appear',
            'obvious',
            'after',
            'they',
            'are',
            'explained',
            '.',
        ];

        foreach ($input as $word) {
            $nodes[] = new MerkleNode($word, 2, new DoubleSha256());
        }

        $this
            ->add(...$nodes)
            ->getValue()
            ->shouldReturn('c689102cdf2a5b30c2e21fdad85e4bb401085227aff672a7240ceb3410ff1fb6');
    }

    public function it_can_get_the_value_of_a_tree_with_a_single_node()
    {
        $this
            ->getValue()
            ->shouldReturn('root');
    }

    public function it_can_get_the_value_of_a_tree_with_four_nodes()
    {
        $nodes = [
            new MerkleNode(null, 2, new DummyHasher()),
            new MerkleNode(null, 2, new DummyHasher()),
            new MerkleNode('a', 2, new DummyHasher()),
            new MerkleNode('b', 2, new DummyHasher()),
            new MerkleNode('c', 2, new DummyHasher()),
        ];

        $this
            ->add(...$nodes)
            ->getValue()
            ->shouldReturn('abcc');
    }

    public function it_can_get_the_value_of_a_tree_with_three_nodes()
    {
        $nodes = [
            new MerkleNode('a', 2, new DummyHasher()),
            new MerkleNode('b', 2, new DummyHasher()),
        ];

        $this
            ->add(...$nodes)
            ->getValue()
            ->shouldReturn('ab');
    }

    public function it_can_get_the_value_of_a_tree_with_two_nodes()
    {
        $node = new MerkleNode('a', 2, new DummyHasher());

        $this
            ->add($node)
            ->getValue()
            ->shouldReturn('aa');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(MerkleNode::class);
    }

    public function let()
    {
        $this
            ->beConstructedWith('root', 2, new DummyHasher());
    }
}
