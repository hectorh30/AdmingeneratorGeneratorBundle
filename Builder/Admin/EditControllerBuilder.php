<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates php for edit actions
 * @author cedric Lombardot
 */
class EditControllerBuilder extends BaseEditBuilder
{
    public function getOutputName()
    {
        return $this->getGenerator()->getGeneratedControllerFolder().'/EditController.php';
    }

    /**
     * Returns the name of the template to render
     * 
     * @return string Name of the template to render
     */
    public function getTemplateName()
    {
        return 'EditBuilderAction.php.twig';
    }
}
