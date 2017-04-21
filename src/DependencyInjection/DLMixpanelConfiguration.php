<?php
declare(strict_types = 1);

namespace DL\MixpanelBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Bundle semantic configuration.
 *
 * @package DL\MixpanelBundle\DependencyInjection
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class DLMixpanelConfiguration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder;
        $root = $treeBuilder->root('dl_mixpanel');

        $root
            ->children()
                ->scalarNode('token')
                    ->end()
                ->arrayNode('options')
                    ->defaultValue([])
                    ->end()
            ->end();

        return $treeBuilder;
    }
}
