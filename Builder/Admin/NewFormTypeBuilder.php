<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates form for New actions
 * @author cedric Lombardot
 */
class NewFormTypeBuilder extends BaseNewBuilder
{
    public function getOutputName()
    {
        return 'Form/Type/'.$this->getBaseGeneratorName().'/NewType.php';
    }

    public function getTemplateName()
    {
        return 'EditFormTypeBuilder'.self::TWIG_EXTENSION;
    }
}
