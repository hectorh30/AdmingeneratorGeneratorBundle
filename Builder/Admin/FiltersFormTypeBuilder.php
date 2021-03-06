<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates form for Filters
 * @author cedric Lombardot
 */
class FiltersFormTypeBuilder extends BaseFiltersBuilder
{
    public function getOutputName()
    {
        return 'Form/Type/'.$this->getBaseGeneratorName().'/FiltersType.php';
    }

    public function getTemplateName()
    {
        return 'EditFormTypeBuilder'.self::TWIG_EXTENSION;
    }

    public function getExtendingClassName($namespace, $bundle, $generator)
    {
        return '\\Symfony\\Component\\Form\\AbstractType';
    }
}
