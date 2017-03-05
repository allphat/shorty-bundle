<?php

namespace Alphat\Bundle\ShortyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('shorty');

        $rootNode
            ->children()
                ->booleanNode('use_db')
                    ->defaultValue(false)
                ->end()
                ->booleanNode('allow_follow')
                    ->defaultValue(false)
                ->end()
                ->booleanNode('allow_secure')
                    ->defaultValue(false)
                ->end()
                ->integerNode('allow_lifetime')
                    ->defaultValue(0)
                ->end()
            ->end()
       ;

        return $treeBuilder;
    }
}
