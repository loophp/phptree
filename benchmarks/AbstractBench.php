<?php

declare(strict_types = 1);

namespace drupol\phptree\benchmarks;

abstract class AbstractBench
{
    /**
     * @return array
     */
    public function getData()
    {
        return \range(1, 1000);
    }
}
