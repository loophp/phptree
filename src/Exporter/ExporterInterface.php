<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\ValueNodeInterface;

/**
 * Interface ExporterInterface
 */
interface ExporterInterface
{
    /**
     * Export a node into something.
     *
     * @param \drupol\phptree\Node\ValueNodeInterface $node
     *   The node.
     *
     * @return mixed
     *   The node exported.
     */
    public function export(ValueNodeInterface $node);
}
