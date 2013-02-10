<?php
/**
 * Siphoc
 *
 * @author      Jelmer Snoeck <jelmer@siphoc.com>
 * @copyright   2013 Siphoc
 * @link        http://siphoc.com
 */

namespace Siphoc\PdfBundle\Util;

use Knp\Snappy\GeneratorInterface;
use Siphoc\PdfBundle\Util\CssToInline;
use Siphoc\PdfBundle\Util\JSToHTML;

/**
 * The actual PDF Generator that'll transform a view into a proper PDF.
 *
 * @TODO: enable view name support. This means giving the view name + parameters
 * and rendering all the required data to properly build a PDF.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class PdfGenerator
{
    /**
     * The CssToInline Converter.
     *
     * @var CssToInline
     */
    protected $cssToInline;

    /**
     * The JSToHTML Converter.
     *
     * @var JSToHTML
     */
    protected $jsToHTML;

    /**
     * Initiate the PDF Generator.
     *
     * @param CssToInline $cssToInline
     * @param JSToHTML $jsToHTML
     * @param GeneratorInterface $generator
     */
    public function __construct(CssToInline $cssToInline, JSToHTML $jsToHTML,
        GeneratorInterface $generator)
    {
        $this->cssToInline = $cssToInline;
        $this->jsToHTML = $jsToHTML;
        $this->generator = $generator;
    }

    /**
     * Get the CssToInline Converter.
     *
     * @return CssToInline
     */
    public function getCssToInlineConverter()
    {
        return $this->cssToInline;
    }

    /**
     * Get the JSToHTML Converter.
     *
     * @return JSToHTML
     */
    public function getJSToHTMLConverter()
    {
        return $this->jsToHTML;
    }

    /**
     * Retrieve the generator we're using to convert our data to HTML.
     *
     * @return GeneratorInterface
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * Generate the PDF from a given HTML string. Replace all the CSS and JS
     * tags with inline blocks/code.
     *
     * @param string $html
     * @param array $options
     * @return string
     */
    public function getOutputFromHtml($html, array $options = array())
    {
        $html = $this->getCssToInlineConverter()->convertToString($html);
        $html = $this->getJSToHTMLConverter()->convertToString($html);

        return $this->getGenerator()->getOutputFromHtml($html, $options);
    }
}
