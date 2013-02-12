<?php
/**
 * Siphoc
 *
 * @author      Jelmer Snoeck <jelmer@siphoc.com>
 * @copyright   2013 Siphoc
 * @link        http://siphoc.com
 */

namespace Siphoc\PdfBundle\Converter;

/**
 * Abstract class that represents all the CSS Converters. Here we'll do some
 * basic functionality like our regexes.
 *
 * @author Jelmer Snoeck <jelmer@darwnanalytics.com>
 */
abstract class CssConverter implements ConverterInterface
{
    /**
     * Extract the external stylesheets from the specified HTML if the option is
     * enabled. If the stylesheet is not in the form of a url, prepend our
     * basePath.
     *
     * @param  string $html
     * @return array
     */
    public function extractExternalStylesheets($html)
    {
        $matches = array();

        preg_match_all(
            '/' . $this->getExternalStylesheetRegex() . '/',
            $html, $matches
        );

        return $matches;
    }

    /**
     * The regex that we'll use to extract external stylesheets.
     *
     * @return string
     */
    protected function getExternalStylesheetRegex()
    {
        return '<link(.*)href="(?(?=.*css)(?P<links>.[^">\ ]*)|)"(.*)>';
    }

    /**
     * Check if the given string is a string for a local stylesheet or an
     * external stylesheet.
     *
     * @TODO: Improve regex to contain bigger range of urls.
     *
     * @param  string  $url
     * @return boolean
     */
    protected function isExternalStylesheet($url)
    {
        if (1 === preg_match('/(http|https):\/\//', $url)) {
            return true;
        }

        return false;
    }
}
