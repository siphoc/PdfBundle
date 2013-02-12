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
 * The interface for our converters. This provides some basic structure for each
 * converter.
 *
 * @author Jelmer Snoeck <jelmer@darwnanalytics.com>
 */
interface ConverterInterface
{
    /**
     * Convert a specified HTML string with proper implementation logic.
     *
     * @param  string $html
     * @return string
     */
    public function convertToString($html);
}
