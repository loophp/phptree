<?php

declare(strict_types=1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Node\KeyValueNode;
use drupol\phptree\Node\TrieNode;

class TrieNodeSpec extends NodeObjectBehavior
{
    public function it_can_add_node(): void
    {
        $this->beConstructedWith('key', 'value');

        $nodes = [
            1000,
            1001,
            10011,
            2000,
            2001,
            20011,
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
            $nodes[$key] = new KeyValueNode($key, (string) $value);
        }

        $this
            ->add(...$nodes)
            ->count()
            ->shouldReturn(43);
    }

    public function it_is_initializable(): void
    {
        $this->beConstructedWith('key', 'value');
        $this->shouldHaveType(TrieNode::class);
    }
}
