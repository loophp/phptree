<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\phptree\Traverser;

use ArrayIterator;
use loophp\phptree\Node\Node;
use loophp\phptree\Traverser\PostOrder;
use PhpSpec\ObjectBehavior;

class PostOrderSpec extends ObjectBehavior
{
    public function it_can_traverse_a_tree(): void
    {
        $tree = new Node();

        $data = range('A', 'E');

        $nodes = [];

        foreach ($data as $key => $value) {
            $nodes[] = new Node();
        }

        $tree->add(...$nodes);

        $nodes[] = $tree;

        $this
            ->traverse($tree)
            ->shouldYield(new ArrayIterator($nodes));
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(PostOrder::class);
    }
}
