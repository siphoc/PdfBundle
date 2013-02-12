Siphoc\PdfBundle\Converter\CssConverter
===============

Abstract class that represents all the CSS Converters.

<p>Here we'll do some
basic functionality like our regexes.</p>


* Class name: CssConverter
* Namespace: Siphoc\PdfBundle\Converter
* This is an **abstract** class
* This class implements: [Siphoc\PdfBundle\Converter\ConverterInterface](Siphoc-PdfBundle-Converter-ConverterInterface.md)






Methods
-------


### extractExternalStylesheets

```
array Siphoc\PdfBundle\Converter\CssConverter::extractExternalStylesheets(string $html)
```

Extract the external stylesheets from the specified HTML if the option is
enabled.

<p>If the stylesheet is not in the form of a url, prepend our
basePath.</p>

* Visibility: **public**

#### Arguments

* $html **string**



### getExternalStylesheetRegex

```
string Siphoc\PdfBundle\Converter\CssConverter::getExternalStylesheetRegex()
```

The regex that we'll use to extract external stylesheets.



* Visibility: **protected**



### isExternalStylesheet

```
boolean Siphoc\PdfBundle\Converter\CssConverter::isExternalStylesheet(string $url)
```

Check if the given string is a string for a local stylesheet or an
external stylesheet.



* Visibility: **protected**

#### Arguments

* $url **string**



### convertToString

```
string Siphoc\PdfBundle\Converter\ConverterInterface::convertToString(string $html)
```

Convert a specified HTML string with proper implementation logic.



* Visibility: **public**
* This method is defined by [Siphoc\PdfBundle\Converter\ConverterInterface](Siphoc-PdfBundle-Converter-ConverterInterface.md)

#### Arguments

* $html **string**


