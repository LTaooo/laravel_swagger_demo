<?php

namespace Tests\Unit;

use Error;
use PhpParser\NodeDumper;
use PhpParser\ParserFactory;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $code = <<<'CODE'
<?php

function test(int $foo): \App\Http\Dto\Response\StudentResponseDto
{
    return $foo * 2;
}
CODE;

        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        try {
            $ast = $parser->parse($code);
        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";
            return;
        }

        $dumper = new NodeDumper;
        echo $dumper->dump($ast) . "\n";

        $this->assertTrue(true);
    }
}
