<?php
/**
 * Siphoc
 *
 * @author      Jelmer Snoeck <jelmer@siphoc.com>
 * @copyright   2013 Siphoc
 * @link        http://siphoc.com
 */

namespace Siphoc\PdfBundle\Util;

/**
 * Given a HTML page, take the external JS files and put it in the HTML with
 * <script> tags.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class JSToHTML
{
    /**
     * The basepath for our JS files. This is basically the /web folder.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Given a HTML string, find all the JS files that should be loaded.
     *
     * @param string $html
     * @return array
     */
    public function extractExternalJavaScript($html)
    {
        $matches = array();

        preg_match_all(
            '|' . $this->getExternalJavaScriptRegex() . '|',
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
     * Check if a JavaScript file is a local or externalJavaScript file or. If
     * it is a local file, prepend our basepath to the link so we can properly
     * fetch the data to insert.
     *
     * @param array $javascripts
     * @return array
     */
    private function createJavaScriptPaths(array $javascripts)
    {
        $files = array();

        foreach ($javascripts as $file) {
            if (!$this->isExternalJavaScriptFile($file)) {
                $file = $this->getBasePath() . $file;
            }

            $files[] = $file;
        }

        return $files;
    }

    /**
     * This contains the regex we'll use to find the JS files in a given string.
     *
     * @TODO improve regex to contain more possible matches.
     *
     * @return string
     */
    private function getExternalJavaScriptRegex()
    {
        return '<script(.*)src="(?P<links>.*)"></script>';
    }

    /**
     * Check if the given string is a string for a local JavaScript file or an
     * external JavaScript.
     *
     * @TODO: Improve regex to contain bigger range of urls.
     *
     * @param string $url
     * @return boolean
     */
    private function isExternalJavaScriptFile($url)
    {
        if (1 === preg_match('/(http|https):\/\//', $url)) {
            return true;
        }

        return false;
    }
}
