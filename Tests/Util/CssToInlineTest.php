<?php

namespace Siphoc\PdfBundle\Tests\Util;

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Siphoc\PdfBundle\Util\CssToInline;

class CssToInlineTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor_with_basic_data()
    {
        $inline = new CssToInlineStyles;
        $converter = new CssToInline($inline);
        $this->assertSame($inline, $converter->getConverter());
        $this->assertNull($converter->getBasePath());
        $this->assertFalse($converter->useExternalStylesheets());
    }

    public function test_it_stores_web_path()
    {
        $this->assertEquals(
            $this->getFixturesPath(),
            $this->getConverter()->getBasePath()
        );
    }

    public function test_it_toggles_external_stylesheets()
    {
        $converter = $this->getConverter();

        $converter->enableExternalStylesheets();
        $this->assertTrue($converter->useExternalStylesheets());

        $converter->disableExternalStylesheets();
        $this->assertFalse($converter->useExternalStylesheets());
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
            $externalStylesheets[0]
        );
        $this->assertEquals(
            'http://google.com/css/3809e64.css',
            $externalStylesheets[1]
        );
    }

    public function test_it_concatenates_all_external_stylesheets()
    {
        $converter = $this->getConverter();
        $htmlFile = $this->getFixturesPath() . '/raw_data.html';
        $htmlData = file_get_contents($htmlFile);
        $externalStylesheets = $converter
            ->extractExternalStylesheets($htmlData);

        $cssData = $converter->getExternalCss($externalStylesheets);
        $rawData = file_get_contents(
            $this->getFixturesPath() . '/css/3809e64.css'
        );

        $this->assertEquals($rawData, $cssData);
    }

    public function test_it_strips_external_stylesheet_tags()
    {
        $converter = $this->getConverter();
        $htmlFile = $this->getFixturesPath() . '/raw_data.html';
        $htmlData = file_get_contents($htmlFile);
        $strippedTags = file_get_contents(
            $this->getFixturesPath() . '/stripped_css_tags.html'
        );

        $this->assertEquals(
            $strippedTags,
            $converter->stripExternalStylesheetTags($htmlData)
        );
    }

    public function test_it_inlines_external_stylesheets()
    {
        $converter = $this->getConverter();
        $converter->enableExternalStylesheets();

        $htmlFile = $this->getFixturesPath() . '/raw_data.html';
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
        $inline = new CssToInlineStyles;
        $converter = new CssToInline($inline);
        $converter->setBasePath($this->getFixturesPath());

        return $converter;
    }
}
