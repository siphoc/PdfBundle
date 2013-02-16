Siphoc\PdfBundle\Generator\PdfGenerator
===============

The actual PDF Generator that&#039;ll transform a view into a proper PDF.




* Class name: PdfGenerator
* Namespace: Siphoc\PdfBundle\Generator
* This class implements: Knp\Snappy\GeneratorInterface




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


### $logger

```
protected \Symfony\Component\HttpKernel\Log\LoggerInterface $logger
```

The logging instance used to log our messages to.



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
mixed Siphoc\PdfBundle\Generator\PdfGenerator::__construct(\Siphoc\PdfBundle\Converter\ConverterInterface $cssToHTML, \Siphoc\PdfBundle\Converter\ConverterInterface $jsToHTML, \Knp\Snappy\GeneratorInterface $generator, \Symfony\Component\Templating\EngineInterface $templateEngine, \Symfony\Component\HttpKernel\Log\LoggerInterface $logger)
```

Initiate the PDF Generator.



* Visibility: **public**

#### Arguments

* $cssToHTML **[Siphoc\PdfBundle\Converter\ConverterInterface](Siphoc-PdfBundle-Converter-ConverterInterface.md)**
* $jsToHTML **[Siphoc\PdfBundle\Converter\ConverterInterface](Siphoc-PdfBundle-Converter-ConverterInterface.md)**
* $generator **Knp\Snappy\GeneratorInterface**
* $templateEngine **Symfony\Component\Templating\EngineInterface**
* $logger **Symfony\Component\HttpKernel\Log\LoggerInterface**



### getCssConverter

```
\Siphoc\PdfBundle\Generator\CssToHTML Siphoc\PdfBundle\Generator\PdfGenerator::getCssConverter()
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



### getJSConverter

```
\Siphoc\PdfBundle\Generator\JSToHTML Siphoc\PdfBundle\Generator\PdfGenerator::getJSConverter()
```

Get the JSToHTML Converter.



* Visibility: **public**



### getLogger

```
\Symfony\Component\HttpKernel\Log\LoggerInterface Siphoc\PdfBundle\Generator\PdfGenerator::getLogger()
```

Retrieve the logging instance.



* Visibility: **public**



### getName

```
string Siphoc\PdfBundle\Generator\PdfGenerator::getName()
```

Retrieve the name for this PDF file.



* Visibility: **public**



### generate

```
mixed Siphoc\PdfBundle\Generator\PdfGenerator::generate(string $input, string $output, array $options, bool $overwrite)
```

Generates the output media file from the specified input HTML file



* Visibility: **public**

#### Arguments

* $input **string** - The input HTML filename or URL
* $output **string** - The output media filename
* $options **array** - An array of options for this generation only
* $overwrite **bool** - Overwrite the file if it exists. If not, throw an InvalidArgumentException



### generateFromHtml

```
mixed Siphoc\PdfBundle\Generator\PdfGenerator::generateFromHtml(string $html, string $output, array $options, bool $overwrite)
```

Generates the output media file from the given HTML



* Visibility: **public**

#### Arguments

* $html **string** - The HTML to be converted
* $output **string** - The output media filename
* $options **array** - An array of options for this generation only
* $overwrite **bool** - Overwrite the file if it exists. If not, throw an InvalidArgumentException



### getOutput

```
string Siphoc\PdfBundle\Generator\PdfGenerator::getOutput(string $input, array $options)
```

Returns the output of the media generated from the specified input HTML
file



* Visibility: **public**

#### Arguments

* $input **string** - The input HTML filename or URL
* $options **array** - An array of options for this output only



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



### log

```
mixed Siphoc\PdfBundle\Generator\PdfGenerator::log(string $message)
```

Log a message to the logging system.



* Visibility: **public**

#### Arguments

* $message **string**


