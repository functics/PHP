<?

namespace Patterns\AbstractFactory;

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testCanCreateHtmlText()
    {
        $factory = new HtmlFactory();

        $text = $factory->createText('foobar');

        $this->assertInstanceOf(HtmlText::class, $text);
    }

    public function testCanCreateJsonText()
    {
        $factory = new JsonFactory();

        $text = $factory->createText('foobar');

        $this->assertInstanceOf(JsonFactory::class, $text);
    }
}