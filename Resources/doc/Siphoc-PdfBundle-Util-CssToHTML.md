Siphoc\PdfBundle\Util\CssToHTML
===============

Convert a view to a proper inline CSS html page.




* Class name: CssToHTML
* Namespace: Siphoc\PdfBundle\Util





Properties
----------


### $basePath

```
protected string $basePath
```

The basepath for our css files.

<p>This is basically the /web folder.</p>

* Visibility: **protected**


### $requestHandler

```
protected \Siphoc\PdfBundle\Util\RequestHandlerInterface $requestHandler
```

The request handler we'll be using to call external domains.



* Visibility: **protected**


Methods
-------


### __construct

```
mixed Siphoc\PdfBundle\Util\CssToHTML::__construct(\Siphoc\PdfBundle\Util\RequestHandlerInterface $requestHandler)
```

Initiate the CssToHTML converter for Symfony2.



* Visibility: **public**

#### Arguments

* $requestHandler **[Siphoc\PdfBundle\Util\RequestHandlerInterface](Siphoc-PdfBundle-Util-RequestHandlerInterface.md)**



### convertToString

```
string Siphoc\PdfBundle\Util\CssToHTML::convertToString(string $html)
```

Convert a specified HTML string with CSS data to a HTML string with
inline CSS data in proper <style> blocks.



* Visibility: **public**

#### Arguments

* $html **string**



### extractExternalStylesheets

```
array Siphoc\PdfBundle\Util\CssToHTML::extractExternalStylesheets(string $html)
```

Extract the external stylesheets from the specified HTML if the option is
enabled.

<p>If the stylesheet is not in the form of a url, prepend our
basePath.</p>

* Visibility: **public**

#### Arguments

* $html **string**



### createStylesheetPaths

```
array Siphoc\PdfBundle\Util\CssToHTML::createStylesheetPaths(array $stylesheets)
```

Check if a stylesheet is a local stylesheet or an external stylesheet.

<p>If
it is a local stylesheet, prepend our basepath to the link so we can
properly fetch the data to insert.</p>

* Visibility: **private**

#### Arguments

* $stylesheets **array**



### getBasePath

```
string Siphoc\PdfBundle\Util\CssToHTML::getBasePath()
```

Retrieve the BasePath used for this inline action.



* Visibility: **public**



### getStylesheetContent

```
string Siphoc\PdfBundle\Util\CssToHTML::getStylesheetContent(string $path)
```

Retrieve the contents from a CSS file.



* Visibility: **private**

#### Arguments

* $path **string**



### replaceExternalCss

```
string Siphoc\PdfBundle\Util\CssToHTML::replaceExternalCss(string $html, array $stylesheets)
```

From a set of external stylesheets, retrieve the data and replace the
matching CSS tag with the contents.



* Visibility: **public**

#### Arguments

* $html **string**
* $stylesheets **array**



### getRequestHandler

```
\Siphoc\PdfBundle\Util\RequestHandlerInterface Siphoc\PdfBundle\Util\CssToHTML::getRequestHandler()
```

Retrieve the request handler.



* Visibility: **public**



### isExternalStylesheet

```
boolean Siphoc\PdfBundle\Util\CssToHTML::isExternalStylesheet(string $url)
```

Check if the given string is a string for a local stylesheet or an
external stylesheet.



* Visibility: **private**

#### Arguments

* $url **string**



### setBasePath

```
\Siphoc\PdfBundle\Util\CssToHTML Siphoc\PdfBundle\Util\CssToHTML::setBasePath(string $basePath)
```

Set the base path we'll use to fetch our css files from.



* Visibility: **public**

#### Arguments

* $basePath **string** - The base path where our css files are.



### getExternalStylesheetRegex

```
string Siphoc\PdfBundle\Util\CssToHTML::getExternalStylesheetRegex()
```

The regex that we'll use to extract external stylesheets.



* Visibility: **private**


