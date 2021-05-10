<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\phptree\Node;

use loophp\phptree\Node\AttributeNode;
use PhpSpec\ObjectBehavior;

class AttributeNodeSpec extends ObjectBehavior
{
    public function it_can_set_and_get_the_attributes(): void
    {
        $attributes = [
            'foo' => 'bar',
        ];

        $this
            ->setAttributes($attributes)
            ->getAttributes()
            ->shouldReturn($attributes);

        $this
            ->setAttribute('bar', 'foo')
            ->getAttribute('bar')
            ->shouldReturn('foo');
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(AttributeNode::class);
    }
}
