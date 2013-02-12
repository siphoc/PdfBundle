<?php

namespace Siphoc\PdfBundle\Tests\Generator;

use Siphoc\PdfBundle\Generator\PdfGenerator;

class PDFGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_converter()
    {
        $cssToInline = $this->getCssToInlineMock();
        $jsToHTML = $this->getJSToHTMLMock();
        $snappy = $this->getSnappyMock();

        $generator = new PdfGenerator($cssToInline, $jsToHTML, $snappy);
        $this->assertSame(
            $cssToInline, $generator->getCssToHTMLConverter()
        );
        $this->assertSame(
            $jsToHTML, $generator->getJSToHTMLConverter()
        );
        $this->assertSame(
            $snappy, $generator->getGenerator()
        );
    }

    public function test_it_converts_html()
    {
        $cssToInline = $this->getCssToInlineMock();
        $jsToHTML = $this->getJSToHTMLMock();
        $snappy = $this->getSnappyMock();

        $generator = new PdfGenerator($cssToInline, $jsToHTML, $snappy);
        $output = $generator->getOutputFromHtml('<html><head></head><body></body></html>');
        $this->assertEquals('PDFOutput', $output);
    }

    private function getSnappyMock()
    {
        // we're not going to test the actual PDF convertion. That's a job for
        // the guys at KNP.
        $snappy = $this->getMockBuilder('Knp\Snappy\Pdf')
            ->disableOriginalConstructor()->getMock();

        $snappy->expects($this->any())
            ->method('getOutputFromHtml')
            ->will($this->returnValue('PDFOutput'));

        return $snappy;
    }

    private function getJSToHTMLMock()
    {
        $converter = $this->getMockBuilder('Siphoc\PdfBundle\Converter\JSToHTML')
            ->disableOriginalConstructor()->getMock();

        $converter->expects($this->any())
            ->method('convertToString')
            ->will($this->returnValue($this->getHTML()));

        return $converter;
    }

    private function getCssToInlineMock()
    {
        $converter = $this->getMockBuilder('Siphoc\PdfBundle\Converter\CssToHTML')
            ->disableOriginalConstructor()->getMock();

        $converter->expects($this->any())
            ->method('convertToString')
            ->will($this->returnValue($this->getHTML()));

        return $converter;
    }

    private function getHTML()
    {
        return file_get_contents(
            __DIR__ . '/../Fixtures/converted_css_data.html'
        );
    }
}
