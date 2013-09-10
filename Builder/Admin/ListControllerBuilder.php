<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates php for lists actions
 * @author cedric Lombardot
 */
class ListControllerBuilder extends BaseListBuilder
{
    public function getOutputName()
    {
        return $this->getGenerator()->getGeneratedControllerFolder().'/ListController.php';
    }

    /**
     * Returns the name of the template to render
     * 
     * @return string Name of the template to render
     */
    public function getTemplateName()
    {
        return 'ListBuilderAction.php.twig';
    }
}
