<?php
/**
 * Siphoc
 *
 * @author      Jelmer Snoeck <jelmer@siphoc.com>
 * @copyright   2013 Siphoc
 * @link        http://siphoc.com
 */

namespace Siphoc\PdfBundle\Generator;

use Knp\Snappy\GeneratorInterface;
use Siphoc\PdfBundle\Converter\ConverterInterface;

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
     * The CssToHTML Converter.
     *
     * @var CssToInline
     */
    protected $cssToHTML;

    /**
     * The JSToHTML Converter.
     *
     * @var JSToHTML
     */
    protected $jsToHTML;

    /**
     * Initiate the PDF Generator.
     *
     * @param ConverterInterface $cssToHTML
     * @param ConverterInterface $jsToHTML
     * @param GeneratorInterface $generator
     */
    public function __construct(ConverterInterface $cssToHTML,
        ConverterInterface $jsToHTML, GeneratorInterface $generator)
    {
        $this->cssToHTML = $cssToHTML;
        $this->jsToHTML = $jsToHTML;
        $this->generator = $generator;
    }

    /**
     * Get the CssToHTML Converter.
     *
     * @return CssToHTML
     */
    public function getCssToHTMLConverter()
    {
        return $this->cssToHTML;
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
        $html = $this->getCssToHTMLConverter()->convertToString($html);
        $html = $this->getJSToHTMLConverter()->convertToString($html);

        return $this->getGenerator()->getOutputFromHtml($html, $options);
    }
}
