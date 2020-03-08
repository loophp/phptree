<?php

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use Exception;
use loophp\phptree\Node\NodeInterface;

use const PHP_OS;

/**
 * Class Image.
 */
final class Image implements ExporterInterface
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
        if (0 === mb_stripos(PHP_OS, 'WIN')) {
            $this->executable = 'dot.exe';
        }
    }

    /**
     * @param \loophp\phptree\Node\NodeInterface $node
     *
     * @throws Exception
     *
     * @return string
     */
    public function export(NodeInterface $node): string
    {
        if (false === $tmp = tempnam(sys_get_temp_dir(), 'phptree-export-')) {
            return '';
        }

        file_put_contents($tmp, (new Gv())->export($node));

        return shell_exec($this->getConvertCommand($tmp));
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
     * @return \loophp\phptree\Exporter\Image
     */
    public function setExecutable(string $executable): self
    {
        $this->executable = $executable;

        return $this;
    }

    /**
     * @param string $format
     *
     * @return \loophp\phptree\Exporter\Image
     */
    public function setFormat(string $format): self
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
        return sprintf(
            '%s -T%s %s',
            $this->getExecutable(),
            $this->getFormat(),
            $path
        );
    }
}
