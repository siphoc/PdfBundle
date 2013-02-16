Siphoc\PdfBundle\Converter\CssPathToUrl
===============

Convert the relative CSS links to full url paths for all our CSS files in
an HTML file.




* Class name: CssPathToUrl
* Namespace: Siphoc\PdfBundle\Converter
* Parent class: [Siphoc\PdfBundle\Converter\CssConverter](Siphoc-PdfBundle-Converter-CssConverter.md)





Properties
----------


### $url

```
protected string $url
```

The url we'll use to point to our CSS files.



* Visibility: **protected**


Methods
-------


### convertToString

```
\Siphoc\PdfBundle\Converter\$html Siphoc\PdfBundle\Converter\CssPathToUrl::convertToString(string $html)
```

Convert the link tags in the specified string so that the relative
paths are replaces with a proper url implementation.



* Visibility: **public**

#### Arguments

* $html **string**



### replaceCssPaths

```
array Siphoc\PdfBundle\Converter\CssPathToUrl::replaceCssPaths(array $links)
```

Replace a given set of links with the proper url if it is an external
css file.



* Visibility: **public**

#### Arguments

* $links **array**



### replaceExternalCss

```
string Siphoc\PdfBundle\Converter\CssPathToUrl::replaceExternalCss(string $html, array $stylesheets)
```

From a set of external stylesheets, retrieve the data and replace the
matching CSS tag with the contents.



* Visibility: **public**

#### Arguments

* $html **string**
* $stylesheets **array**



### setUrl

```
\Siphoc\PdfBundle\Converter\CssPathToUrl Siphoc\PdfBundle\Converter\CssPathToUrl::setUrl(string $url)
```

Set the URL we'll use to point our CSS files to.



* Visibility: **public**

#### Arguments

* $url **string**



### getUrl

```
string Siphoc\PdfBundle\Converter\CssPathToUrl::getUrl()
```

Retrieve the URL we're using to point our CSS files to.



* Visibility: **public**



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


