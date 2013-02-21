<?php
/**
 * Siphoc
 *
 * @author      Jelmer Snoeck <jelmer@siphoc.com>
 * @copyright   2013 Siphoc
 * @link        http://siphoc.com
 */

namespace Siphoc\PdfBundle\Converter;

use Siphoc\PdfBundle\Util\RequestHandlerInterface;

/**
 * Convert a view to a proper inline CSS html page.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class CssToHTML extends CssConverter
{
    /**
     * The basepath for our css files. This is basically the /web folder.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The request handler we'll be using to call external domains.
     *
     * @var RequestHandlerInterface
     */
    protected $requestHandler;

    /**
     * Initiate the CssToHTML converter for Symfony2.
     *
     * @param RequestHandlerInterface $requestHandler
     */
    public function __construct(RequestHandlerInterface $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    /**
     * Convert a specified HTML string with CSS data to a HTML string with
     * inline CSS data in proper <style> blocks.
     *
     * @param  string $html
     * @return string
     */
    public function convertToString($html)
    {
        $extractedStylesheets = $this->extractExternalStylesheets($html);
        $links = $this->createStylesheetPaths($extractedStylesheets['links']);

        $externalStylesheets =  array(
            'tags' => $extractedStylesheets[0],
            'links' => $links
        );

        $html = $this->replaceExternalCss($html, $externalStylesheets);

        return $html;
    }

    /**
     * Check if a stylesheet is a local stylesheet or an external stylesheet. If
     * it is a local stylesheet, prepend our basepath to the link so we can
     * properly fetch the data to insert.
     *
     * @param  array $stylesheets
     * @return array
     */
    public function createStylesheetPaths(array $stylesheets)
    {
        $sheets = array();

        foreach ($stylesheets as $key => $sheet) {
            if (!$this->isExternalStylesheet($sheet)) {
                // assetic version removal
                $sheet = str_replace(strrchr($sheet, 'css?'), 'css', $sheet);
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
     * Retrieve the contents from a CSS file.
     *
     * @param  string $path
     * @return string
     */
    private function getStylesheetContent($path)
    {
        if ($this->isExternalStylesheet($path)) {
            $cssData = $this->getRequestHandler()->getContent($path);
        } else {
            if (file_exists($path)) {
                $cssData = file_get_contents($path);
            } else {
                return;
            }
        }

        $cssData = $this->replaceLocalUrlTags($cssData);

        return "<style type=\"text/css\">\n" . $cssData . '</style>';
    }

    /**
     * From a given CSS string, replace all the local url tags. This means
     * replacing all the url(x) tags.
     *
     * @param  string $css
     * @return string
     */
    private function replaceLocalUrlTags($css)
    {
        $urlMatches = array();

        preg_match_all(
            '!url\((?P<urls>.[^)]*)\)!isU',
            $css, $urlMatches
        );

        foreach ($urlMatches[0] as $key => $tag) {
            if (!$this->isExternalStylesheet($tag)) {
                $url = $this->getBasePath() . $urlMatches['urls'][$key];

                $css = str_replace(
                    $tag,
                    'url(' . $url . ')',
                    $css
                );
            }
        }

        return $css;
    }

    /**
     * From a set of external stylesheets, retrieve the data and replace the
     * matching CSS tag with the contents.
     *
     * @param  string $html
     * @param  array  $stylesheets
     * @return string
     */
    public function replaceExternalCss($html, array $stylesheets)
    {
        foreach ($stylesheets['links'] as $key => $stylesheet) {
            if (!$this->isExternalStylesheet($stylesheet)) {
                $html = str_replace(
                    $stylesheets['tags'][$key],
                    $this->getStylesheetContent($stylesheet),
                    $html
                );
            }
        }

        return $html;
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
     * Set the base path we'll use to fetch our css files from.
     *
     * @param  string    $basePath The base path where our css files are.
     * @return CssToHTML
     */
    public function setBasePath($basePath)
    {
        $this->basePath = (string) $basePath;

        return $this;
    }
}
