Siphoc\PdfBundle\Util\BuzzRequestHandler
===============

The handler that we&#039;ll use to get external files from other servers.




* Class name: BuzzRequestHandler
* Namespace: Siphoc\PdfBundle\Util
* This class implements: [Siphoc\PdfBundle\Util\RequestHandlerInterface](Siphoc-PdfBundle-Util-RequestHandlerInterface.md)




Properties
----------


### $request

```
protected \Buzz\Message\MessageInterface $request
```

The request object we'll be using to do HTTP calls.



* Visibility: **protected**


### $response

```
protected \Buzz\Message\MessageInterface $response
```

The response object we'll be using to store our response data in.



* Visibility: **protected**


### $client

```
protected \Buzz\Client\ClientInterface $client
```

The client object we'll be using to do our actuall calls.



* Visibility: **protected**


Methods
-------


### __construct

```
mixed Siphoc\PdfBundle\Util\BuzzRequestHandler::__construct(\Buzz\Message\MessageInterface $request, \Buzz\Message\MessageInterface $response, \Buzz\Client\ClientInterface $client)
```

Initiate the Request handler with a Request, Response and Client
interface.



* Visibility: **public**

#### Arguments

* $request **Buzz\Message\MessageInterface**
* $response **Buzz\Message\MessageInterface**
* $client **Buzz\Client\ClientInterface**



### getClient

```
\Buzz\Message\MessageInterface Siphoc\PdfBundle\Util\BuzzRequestHandler::getClient()
```

Fetch the Client object we're using to do requests.



* Visibility: **public**



### getContent

```
string Siphoc\PdfBundle\Util\BuzzRequestHandler::getContent(string $url)
```

Retrieve the contents from a given url.



* Visibility: **public**

#### Arguments

* $url **string**



### getResponse

```
\Buzz\Message\MessageInterface Siphoc\PdfBundle\Util\BuzzRequestHandler::getResponse()
```

Fetch the Response object we're using to do requests.



* Visibility: **public**



### getRequest

```
\Buzz\Message\MessageInterface Siphoc\PdfBundle\Util\BuzzRequestHandler::getRequest()
```

Fetch the Request object we're using to do requests.



* Visibility: **public**


