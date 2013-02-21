<?php

namespace Siphoc\PdfBundle\Tests\Converter;

use Siphoc\PdfBundle\Converter\CssToHTML;

class CssToHTMLTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor_with_basic_data()
    {
        $requestHandler = $this->getRequestHandlerMock();
        $converter = new CssToHTML($requestHandler);
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

    public function test_it_creates_proper_stylesheet_paths()
    {
        $converter = $this->getConverter();
        $htmlFile = $this->getFixturesPath() . '/stylesheet_test.html';

        $htmlData = file_get_contents($htmlFile);
        $extractedStylesheets = $converter
            ->extractExternalStylesheets($htmlData);
        $links = $converter
            ->createStylesheetPaths($extractedStylesheets['links']);

        $this->assertEquals(
            $this->getFixturesPath() . '/css/3809e64.css',
            $links[0]
        );
        $this->assertEquals(
            'http://google.com/css/3809e64.css',
            $links[1]
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
        $convertedData = str_replace(
            '{{ FixturesPath }}', $this->getFixturesPath(),
            $convertedData
        );

        $this->assertEquals(
            $convertedData,
            $converter->convertToString($htmlData)
        );
    }

    public function test_it_skips_unexisting_stylesheets()
    {
        $converter = $this->getConverter();

        $htmlFile = $this->getFixturesPath() . '/faulty_css_file.html';
        $htmlData = file_get_contents($htmlFile);
        $convertedData = file_get_contents(
            $this->getFixturesPath() . '/converted_faulty_css_data.html'
        );
        $convertedData = str_replace(
            '{{ FixturesPath }}', $this->getFixturesPath(),
            $convertedData
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
        $converter = new CssToHTML($this->getRequestHandlerMock());
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
