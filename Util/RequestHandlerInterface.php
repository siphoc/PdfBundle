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
 * Interface for a proper request handler. We'll integrate one call we'll use
 * trough our application.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
interface RequestHandlerInterface
{
    /**
     * Retrieve the contents from a given url.
     *
     * @param  string $url
     * @return string
     */
    public function getContent($url);
}
