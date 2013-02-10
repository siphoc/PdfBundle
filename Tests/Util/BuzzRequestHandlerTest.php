<?php

namespace Siphoc\PdfBundle\Tests\Util;

use Siphoc\PdfBundle\Util\BuzzRequestHandler;

class RequestHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor_stores_mandatory_data()
    {
        $request = $this->getRequestMock();
        $response = $this->getResponseMock();
        $client = $this->getClientMock();

        $handler = new BuzzRequestHandler($request, $response, $client);
        $this->assertSame($request, $handler->getRequest());
        $this->assertSame($response, $handler->getResponse());
        $this->assertSame($client, $handler->getClient());
    }

    public function test_it_returns_url_content()
    {
        $handler = $this->getRequestHandler();
        $content = $handler->getContent(
            'http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'
        );

        $this->assertEquals('get content', $content);
    }

    private function getRequestMock()
    {
        $request =  $this->getMock(
            'Buzz\Message\Request'
        );

        return $request;
    }

    private function getResponseMock()
    {
        $response =  $this->getMock(
            'Buzz\Message\Response'
        );

        $response->expects($this->any())
            ->method('getContent')
            ->will($this->returnValue('get content'));

        return $response;
    }

    private function getClientMock()
    {
        $client =  $this->getMock(
            '\Buzz\Client\FileGetContents',
            array('send')
        );

        return $client;
    }

    private function getRequestHandler()
    {
        $handler = new BuzzRequestHandler(
            $this->getRequestMock(),
            $this->getResponseMock(),
            $this->getClientMock()
        );

        return $handler;
    }
}
