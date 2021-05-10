<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

/**
 * Interface ValueNodeInterface.
 */
interface ValueNodeInterface extends NaryNodeInterface
{
    /**
     * Get the value property.
     *
     * @return mixed|string|null
     *   The value property
     */
    public function getValue();
}
