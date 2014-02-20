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
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * The actual PDF Generator that'll transform a view into a proper PDF.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class PdfGenerator implements GeneratorInterface
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
     * The logging instance used to log our messages to.
     *
     * @var LoggerInterface
     */
    protected $logger;

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
     * @param EngineInterface    $templateEngine
     * @param LoggerInterface $logger
     */
    public function __construct(ConverterInterface $cssToHTML,
        ConverterInterface $jsToHTML, GeneratorInterface $generator,
        EngineInterface $templateEngine, LoggerInterface $logger = null)
    {
        $this->cssToHTML = $cssToHTML;
        $this->jsToHTML = $jsToHTML;
        $this->generator = $generator;
        $this->templateEngine = $templateEngine;
        $this->logger = $logger;
    }

    /**
     * Get the CssToHTML Converter.
     *
     * @return CssToHTML
     */
    public function getCssConverter()
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
    public function getJSConverter()
    {
        return $this->jsToHTML;
    }

    /**
     * Retrieve the logging instance.
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
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
     * Generates the output media file from the specified input HTML file
     *
     * @param  string $input   The input HTML filename or URL
     * @param  string $output  The output media filename
     * @param  array  $options An array of options for this generation only
     * @param  bool   $overwrite Overwrite the file if it exists. If not, throw an InvalidArgumentException
     */
    public function generate($input, $output, array $options = array(),
        $overwrite = false)
    {
        $this->log(sprintf(
            'Generate from file (%s) to file (%s)',
            $input, $output
        ));

        return $this->getGenerator()->generate(
            $input, $output, $options, $overwrite
        );
    }

    /**
     * Generates the output media file from the given HTML
     *
     * @param  string $html    The HTML to be converted
     * @param  string $output  The output media filename
     * @param  array  $options An array of options for this generation only
     * @param  bool   $overwrite Overwrite the file if it exists. If not, throw an InvalidArgumentException
     */
    public function generateFromHtml($html, $output, array $options = array(),
        $overwrite = false)
    {
        $this->log(sprintf('Generate output in file (%s) from html.', $output));

        return $this->getGenerator()->generateFromHtml(
            $html, $output, $options, $overwrite
        );
    }

    /**
     * Returns the output of the media generated from the specified input HTML
     * file
     *
     * @param  string $input   The input HTML filename or URL
     * @param  array  $options An array of options for this output only
     *
     * @return string
     */
    public function getOutput($input, array $options = array())
    {
        $this->log(sprintf('Getting output from file (%s)', $input));

        return $this->getGenerator()->getOutput($input, $options);
    }

    /**
     * Generate the PDF from a given HTML string. Replace all the CSS and JS
     * tags with inline blocks/code.
     *
     * @param  string $html
     * @param  array  $options
     * @return string
     */
    public function getOutputFromHtml($html, array $options = array())
    {
        $this->log('Get output from html.');

        $html = $this->getCssConverter()->convertToString($html);
        $html = $this->getJSConverter()->convertToString($html);

        return $this->getGenerator()->getOutputFromHtml($html, $options);
    }

    /**
     * Retrieve the output from a Symfony view. This uses the selected
     * template engine and renders it trough that.
     *
     * @param  string $view
     * @param  array  $parameters
     * @param  array  $options
     * @return string
     */
    public function getOutputFromView($view, array $parameters = array(),
        array $options = array())
    {
        $this->log(sprintf('Get converted output from view (%s).', $view));

        $html = $this->getTemplatingEngine()->render($view, $parameters);

        return $this->getOutputFromHtml($html, $options);
    }

    /**
     * From a given view and parameters, create the proper response so we can
     * easily download the file.
     *
     * @param  string   $view
     * @param  array    $parameters
     * @param  array    $options    Additional options for WKHTMLToPDF.
     * @return Response
     */
    public function downloadFromView($view, array $parameters = array(),
        array $options = array())
    {
        $this->log(sprintf('Download pdf from view (%s).', $view));

        $contentDisposition = 'attachment; filename="' . $this->getName() . '"';
        return $this->generateResponse($view, $contentDisposition, $parameters,
            $options);
    }

    /**
     * From a given view and parameters, create the proper response so we can
     * easily display the file inline.
     *
     * @param  string   $view
     * @param  array    $parameters
     * @param  array    $options    Additional options for WKHTMLToPDF.
     * @return Response
     */
    public function displayForView($view, array $parameters = array(),
        array $options = array())
    {
        $this->log(sprintf('Display pdf for view (%s).', $view));

        $contentDisposition = 'inline; filename="' . $this->getName() . '"';
        return $this->generateResponse($view, $contentDisposition, $parameters,
            $options);
    }

    /**
     * Set the name we'll use for the PDF file.
     *
     * @param  string       $name
     * @return PdfGenerator
     */
    public function setName($name)
    {
        $this->filename = (string) $name;

        return $this;
    }

    /**
     * Log a message to the logging system.
     *
     * @param string $message
     */
    public function log($message)
    {
        if (null === $this->getLogger()) {
            return;
        }

        $this->getLogger()->debug($message);
    }

    /**
     * Create a Response object for the inputted data.
     *
     * @param  string   $view
     * @param  string   $contentDisposition
     * @param  array    $parameters
     * @param  array    $options    Additional options for WKHTMLToPDF.
     */
    private function generateResponse($view, $contentDisposition, $parameters,
        $options)
    {
        return new Response(
            $this->getOutputFromView($view, $parameters, $options),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => $contentDisposition,
            )
        );
    }
}
