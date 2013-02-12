<?php

namespace Siphoc\PdfBundle\Tests\Converter;

use Siphoc\PdfBundle\Converter\CssPathToUrl;

class CssPathToUrlTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_url()
    {
        $converter = $this->getConverter();
        $this->assertEquals($this->getUrlFixture(), $converter->getUrl());

        $converter->setUrl('http://www.google.com');
        $this->assertEquals('http://www.google.com', $converter->getUrl());
    }

    public function test_it_converts_paths_to_links()
    {
        $converter = $this->getConverter();
        $htmlFile = $this->getFixturesPath() . '/stylesheet_test.html';

        $htmlData = file_get_contents($htmlFile);
        $externalStylesheets = $converter
            ->extractExternalStylesheets($htmlData);
        $links = $converter->replaceCssPaths($externalStylesheets['links']);

        $this->assertEquals(
            $this->getUrlFixture() . '/css/3809e64.css?1',
            $links[0]
        );
        $this->assertEquals(
            'http://google.com/css/3809e64.css',
            $links[1]
        );
    }

    public function test_it_replaces_css_tags_properly()
    {
        $converter = $this->getConverter();

        $htmlFile = $this->getFixturesPath() . '/stylesheet_test.html';
        $htmlData = file_get_contents($htmlFile);

        $expectedData = file_get_contents(
            $this->getFixturesPath() . '/converted_css_path.html'
        );
        $actualData = $converter->convertToString($htmlData);

        $this->assertEquals($expectedData, $actualData);
    }

    private function getFixturesPath()
    {
        return __DIR__ . '/../Fixtures';
    }

    private function getUrlFixture()
    {
        return 'http://siphoc.com';
    }

    private function getConverter()
    {
        $converter = new CssPathToUrl;
        $converter->setUrl($this->getUrlFixture());

        return $converter;
    }
}
