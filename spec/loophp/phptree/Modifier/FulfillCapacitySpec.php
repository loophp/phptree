<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\phptree\Modifier;

use loophp\phptree\Modifier\FulfillCapacity;
use loophp\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class FulfillCapacitySpec extends ObjectBehavior
{
    public function it_can_fulfill_missing_node()
    {
        $tree = new ValueNode('root', 10);

        $nodes = [];

        foreach (range('A', 'E') as $value) {
            $nodes[] = new ValueNode($value);
        }
        $tree->add(...$nodes);

        $this
            ->modify($tree)
            ->count()
            ->shouldReturn(10);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FulfillCapacity::class);
    }
}
