<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generate php for Filters form
 * @author cedric Lombardot
 */
class FormFormTypeBuilder extends FormBuilder
{
    public function getTemplateName()
    {
        return 'EditFormTypeBuilder'.self::TWIG_EXTENSION;
    }

    public function getOutputName()
    {
        return 'Form/Type/'.$this->getBaseGeneratorName().'/FormType.php';
    }

    public function getExtendingClassName()
    {
        return '\\Symfony\\Component\\Form\\AbstractType';
    }
}
