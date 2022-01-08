<?php

namespace Allphat\Bundle\ShortyBundle\DependencyInjection;

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
        $treeBuilder = new TreeBuilder('shorty');

        $treeBuilder->getRootNode()
            ->children()
            	->scalarNode('shorty_host')
            		->info('The host defined for the sort url with scheme.')
            		->isRequired()
                    ->cannotBeEmpty()
	            	->end()
                //->booleanNode('allow_follow')
                //    ->defaultValue(true)
                //->end()
                ->booleanNode('allow_secure_only')
                	->info('Restrict to secure urls only.')
                    ->defaultValue(false)
                ->end()
                ->booleaNode('allow_lifetime')
                	->info('Allow to define a lifetime for url validity.')
                    ->defaultValue(false)
                ->end()
                ->booleanNode('allow_max_calls')
                	->info('Allow to define a number of max usages for a shortened url.')
                    ->defaultValue(false)
                 ->end()
            ->end()
       ;

        return $treeBuilder;
    }
}
