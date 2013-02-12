<?php

namespace Siphoc\PdfBundle\Tests\Converter;

use Siphoc\PdfBundle\Converter\CssConverter;

class CssConverterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_extracts_external_stylesheets()
    {
        $converter = $this->getConverter();
        $htmlFile = $this->getFixturesPath() . '/stylesheet_test.html';

        $htmlData = file_get_contents($htmlFile);
        $extractedStylesheets = $converter
            ->extractExternalStylesheets($htmlData);

        $this->assertEquals(
            '/css/3809e64.css?1',
            $extractedStylesheets['links'][0]
        );
        $this->assertEquals(
            'http://google.com/css/3809e64.css',
            $extractedStylesheets['links'][1]
        );
    }

    private function getFixturesPath()
    {
        return __DIR__ . '/../Fixtures';
    }

    private function getConverter()
    {
        $converter = new SpecificImplementation;

        return $converter;
    }
}

class SpecificImplementation extends CssConverter
{
    public function convertToString($html) {}
}
