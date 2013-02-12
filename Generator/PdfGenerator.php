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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

/**
 * The actual PDF Generator that'll transform a view into a proper PDF.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class PdfGenerator
{
    /**
     * The default filename we'll use for the downloadable file.
     *
     * @var string
     */
    protected $filename = 'siphoc_pdfbundle.pdf';

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
     * The template engine we'll use to process our views.
     *
     * @var EngineInterface
     */
    protected $templateEngine;

    /**
     * Initiate the PDF Generator.
     *
     * @param ConverterInterface $cssToHTML
     * @param ConverterInterface $jsToHTML
     * @param GeneratorInterface $generator
     */
    public function __construct(ConverterInterface $cssToHTML,
        ConverterInterface $jsToHTML, GeneratorInterface $generator,
        EngineInterface $templateEngine)
    {
        $this->cssToHTML = $cssToHTML;
        $this->jsToHTML = $jsToHTML;
        $this->generator = $generator;
        $this->templateEngine = $templateEngine;
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
     * Retrieve the generator we're using to convert our data to HTML.
     *
     * @return GeneratorInterface
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * Retrieve the templating engine.
     *
     * @return EngineInterface
     */
    public function getTemplatingEngine()
    {
        return $this->templateEngine;
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
     * Retrieve the name for this PDF file.
     *
     * @return string
     */
    public function getName()
    {
        return $this->filename;
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

    /**
     * Retrieve the output from a Symfony view. This uses the selected
     * template engine and renders it trough that.
     *
     * @param string $view
     * @param array $parameters
     * @return string
     */
    public function getOutputFromView($view, array $parameters = array(),
        array $options = array())
    {
        $html = $this->getTemplatingEngine()->render($view, $parameters);

        return $this->getGenerator()->getOutputFromHtml($html, $options);
    }

    /**
     * From a given view and parameters, create the proper response so we can
     * easily download the file.
     *
     * @param string $view
     * @param array $parameters
     * @param array $options    Additional options for WKHTMLToPDF.
     * @return Response
     */
    public function downloadFromView($view, array $parameters = array(),
        array $options = array())
    {
        $contentDisposition = 'attachment; filename="' . $this->getName() . '"';

        return new Response(
            $this->getOutputFromView($view, $parameters, $options),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => $contentDisposition,
            )
        );
    }

    /**
     * Set the name we'll use for the PDF file.
     *
     * @param string $name
     * @return PdfGenerator
     */
    public function setName($name)
    {
        $this->filename = (string) $name;

        return $this;
    }
}
