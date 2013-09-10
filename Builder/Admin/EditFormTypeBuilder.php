<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates form for edit actions
 * @author cedric Lombardot
 */
class EditFormTypeBuilder extends BaseEditBuilder
{
    public function getOutputName()
    {
        return 'Form/Base'.$this->getBaseGeneratorName().'Type/EditType.php';
    }

    /**
     * Returns the name of the template to render
     * 
     * @return string Name of the template to render
     */
    public function getTemplateName()
    {
        return 'EditBuilderType.php.twig';
    }
}
