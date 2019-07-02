<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;

/**
 * Class Image.
 */
class Image extends Gv
{
    /**
     * @var string
     */
    private $executable = 'dot';
    /**
     * @var string
     */
    private $format = 'svg';

    /**
     * Image constructor.
     */
    public function __construct()
    {
        if (0 === \stripos(PHP_OS, 'WIN')) {
            $this->executable = 'dot.exe';
        }
    }

    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @throws \Exception
     *
     * @return string
     */
    public function export(NodeInterface $node): string
    {
        $path = $this->getTemporaryFile();

        $this->writeToFile($path, parent::export($node));

        \system($this->getConvertCommand($path));

        return \sprintf('%s.%s', $path, $this->getFormat());
    }

    /**
     * Get the executable to use.
     *
     * @return string
     */
    public function getExecutable(): string
    {
        return $this->executable;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Change the executable to use.
     *
     * @param string $executable
     *
     * @return \drupol\phptree\Exporter\Image
     */
    public function setExecutable(string $executable): Image
    {
        $this->executable = $executable;

        return $this;
    }

    /**
     * @param string $format
     *
     * @return \drupol\phptree\Exporter\Image
     */
    public function setFormat(string $format): Image
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function getConvertCommand(string $path): string
    {
        return \sprintf(
            '%s -T%s %s -o %s.%s',
            $this->getExecutable(),
            $this->getFormat(),
            $path,
            $path,
            $this->getFormat()
        );
    }

    /**
     * @throws \Exception
     *
     * @return string
     */
    private function getTemporaryFile(): string
    {
        $path = \tempnam(\sys_get_temp_dir(), 'graphviz');

        if (false === $path) {
            throw new \Exception('Unable to get temporary file name for graphviz script');
        }

        return $path;
    }

    /**
     * @param string $path
     * @param string $content
     *
     * @throws \Exception
     *
     * @return bool
     */
    private function writeToFile(string $path, string $content): bool
    {
        $ret = \file_put_contents($path, $content, LOCK_EX);

        if (false === $ret) {
            throw new \Exception('Unable to write graphviz script to temporary file');
        }

        return true;
    }
}
