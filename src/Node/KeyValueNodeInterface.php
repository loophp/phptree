<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

/**
 * Interface KeyValueNodeInterface.
 */
interface KeyValueNodeInterface extends ValueNodeInterface
{
    /**
     * Get the key property.
     *
     * @return int|mixed|string|null
     *   The key property
     */
    public function getKey();
}
