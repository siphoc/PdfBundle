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
 * Given a HTML page, take the external JS files and put it in the HTML with
 * <script> tags.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class JSToHTML implements ConverterInterface
{
    /**
     * The basepath for our JS files. This is basically the /web folder.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The request handler used for external calls.
     *
     * @var RequestHandlerInterface
     */
    protected $requestHandler;

    /**
     * Initiate the JSToHTML class with the request handler interface.
     *
     * @param RequestHandlerInterface $handler
     */
    public function __construct(RequestHandlerInterface $handler)
    {
        $this->requestHandler = $handler;
    }

    /**
     * Extract all the linked JS files and put them in the proper place on the
     * given HTML string.
     *
     * @param  string $html
     * @return string
     */
    public function convertToString($html)
    {
        $externalJavaScript = $this->extractExternalJavaScript($html);

        return $this->replaceJavaScriptTags($html, $externalJavaScript);
    }

    /**
     * Given a HTML string, find all the JS files that should be loaded.
     *
     * @param  string $html
     * @return array
     */
    public function extractExternalJavaScript($html)
    {
        $matches = array();

        preg_match_all(
            '!' . $this->getExternalJavaScriptRegex() . '!isU',
            $html, $matches
        );

        $links = $this->createJavaScriptPaths($matches['links']);

        return array('tags' => $matches[0], 'links' => $links);
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
     * Retrieve the Request Handler used for external calls.
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
     * @param  string      $basePath The base path where our css files are.
     * @return CssToInline
     */
    public function setBasePath($basePath)
    {
        $this->basePath = (string) $basePath;

        return $this;
    }

    /**
     * Check if a JavaScript file is a local or externalJavaScript file or. If
     * it is a local file, prepend our basepath to the link so we can properly
     * fetch the data to insert.
     *
     * @param  array $javascripts
     * @return array
     */
    private function createJavaScriptPaths(array $javascripts)
    {
        $files = array();

        foreach ($javascripts as $file) {
            if (!$this->isExternalJavaScriptFile($file)) {

                if (false !== strpos($file, '?')) {
                    $file = strstr($file, '?', true);
                }

                $file = $this->getBasePath() . $file;
            }

            $files[] = $file;
        }

        return $files;
    }

    /**
     * This contains the regex we'll use to find the JS files in a given string.
     *
     * @return string
     */
    private function getExternalJavaScriptRegex()
    {
        return '<script(.*)src="(?(?=.*\.js)(?P<links>.[^">\ ]*)|)"(.*)></script>';
    }

    /**
     * Fetch the content of a JavaScript file from a given path.
     *
     * @param  string $path
     * @return string
     */
    private function getJavaScriptContent($path)
    {
        if ($this->isExternalJavaScriptFile($path)) {
            $fileData = $this->getRequestHandler()->getContent($path);
        } else {
            $fileData = '';
            if (file_exists($path)) {
                $fileData = file_get_contents($path);
            }
        }

        return "<script type=\"text/javascript\">\n" . $fileData . "</script>";
    }

    /**
     * Check if the given string is a string for a local JavaScript file or an
     * external JavaScript.
     *
     * @TODO: Improve regex to contain bigger range of urls.
     *
     * @param  string  $url
     * @return boolean
     */
    private function isExternalJavaScriptFile($url)
    {
        if (1 === preg_match('/(http|https):\/\//', $url)) {
            return true;
        }

        return false;
    }

    /**
     * Replace the JavaScript tags that do external requests with inline
     * script blocks.
     *
     * @param  string $html
     * @param  array  $javaScriptFiles
     * @return string
     */
    private function replaceJavaScriptTags($html, array $javaScriptFiles)
    {
        foreach ($javaScriptFiles['links'] as $key => $file) {
            if (!$this->isExternalJavaScriptFile($file)) {
                $html = str_replace(
                    $javaScriptFiles['tags'][$key],
                    $this->getJavaScriptContent($file),
                    $html
                );
            }
        }

        return $html;
    }
}
