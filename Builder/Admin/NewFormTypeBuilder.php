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
        return 'Form/Base'.$this->getBaseGeneratorName().'Type/NewType.php';
    }

    public function getTemplateName()
    {
        return 'EditBuilderType' . self::TWIG_EXTENSION;
    }
}
