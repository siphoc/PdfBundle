<?php

namespace Siphoc\PdfBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SiphocPdfExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('siphoc_pdf.basepath', $config['basepath']);
        $container->setParameter('siphoc_pdf.binary', $config['binary']);
        $container->setPArameter('siphoc_pdf.options', $config['options']);

        $jsConverter = 'siphoc.pdf.js_to_html';

        if ($config['inline']) {
            $cssConverter = 'siphoc.pdf.css_to_html';
        } else {
            $cssConverter = 'siphoc.pdf.css_path_to_url';
        }

        $container->setDefinition(
            'siphoc.pdf.generator',
            new Definition(
                'Siphoc\PdfBundle\Generator\PdfGenerator',
                array(
                    new Reference($cssConverter),
                    new Reference($jsConverter),
                    new Reference('knp.snappy.pdf'),
                    new Reference('templating'),
                    new Reference('logger'),
                )
            )
        );
    }
}
