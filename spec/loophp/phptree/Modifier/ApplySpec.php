<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\phptree\Modifier;

use loophp\phptree\Modifier\Apply;
use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\AttributeNodeInterface;
use PhpSpec\ObjectBehavior;

class ApplySpec extends ObjectBehavior
{
    public function it_can_apply_a_callback_to_all_the_nodes()
    {
        $tree = new AttributeNode(['label' => 'root']);

        $nodes = [];

        foreach (range('a', 'e') as $value) {
            $nodes[] = new AttributeNode(['label' => $value]);
        }
        $tree->add(...$nodes);

        $this
            ->modify($tree)
            ->getAttribute('label')
            ->shouldReturn('[root]');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Apply::class);
    }

    public function let()
    {
        $apply = static function (AttributeNodeInterface $node) {
            $node->setAttribute('label', '[' . $node->getAttribute('label') . ']');
        };

        $this->beConstructedWith($apply);
    }
}
