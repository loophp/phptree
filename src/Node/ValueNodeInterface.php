<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class ValueNodeInterface
 */
interface ValueNodeInterface extends NodeInterface
{
    /**
     * @return string|mixed|null
     */
    public function getValue();
}
