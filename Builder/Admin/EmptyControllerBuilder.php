<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates php for empty actions
 * @author cedric Lombardot
 */
class EmptyControllerBuilder extends BaseBuilder
{
    /**
     * (non-PHPdoc)
     * @see Admingenerator\GeneratorBundle\Builder.BuilderInterface::getDefaultTemplateDirs()
     */
    public function getTemplateDirs()
    {
        return array(realpath(dirname(__FILE__).'/../../Resources/templates'));
    }

    public function getTemplateName()
    {
        return 'EmptyBuilderAction.php.twig';
    }
}
