Siphoc\PdfBundle\Converter\CssToHTML
===============

Convert a view to a proper inline CSS html page.




* Class name: CssToHTML
* Namespace: Siphoc\PdfBundle\Converter
* Parent class: [Siphoc\PdfBundle\Converter\CssConverter](Siphoc-PdfBundle-Converter-CssConverter.md)





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
mixed Siphoc\PdfBundle\Converter\CssToHTML::__construct(\Siphoc\PdfBundle\Util\RequestHandlerInterface $requestHandler)
```

Initiate the CssToHTML converter for Symfony2.



* Visibility: **public**

#### Arguments

* $requestHandler **[Siphoc\PdfBundle\Util\RequestHandlerInterface](Siphoc-PdfBundle-Util-RequestHandlerInterface.md)**



### convertToString

```
string Siphoc\PdfBundle\Converter\CssToHTML::convertToString(string $html)
```

Convert a specified HTML string with CSS data to a HTML string with
inline CSS data in proper <style> blocks.



* Visibility: **public**

#### Arguments

* $html **string**



### createStylesheetPaths

```
array Siphoc\PdfBundle\Converter\CssToHTML::createStylesheetPaths(array $stylesheets)
```

Check if a stylesheet is a local stylesheet or an external stylesheet.

<p>If
it is a local stylesheet, prepend our basepath to the link so we can
properly fetch the data to insert.</p>

* Visibility: **public**

#### Arguments

* $stylesheets **array**



### getBasePath

```
string Siphoc\PdfBundle\Converter\CssToHTML::getBasePath()
```

Retrieve the BasePath used for this inline action.



* Visibility: **public**



### getStylesheetContent

```
string Siphoc\PdfBundle\Converter\CssToHTML::getStylesheetContent(string $path)
```

Retrieve the contents from a CSS file.



* Visibility: **private**

#### Arguments

* $path **string**



### replaceLocalUrlTags

```
string Siphoc\PdfBundle\Converter\CssToHTML::replaceLocalUrlTags(string $css)
```

From a given CSS string, replace all the local url tags.

<p>This means
replacing all the url(x) tags.</p>

* Visibility: **private**

#### Arguments

* $css **string**



### replaceExternalCss

```
string Siphoc\PdfBundle\Converter\CssToHTML::replaceExternalCss(string $html, array $stylesheets)
```

From a set of external stylesheets, retrieve the data and replace the
matching CSS tag with the contents.



* Visibility: **public**

#### Arguments

* $html **string**
* $stylesheets **array**



### getRequestHandler

```
\Siphoc\PdfBundle\Util\RequestHandlerInterface Siphoc\PdfBundle\Converter\CssToHTML::getRequestHandler()
```

Retrieve the request handler.



* Visibility: **public**



### setBasePath

```
\Siphoc\PdfBundle\Converter\CssToHTML Siphoc\PdfBundle\Converter\CssToHTML::setBasePath(string $basePath)
```

Set the base path we'll use to fetch our css files from.



* Visibility: **public**

#### Arguments

* $basePath **string** - The base path where our css files are.



### extractExternalStylesheets

```
array Siphoc\PdfBundle\Converter\CssConverter::extractExternalStylesheets(string $html)
```

Extract the external stylesheets from the specified HTML if the option is
enabled.

<p>If the stylesheet is not in the form of a url, prepend our
basePath.</p>

* Visibility: **public**
* This method is defined by [Siphoc\PdfBundle\Converter\CssConverter](Siphoc-PdfBundle-Converter-CssConverter.md)

#### Arguments

* $html **string**



### getExternalStylesheetRegex

```
string Siphoc\PdfBundle\Converter\CssConverter::getExternalStylesheetRegex()
```

The regex that we'll use to extract external stylesheets.



* Visibility: **protected**
* This method is defined by [Siphoc\PdfBundle\Converter\CssConverter](Siphoc-PdfBundle-Converter-CssConverter.md)



### isExternalStylesheet

```
boolean Siphoc\PdfBundle\Converter\CssConverter::isExternalStylesheet(string $url)
```

Check if the given string is a string for a local stylesheet or an
external stylesheet.



* Visibility: **protected**
* This method is defined by [Siphoc\PdfBundle\Converter\CssConverter](Siphoc-PdfBundle-Converter-CssConverter.md)

#### Arguments

* $url **string**


