<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates php for edit actions
 * @author Eymen Gunay
 */
class ShowControllerBuilder extends BaesShowBuilder
{
    public function getOutputName()
    {
        return $this->getGenerator()->getGeneratedControllerFolder().'/ShowController.php';
    }

    /**
     * Returns the name of the template to render
     * 
     * @return string Name of the template to render
     */
    public function getTemplateName()
    {
        return 'ShowBuilderAction.php.twig';
    }
}
