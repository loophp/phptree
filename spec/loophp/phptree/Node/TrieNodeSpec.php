<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\phptree\Node;

use loophp\phptree\Node\TrieNode;
use loophp\phptree\Node\ValueNode;

class TrieNodeSpec extends NodeObjectBehavior
{
    public function it_can_add_node(): void
    {
        $this->beConstructedWith('value');

        $values = [
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
            'zd',
            'zde',
            'zden',
            'zdeně',
            'zdeněk',
        ];

        $nodes = [];
        foreach ($values as $key => $value) {
            $nodes[] = new ValueNode([$key, (string) $value]);
        }

        $this
            ->add(...$nodes)
            ->count()
            ->shouldReturn(54);
    }

    public function it_is_initializable(): void
    {
        $this->beConstructedWith('value');
        $this->shouldHaveType(TrieNode::class);
    }
}
