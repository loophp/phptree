<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class KeyValueNodeInterface
 */
interface KeyValueNodeInterface extends ValueNodeInterface
{
    /**
     * @return string|mixed|int|null
     */
    public function getKey();
}
