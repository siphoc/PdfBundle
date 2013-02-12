<?php
/**
 * Siphoc
 *
 * @author      Jelmer Snoeck <jelmer@siphoc.com>
 * @copyright   2013 Siphoc
 * @link        http://siphoc.com
 */

namespace Siphoc\PdfBundle\Util;

use Buzz\Client\ClientInterface;
use Buzz\Message\MessageInterface;
use Siphoc\PdfBundle\Util\RequestHandlerInterface;

/**
 * The handler that we'll use to get external files from other servers.
 *
 * @author Jelmer Snoeck <jelmer@siphoc.com>
 */
class BuzzRequestHandler implements RequestHandlerInterface
{
    /**
     * The request object we'll be using to do HTTP calls.
     *
     * @var MessageInterface
     */
    protected $request;

    /**
     * The response object we'll be using to store our response data in.
     *
     * @var MessageInterface
     */
    protected $response;

    /**
     * The client object we'll be using to do our actuall calls.
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * Initiate the Request handler with a Request, Response and Client
     * interface.
     *
     * @param MessageInterface $request
     * @param MessageInterface $response
     * @param ClientInterface  $client
     */
    public function __construct(MessageInterface $request,
        MessageInterface $response, ClientInterface $client)
    {
        $this->request = $request;
        $this->response = $response;
        $this->client = $client;
    }

    /**
     * Fetch the Client object we're using to do requests.
     *
     * @return MessageInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Retrieve the contents from a given url.
     *
     * @param  string $url
     * @return string
     */
    public function getContent($url)
    {
        $this->getRequest()->setHost($url);
        $this->getClient()->send(
            $this->getRequest(),
            $this->getResponse()
        );

        return $this->getResponse()->getContent();
    }

    /**
     * Fetch the Response object we're using to do requests.
     *
     * @return MessageInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Fetch the Request object we're using to do requests.
     *
     * @return MessageInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}
