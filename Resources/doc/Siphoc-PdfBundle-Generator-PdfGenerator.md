Siphoc\PdfBundle\Generator\PdfGenerator
===============

The actual PDF Generator that&#039;ll transform a view into a proper PDF.




* Class name: PdfGenerator
* Namespace: Siphoc\PdfBundle\Generator





Properties
----------


### $cssToHTML

```
protected \Siphoc\PdfBundle\Generator\CssToInline $cssToHTML
```

The CssToHTML Converter.



* Visibility: **protected**


### $jsToHTML

```
protected \Siphoc\PdfBundle\Generator\JSToHTML $jsToHTML
```

The JSToHTML Converter.



* Visibility: **protected**


Methods
-------


### __construct

```
mixed Siphoc\PdfBundle\Generator\PdfGenerator::__construct(\Siphoc\PdfBundle\Converter\ConverterInterface $cssToHTML, \Siphoc\PdfBundle\Converter\ConverterInterface $jsToHTML, \Knp\Snappy\GeneratorInterface $generator)
```

Initiate the PDF Generator.



* Visibility: **public**

#### Arguments

* $cssToHTML **[Siphoc\PdfBundle\Converter\ConverterInterface](Siphoc-PdfBundle-Converter-ConverterInterface.md)**
* $jsToHTML **[Siphoc\PdfBundle\Converter\ConverterInterface](Siphoc-PdfBundle-Converter-ConverterInterface.md)**
* $generator **Knp\Snappy\GeneratorInterface**



### getCssToHTMLConverter

```
\Siphoc\PdfBundle\Generator\CssToHTML Siphoc\PdfBundle\Generator\PdfGenerator::getCssToHTMLConverter()
```

Get the CssToHTML Converter.



* Visibility: **public**



### getJSToHTMLConverter

```
\Siphoc\PdfBundle\Generator\JSToHTML Siphoc\PdfBundle\Generator\PdfGenerator::getJSToHTMLConverter()
```

Get the JSToHTML Converter.



* Visibility: **public**



### getGenerator

```
\Knp\Snappy\GeneratorInterface Siphoc\PdfBundle\Generator\PdfGenerator::getGenerator()
```

Retrieve the generator we're using to convert our data to HTML.



* Visibility: **public**



### getOutputFromHtml

```
string Siphoc\PdfBundle\Generator\PdfGenerator::getOutputFromHtml(string $html, array $options)
```

Generate the PDF from a given HTML string.

<p>Replace all the CSS and JS
tags with inline blocks/code.</p>

* Visibility: **public**

#### Arguments

* $html **string**
* $options **array**


