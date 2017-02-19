<?php

namespace Alphat\Bundle\ShortyBundle;

use Alphat\Bundle\ShortyBundle\Entity;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
use Doctrine\Bundle\CouchDBBundle\DependencyInjection\Compiler\DoctrineCouchDBMappingsPass;
use Doctrine\Bundle\PHPCRBundle\DependencyInjection\Compiler\DoctrinePhpcrMappingsPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ShortyBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        // ...

        $modelDir = realpath(__DIR__.'/Resources/config/doctrine/model');
        $mappings = array(
            $modelDir => Entity::class,
       );

        if (class_exists(DoctrineOrmMappingsPass::class)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('shorty_routing.model_manager_name'),
                    'shorty.backend_type_orm',
                    array('ShortyBundle' => Entity::class)
            ));
        }

        if (class_exists(DoctrieMongoDBMappingsPass::class)) {
            $container->addCompilerPass(
                DoctrineMongoDBMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('shorty_routing.model_manager_name'),
                    'shorty.backend_type_mongodb',
                    array('ShortyBundle' => Entity::class)
            ));
        }

        if (class_exists(DoctrineCouchDBMappingsPass::class)) {
            $container->addCompilerPass(
                DoctrineCouchDBMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('shorty.model_manager_name'),
                    'shorty.backend_type_couchdb',
                    array('ShortyBundle' => Entity::class)
            ));
        }

        if (class_exists(DoctrinePhpcrMappingsPass::class)) {
            $container->addCompilerPass(
                DoctrinePhpcrMappingsPass::createXmlMappingDriver(
                    $mappings,
                    array('shorty.model_manager_name'),
                    'shorty.backend_type_phpcr',
                    array('ShortyBundle' => Entity::class)
            ));
        }
    }
}
