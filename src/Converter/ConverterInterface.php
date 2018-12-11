<?php

declare(strict_types = 1);

namespace drupol\phptree\Converter;

use drupol\phptree\Node\NodeInterface;

/**
 * Interface ConverterInterface.
 */
interface ConverterInterface
{
    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return mixed
     */
    public function convert(NodeInterface $node);
}
