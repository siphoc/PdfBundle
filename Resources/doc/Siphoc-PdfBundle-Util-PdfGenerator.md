Siphoc\PdfBundle\Util\PdfGenerator
===============

The actual PDF Generator that&#039;ll transform a view into a proper PDF.




* Class name: PdfGenerator
* Namespace: Siphoc\PdfBundle\Util





Properties
----------


### $cssToInline

```
protected \Siphoc\PdfBundle\Util\CssToInline $cssToInline
```

The CssToInline Converter.



* Visibility: **protected**


### $jsToHTML

```
protected \Siphoc\PdfBundle\Util\JSToHTML $jsToHTML
```

The JSToHTML Converter.



* Visibility: **protected**


Methods
-------


### __construct

```
mixed Siphoc\PdfBundle\Util\PdfGenerator::__construct(\Siphoc\PdfBundle\Util\CssToInline $cssToInline, \Siphoc\PdfBundle\Util\JSToHTML $jsToHTML, \Knp\Snappy\GeneratorInterface $generator)
```

Initiate the PDF Generator.



* Visibility: **public**

#### Arguments

* $cssToInline **[Siphoc\PdfBundle\Util\CssToInline](Siphoc-PdfBundle-Util-CssToInline.md)**
* $jsToHTML **[Siphoc\PdfBundle\Util\JSToHTML](Siphoc-PdfBundle-Util-JSToHTML.md)**
* $generator **Knp\Snappy\GeneratorInterface**



### getCssToInlineConverter

```
\Siphoc\PdfBundle\Util\CssToInline Siphoc\PdfBundle\Util\PdfGenerator::getCssToInlineConverter()
```

Get the CssToInline Converter.



* Visibility: **public**



### getJSToHTMLConverter

```
\Siphoc\PdfBundle\Util\JSToHTML Siphoc\PdfBundle\Util\PdfGenerator::getJSToHTMLConverter()
```

Get the JSToHTML Converter.



* Visibility: **public**



### getGenerator

```
\Knp\Snappy\GeneratorInterface Siphoc\PdfBundle\Util\PdfGenerator::getGenerator()
```

Retrieve the generator we're using to convert our data to HTML.



* Visibility: **public**



### getOutputFromHtml

```
string Siphoc\PdfBundle\Util\PdfGenerator::getOutputFromHtml(string $html, array $options)
```

Generate the PDF from a given HTML string.

<p>Replace all the CSS and JS
tags with inline blocks/code.</p>

* Visibility: **public**

#### Arguments

* $html **string**
* $options **array**


