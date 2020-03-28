<?php

declare(strict_types=1);

namespace spec\loophp\phptree\Importer;

use loophp\phptree\Importer\MicrosoftTolerantPhpParser;
use loophp\phptree\Node\AttributeNodeInterface;
use Microsoft\PhpParser\Parser;
use PhpSpec\ObjectBehavior;

class MicrosoftTolerantPhpParserSpec extends ObjectBehavior
{
    public function it_can_import(): void
    {
        $file = __DIR__ . '/../../../../src/Node/Node.php';

        $parser = new Parser();
        $ast = $parser->parseSourceFile(file_get_contents($file));

        $this
            ->import($ast)
            ->shouldImplement(AttributeNodeInterface::class);

        $this
            ->import($ast)
            ->count()
            ->shouldReturn(586);

        $file = __DIR__ . '/../../../../tests/sample.php';

        $ast = $parser->parseSourceFile(file_get_contents($file));

        $this
            ->import($ast)
            ->count()
            ->shouldReturn(117);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(MicrosoftTolerantPhpParser::class);
    }
}
