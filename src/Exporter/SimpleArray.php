<?php

declare(strict_types=1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;
use InvalidArgumentException;

/**
 * Class SimpleArray.
 */
class SimpleArray extends AbstractExporter
{
    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node)
    {
        if (!($node instanceof ValueNodeInterface)) {
            throw new InvalidArgumentException('Must implements ValueNodeInterface');
        }

        $children = [];
        /** @var ValueNodeInterface $child */
        foreach ($node->children() as $child) {
            $children[] = $this->export($child);
        }

        return [] === $children ?
            ['value' => $this->getNodeRepresentation($node)] :
            ['value' => $this->getNodeRepresentation($node), 'children' => $children];
    }
}
