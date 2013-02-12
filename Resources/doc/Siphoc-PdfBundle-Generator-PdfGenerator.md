Siphoc\PdfBundle\Generator\PdfGenerator
===============

The actual PDF Generator that&#039;ll transform a view into a proper PDF.




* Class name: PdfGenerator
* Namespace: Siphoc\PdfBundle\Generator





Properties
----------


### $filename

```
protected string $filename = 'siphoc_pdfbundle.pdf'
```

The default filename we'll use for the downloadable file.



* Visibility: **protected**


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


### $templateEngine

```
protected \Symfony\Component\Templating\EngineInterface $templateEngine
```

The template engine we'll use to process our views.



* Visibility: **protected**


Methods
-------


### __construct

```
mixed Siphoc\PdfBundle\Generator\PdfGenerator::__construct(\Siphoc\PdfBundle\Converter\ConverterInterface $cssToHTML, \Siphoc\PdfBundle\Converter\ConverterInterface $jsToHTML, \Knp\Snappy\GeneratorInterface $generator, \Symfony\Component\Templating\EngineInterface $templateEngine)
```

Initiate the PDF Generator.



* Visibility: **public**

#### Arguments

* $cssToHTML **[Siphoc\PdfBundle\Converter\ConverterInterface](Siphoc-PdfBundle-Converter-ConverterInterface)**
* $jsToHTML **[Siphoc\PdfBundle\Converter\ConverterInterface](Siphoc-PdfBundle-Converter-ConverterInterface)**
* $generator **Knp\Snappy\GeneratorInterface**
* $templateEngine **Symfony\Component\Templating\EngineInterface**



### getCssToHTMLConverter

```
\Siphoc\PdfBundle\Generator\CssToHTML Siphoc\PdfBundle\Generator\PdfGenerator::getCssToHTMLConverter()
```

Get the CssToHTML Converter.



* Visibility: **public**



### getGenerator

```
\Knp\Snappy\GeneratorInterface Siphoc\PdfBundle\Generator\PdfGenerator::getGenerator()
```

Retrieve the generator we're using to convert our data to HTML.



* Visibility: **public**



### getTemplatingEngine

```
\Symfony\Component\Templating\EngineInterface Siphoc\PdfBundle\Generator\PdfGenerator::getTemplatingEngine()
```

Retrieve the templating engine.



* Visibility: **public**



### getJSToHTMLConverter

```
\Siphoc\PdfBundle\Generator\JSToHTML Siphoc\PdfBundle\Generator\PdfGenerator::getJSToHTMLConverter()
```

Get the JSToHTML Converter.



* Visibility: **public**



### getName

```
string Siphoc\PdfBundle\Generator\PdfGenerator::getName()
```

Retrieve the name for this PDF file.



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



### getOutputFromView

```
string Siphoc\PdfBundle\Generator\PdfGenerator::getOutputFromView(string $view, array $parameters, array $options)
```

Retrieve the output from a Symfony view.

<p>This uses the selected
template engine and renders it trough that.</p>

* Visibility: **public**

#### Arguments

* $view **string**
* $parameters **array**
* $options **array**



### downloadFromView

```
\Symfony\Component\HttpFoundation\Response Siphoc\PdfBundle\Generator\PdfGenerator::downloadFromView(string $view, array $parameters, array $options)
```

From a given view and parameters, create the proper response so we can
easily download the file.



* Visibility: **public**

#### Arguments

* $view **string**
* $parameters **array**
* $options **array** - Additional options for WKHTMLToPDF.



### setName

```
\Siphoc\PdfBundle\Generator\PdfGenerator Siphoc\PdfBundle\Generator\PdfGenerator::setName(string $name)
```

Set the name we'll use for the PDF file.



* Visibility: **public**

#### Arguments

* $name **string**


