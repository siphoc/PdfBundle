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
 * Convert the relative CSS links to full url paths for all our CSS files in
 * an HTML file.
 *
 * @author Jelmer Snoeck <jelmer@darwinanalytics.com>
 */
class CssPathToUrl extends CssConverter
{
    /**
     * The url we'll use to point to our CSS files.
     *
     * @var string
     */
    protected $url;

    /**
     * Convert the link tags in the specified string so that the relative
     * paths are replaces with a proper url implementation.
     *
     * @param string $html
     * @return $html
     */
    public function convertToString($html)
    {
        $extractedStylesheets = $this->extractExternalStylesheets($html);
        $links = $this->replaceCssPaths($extractedStylesheets['links']);

        $externalStylesheets =  array(
            'tags' => $extractedStylesheets[0],
            'actual_links' => $extractedStylesheets['links'],
            'links' => $links,
        );

        $html = $this->replaceExternalCss($html, $externalStylesheets);

        return $html;
    }

    /**
     * Replace a given set of links with the proper url if it is an external
     * css file.
     *
     * @param  array $links
     * @return array
     */
    public function replaceCssPaths(array $links)
    {
        foreach ($links as $key => $link) {
            if (!$this->isExternalStylesheet($link)) {
                $links[$key] = $this->getUrl() . $link;
            }
        }

        return $links;
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
            $newTag = str_replace(
                $stylesheets['actual_links'][$key],
                $stylesheet,
                $stylesheets['tags'][$key]
            );

            $html = str_replace($stylesheets['tags'][$key], $newTag, $html);
        }

        return $html;
    }

    /**
     * Set the URL we'll use to point our CSS files to.
     *
     * @param  string       $url
     * @return CssPathToUrl
     */
    public function setUrl($url)
    {
        $this->url = (string) $url;

        return $this;
    }

    /**
     * Retrieve the URL we're using to point our CSS files to.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
