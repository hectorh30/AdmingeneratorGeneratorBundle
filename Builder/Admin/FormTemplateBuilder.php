<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generate php for lists actions for Propel
 * @author cedric Lombardot
 */
class FormTemplateBuilder extends FormBuilder
{
    public function getTemplateName()
    {
        return 'Edit/FormTemplateBuilder'.self::TWIG_EXTENSION;
    }

    public function getOutputName()
    {
        return 'Resources/views/'.$this->getBaseGeneratorName().'/form.html.twig';
    }

    public function getExtendingFormTemplate()
    {
        return false;
    }
}
