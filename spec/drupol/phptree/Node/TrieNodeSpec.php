<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Node\KeyValueNode;
use drupol\phptree\Node\TrieNode;
use PhpSpec\ObjectBehavior;

class TrieNodeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(TrieNode::class);
    }

    public function it_can_add_node()
    {
        $this->beConstructedWith('root', 'root');

        $nodes = [
            'ab',
            'abc',
            'abcd',
            'abcde',
            'cb',
            'cba',
            'dcba',
            'edcba',
        ];

        foreach ($nodes as $key => $value) {
            $nodes[$key] = new KeyValueNode($key, $value);
        }

        $this
            ->add(...$nodes)
            ->count()
            ->shouldReturn(25);
    }
}
