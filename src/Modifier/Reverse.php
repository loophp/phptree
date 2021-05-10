<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use ArrayObject;
use loophp\phptree\Node\NodeInterface;

/**
 * Class Reverse.
 */
class Reverse implements ModifierInterface
{
    public function modify(NodeInterface $tree): NodeInterface
    {
        $children = new ArrayObject();

        foreach ($tree->children() as $child) {
            $children->append($this->modify($child));
        }

        return $tree->withChildren(...array_reverse(
            $children->getArrayCopy()
        ));
    }
}
