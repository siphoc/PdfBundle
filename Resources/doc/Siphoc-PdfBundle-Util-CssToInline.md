Siphoc\PdfBundle\Util\CssToInline
===============

Convert a view to a proper inline CSS html page.




* Class name: CssToInline
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


### $converter

```
protected \TijsVerkoyen\CssToInlineStyles\CssToInlineStyles $converter
```

The converter used for the inline replacement.



* Visibility: **protected**


### $externalStylesheets

```
protected boolean $externalStylesheets = false
```

Follow external stylesheet files or not?



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
mixed Siphoc\PdfBundle\Util\CssToInline::__construct(\TijsVerkoyen\CssToInlineStyles\CssToInlineStyles $converter, \Siphoc\PdfBundle\Util\RequestHandlerInterface $requestHandler)
```

Initiate the CssToInline converter for Symfony2.



* Visibility: **public**

#### Arguments

* $converter **TijsVerkoyen\CssToInlineStyles\CssToInlineStyles**
* $requestHandler **[Siphoc\PdfBundle\Util\RequestHandlerInterface](Siphoc-PdfBundle-Util-RequestHandlerInterface)**



### convertToString

```
string Siphoc\PdfBundle\Util\CssToInline::convertToString(string $html)
```

Convert a specified HTML string with CSS data to a HTML string with
inline CSS data.



* Visibility: **public**

#### Arguments

* $html **string**



### disableExternalStylesheets

```
\Siphoc\PdfBundle\Util\CssToInline Siphoc\PdfBundle\Util\CssToInline::disableExternalStylesheets()
```

Disable the usage of the <link stylesheets> tag in our HTML.



* Visibility: **public**



### enableExternalStylesheets

```
\Siphoc\PdfBundle\Util\CssToInline Siphoc\PdfBundle\Util\CssToInline::enableExternalStylesheets()
```

Enable the usage of the <link stylesheets> tag in our HTML.



* Visibility: **public**



### extractExternalStylesheets

```
array Siphoc\PdfBundle\Util\CssToInline::extractExternalStylesheets(string $html)
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
array Siphoc\PdfBundle\Util\CssToInline::createStylesheetPaths(array $stylesheets)
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
string Siphoc\PdfBundle\Util\CssToInline::getBasePath()
```

Retrieve the BasePath used for this inline action.



* Visibility: **public**



### getConverter

```
\TijsVerkoyen\CssToInlineStyles\CssToInlineStyles Siphoc\PdfBundle\Util\CssToInline::getConverter()
```

Retrieve the previously set converter.



* Visibility: **public**



### getExternalCss

```
string Siphoc\PdfBundle\Util\CssToInline::getExternalCss(array $stylesheets)
```

From a set of external stylesheets, retrieve the data and concatenate it
to one proper stylesheet string.



* Visibility: **public**

#### Arguments

* $stylesheets **array**



### getRequestHandler

```
\Siphoc\PdfBundle\Util\RequestHandlerInterface Siphoc\PdfBundle\Util\CssToInline::getRequestHandler()
```

Retrieve the request handler.



* Visibility: **public**



### isExternalStylesheet

```
boolean Siphoc\PdfBundle\Util\CssToInline::isExternalStylesheet(string $url)
```

Check if the given string is a string for a local stylesheet or an
external stylesheet.



* Visibility: **private**

#### Arguments

* $url **string**



### setBasePath

```
\Siphoc\PdfBundle\Util\CssToInline Siphoc\PdfBundle\Util\CssToInline::setBasePath(string $basePath)
```

Set the base path we'll use to fetch our css files from.



* Visibility: **public**

#### Arguments

* $basePath **string** - The base path where our css files are.



### stripExternalStylesheetTags

```
string Siphoc\PdfBundle\Util\CssToInline::stripExternalStylesheetTags(string $html)
```

Strip the external stylesheet tags from a specified HTML string.



* Visibility: **public**

#### Arguments

* $html **string**



### useExternalStylesheets

```
boolean Siphoc\PdfBundle\Util\CssToInline::useExternalStylesheets()
```

Are we allowed to follow <link stylesheet> tags to include these
stylesheets in our page?



* Visibility: **public**



### setConvertionOptions

```
mixed Siphoc\PdfBundle\Util\CssToInline::setConvertionOptions(string $html)
```

Set allt he options wanted to convert our HTML page into an inline CSS
page.



* Visibility: **private**

#### Arguments

* $html **string**



### getExternalStylesheetRegex

```
string Siphoc\PdfBundle\Util\CssToInline::getExternalStylesheetRegex()
```

The regex that we'll use to extract external stylesheets.



* Visibility: **private**


