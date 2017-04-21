<?php
declare(strict_types = 1);

namespace DL\MixpanelBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Bundle service definition and semantic configuration processing.
 *
 * @package DL\MixpanelBundle\DependencyInjection
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class DLMixpanelExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new DLMixpanelConfiguration, $configs);
        $this->processSemanticParameters($container, $config);
        $this->processServiceDefinition($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function processServiceDefinition(ContainerBuilder $container): void
    {
        $definitionFiles = [
            'services.yml',
        ];

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        foreach ($definitionFiles as $file) {
            $loader->load($file);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    protected function processSemanticParameters(ContainerBuilder $container, array $config): void
    {
        $container->setParameter('mixpanel_token', $config['token']);

        if (array_key_exists('options', $config)) {
            $container->setParameter('mixpanel_options', $config['options']);
        } else {
            $container->setParameter('mixpanel_options', []);
        }
    }
}
