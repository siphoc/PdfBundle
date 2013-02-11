<?php

namespace Siphoc\PdfBundle\Tests\Util;

use Siphoc\PdfBundle\Util\CssToInline;

class CssToInlineTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor_with_basic_data()
    {
        $requestHandler = $this->getRequestHandlerMock();
        $converter = new CssToInline($requestHandler);
        $this->assertNull($converter->getBasePath());
        $this->assertSame($requestHandler, $converter->getRequestHandler());
    }

    public function test_it_stores_web_path()
    {
        $this->assertEquals(
            $this->getFixturesPath(),
            $this->getConverter()->getBasePath()
        );
    }

    public function test_it_extracts_external_stylesheets()
    {
        $converter = $this->getConverter();
        $htmlFile = $this->getFixturesPath() . '/stylesheet_test.html';

        $htmlData = file_get_contents($htmlFile);
        $externalStylesheets = $converter
            ->extractExternalStylesheets($htmlData);

        $this->assertEquals(
            $this->getFixturesPath() . '/css/3809e64.css',
            $externalStylesheets['links'][0]
        );
        $this->assertEquals(
            'http://google.com/css/3809e64.css',
            $externalStylesheets['links'][1]
        );
    }

    public function test_it_inlines_external_stylesheets()
    {
        $converter = $this->getConverter();

        $htmlFile = $this->getFixturesPath() . '/stylesheet_test.html';
        $htmlData = file_get_contents($htmlFile);
        $convertedData = file_get_contents(
            $this->getFixturesPath() . '/converted_css_data.html'
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
        $converter = new CssToInline($this->getRequestHandlerMock());
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
            ->will($this->returnValue("h2{ font-size: 15px; }"));

        return $handler;
    }
}
