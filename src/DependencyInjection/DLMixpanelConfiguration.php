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
                    ->children()
                        ->integerNode('max_batch_size')->defaultValue(50)->end()
                        ->integerNode('max_queue_size')->defaultValue(1000)->end()
                        ->booleanNode('debug')->defaultFalse()->end()
                        ->scalarNode('consumer')->defaultValue('curl')->end()
                        ->scalarNode('host')->defaultValue('host')->end()
                        ->scalarNode('events_endpoint')->defaultValue('/track')->end()
                        ->scalarNode('people_endpoint')->defaultValue('/engage')->end()
                        ->booleanNode('use_ssl')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
