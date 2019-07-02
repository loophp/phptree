<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;

/**
 * Class AbstractExporter.
 */
abstract class AbstractExporter implements ExporterInterface
{
    /**
     * Get a string representation of the node.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node.
     *
     * @return string
     *   The node representation.
     */
    protected function getNodeRepresentation(NodeInterface $node): string
    {
        if ($node instanceof ValueNodeInterface) {
            return (string) $node->getValue();
        }

        return \sha1(\spl_object_hash($node));
    }
}
