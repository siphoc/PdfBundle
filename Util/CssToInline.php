<?php
/**
 * Siphoc
 *
 * @author      Jelmer Snoeck <jelmer@siphoc.com>
 * @copyright   2013 Siphoc
 * @link        http://siphoc.com
 */

namespace Siphoc\PdfBundle\Util;

use Siphoc\PdfBundle\Util\RequestHandlerInterface;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

/**
 * Convert a view to a proper inline CSS html page.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class CssToInline
{
    /**
     * The basepath for our css files. This is basically the /web folder.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The converter used for the inline replacement.
     *
     * @var CssToInlineStyles
     */
    protected $converter;

    /**
     * Follow external stylesheet files or not?
     *
     * @var boolean
     */
    protected $externalStylesheets = false;

    /**
     * The request handler we'll be using to call external domains.
     *
     * @var RequestHandlerInterface
     */
    protected $requestHandler;

    /**
     * Initiate the CssToInline converter for Symfony2.
     *
     * @param CssToInlineStyles $converter
     * @param RequestHandlerInterface $requestHandler
     */
    public function __construct(CssToInlineStyles $converter,
        RequestHandlerInterface $requestHandler)
    {
        $this->converter = $converter;
        $this->requestHandler = $requestHandler;
    }

    /**
     * Convert a specified HTML string with CSS data to a HTML string with
     * inline CSS data.
     *
     * @param string $html
     * @return string
     */
    public function convertToString($html)
    {
        $this->setConvertionOptions($html);
        $convertedHtml = $this->converter->convert();

        return $convertedHtml;
    }

    /**
     * Disable the usage of the <link stylesheets> tag in our HTML.
     *
     * @return CssToInline
     */
    public function disableExternalStylesheets()
    {
        $this->externalStylesheets = false;

        return $this;
    }

    /**
     * Enable the usage of the <link stylesheets> tag in our HTML.
     *
     * @return CssToInline
     */
    public function enableExternalStylesheets()
    {
        $this->externalStylesheets = true;

        return $this;
    }

    /**
     * Extract the external stylesheets from the specified HTML if the option is
     * enabled. If the stylesheet is not in the form of a url, prepend our
     * basePath.
     *
     * @param string $html
     * @return array
     */
    public function extractExternalStylesheets($html)
    {
        $matches = array();

        preg_match_all(
            '/' . $this->getExternalStylesheetRegex() . '/',
            $html, $matches
        );

        return $this->createStylesheetPaths($matches['links']);
    }

    /**
     * Check if a stylesheet is a local stylesheet or an external stylesheet. If
     * it is a local stylesheet, prepend our basepath to the link so we can
     * properly fetch the data to insert.
     *
     * @param array $stylesheets
     * @return array
     */
    private function createStylesheetPaths(array $stylesheets)
    {
        $sheets = array();

        foreach ($stylesheets as $key => $sheet) {
            if (!$this->isExternalStylesheet($sheet)) {
                $sheet = $this->getBasePath() . $sheet;
            }

            $sheets[] = $sheet;
        }

        return $sheets;
    }

    /**
     * Retrieve the BasePath used for this inline action.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Retrieve the previously set converter.
     *
     * @return CssToInlineStyles
     */
    public function getConverter()
    {
        return $this->converter;
    }

    /**
     * From a set of external stylesheets, retrieve the data and concatenate it
     * to one proper stylesheet string.
     *
     * @TODO: Implement fetching from other servers.
     *
     * @param array $stylesheets
     * @return string
     */
    public function getExternalCss(array $stylesheets)
    {
        $cssData = '';

        foreach ($stylesheets as $stylesheet) {
            if ($this->isExternalStylesheet($stylesheet)) {
                $cssData .= $this->getRequestHandler()->getContent($stylesheet);
            } else {
                if (file_exists($stylesheet)) {
                    $cssData .= file_get_contents($stylesheet);
                }
            }
        }

        return $cssData;
    }

    /**
     * Retrieve the request handler.
     *
     * @return RequestHandlerInterface
     */
    public function getRequestHandler()
    {
        return $this->requestHandler;
    }

    /**
     * Check if the given string is a string for a local stylesheet or an
     * external stylesheet.
     *
     * @TODO: Improve regex to contain bigger range of urls.
     *
     * @param string $url
     * @return boolean
     */
    private function isExternalStylesheet($url)
    {
        if (1 === preg_match('/(http|https):\/\//', $url)) {
            return true;
        }

        return false;
    }

    /**
     * Set the base path we'll use to fetch our css files from.
     *
     * @param string $basePath      The base path where our css files are.
     * @return CssToInline
     */
    public function setBasePath($basePath)
    {
        $this->basePath = (string) $basePath;

        return $this;
    }

    /**
     * Strip the external stylesheet tags from a specified HTML string.
     *
     * @param string $html
     * @return string
     */
    public function stripExternalStylesheetTags($html)
    {
        $html = preg_replace(
            '/' . $this->getExternalStylesheetRegex() . '\n/',
            '', $html
        );

        return $html;
    }

    /**
     * Are we allowed to follow <link stylesheet> tags to include these
     * stylesheets in our page?
     *
     * @return boolean
     */
    public function useExternalStylesheets()
    {
        return $this->externalStylesheets;
    }

    /**
     * Set allt he options wanted to convert our HTML page into an inline CSS
     * page.
     *
     * @param string $html
     */
    private function setConvertionOptions($html)
    {
        if ($this->useExternalStylesheets()) {
            $externalStylesheets = $this->extractExternalStylesheets($html);
            $html = $this->stripExternalStylesheetTags($html);

            $externalCss = $this->getExternalCss($externalStylesheets);
            $this->converter->setCss($externalCss);
        }

        $this->converter->setUseInlineStylesBlock(true);
        $this->converter->setHtml($html);
    }

    /**
     * The regex that we'll use to extract external stylesheets.
     *
     * @return string
     */
    private function getExternalStylesheetRegex()
    {
        return '<link(.*)href="(?(?=.*css)(?P<links>.*)|)"(.*)>';
    }
}
