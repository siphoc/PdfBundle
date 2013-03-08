<?php

namespace Siphoc\PdfBundle\Tests\Converter;

use Siphoc\PdfBundle\Converter\JSToHTML;

class JSToHTMLTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor_with_basic_data()
    {
        $requestHandler = $this->getRequestHandlerMock();
        $converter = new JSToHTML($requestHandler);
        $this->assertNull($converter->getBasePath());
        $this->assertSame(
            $requestHandler,
            $converter->getRequestHandler()
        );
    }

    public function test_it_stores_web_path()
    {
        $this->assertEquals(
            $this->getFixturesPath(),
            $this->getConverter()->getBasePath()
        );
    }

    public function test_it_extracts_javascript_files()
    {
        $converter = $this->getConverter();
        $htmlData = file_get_contents(
            $this->getFixturesPath() . '/javascript_test.html'
        );
        $jsFiles = $converter->extractExternalJavaScript($htmlData);

        $this->assertEquals(
            '<script type="text/javascript" src="/js/foo.js?1"></script>',
            $jsFiles['tags'][0]
        );
        $this->assertEquals(
            $this->getFixturesPath() . '/js/foo.js',
            $jsFiles['links'][0]
        );
        $this->assertEquals(
            '<script type="text/javascript" src="/js/foo.js"></script>',
            $jsFiles['tags'][1]
        );
        $this->assertEquals(
            $this->getFixturesPath() . '/js/foo.js',
            $jsFiles['links'][1]
        );
        $this->assertEquals(
            'http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js',
            $jsFiles['links'][2]
        );
    }

    public function test_it_converts_files()
    {
        $converter = $this->getConverter();
        $htmlData = file_get_contents(
            $this->getFixturesPath() . '/javascript_test.html'
        );
        $convertedData = file_get_contents(
            $this->getFixturesPath() . '/converted_js_data.html'
        );

        $this->assertEquals(
            $convertedData,
            $converter->convertToString($htmlData)
        );
    }

    private function getFixturesPath()
    {
        return __DIR__ . '/../Fixtures';
    }

    private function getConverter()
    {
        $converter = new JSToHTML($this->getRequestHandlerMock());
        $converter->setBasePath($this->getFixturesPath());

        return $converter;
    }

    private function getRequestHandlerMock()
    {
        $request =  $this->getMock('Buzz\Message\Request');
        $response =  $this->getMock('Buzz\Message\Response');
        $client =  $this->getMock('\Buzz\Client\FileGetContents');

        $handler = $this->getMock(
            'Siphoc\PdfBundle\Util\BuzzRequestHandler',
            array('getContent'), array($request, $response, $client)
        );

        $handler->expects($this->any())
            ->method('getContent')
            ->will($this->returnValue("$('jquery');\n"));

        return $handler;
    }
}
