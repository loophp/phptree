<?php

declare(strict_types=1);

namespace loophp\phptree\Builder;

use loophp\phptree\Node\NodeInterface;

use function is_callable;

class Random implements BuilderInterface
{
    public static function create(iterable $nodes): ?NodeInterface
    {
        $root = null;

        foreach ($nodes as $key => $value) {
            if (0 === $key) {
                $root = self::createNode($value);

                continue;
            }

            if (!$root instanceof NodeInterface) {
                continue;
            }

            self::pickRandomNode($root)->add(self::createNode($value));
        }

        return $root;
    }

    /**
     * @param array<int, class-string|callable():(NodeInterface)|mixed> $parameters
     */
    private static function createNode(array $parameters = []): NodeInterface
    {
        $parameters = array_map(
            /**
             * @param class-string|callable():(NodeInterface)|mixed $parameter
             *
             * @return class-string|mixed
             */
            static function ($parameter) {
                if (is_callable($parameter)) {
                    return $parameter();
                }

                return $parameter;
            },
            $parameters
        );

        $class = array_shift($parameters);

        return new $class(...$parameters);
    }

    private static function pickRandomNode(NodeInterface $node): NodeInterface
    {
        $pick = (int) random_int(0, $node->count());

        $i = 0;

        foreach ($node->all() as $child) {
            if (++$i === $pick) {
                return $child;
            }
        }

        return $node;
    }
}
