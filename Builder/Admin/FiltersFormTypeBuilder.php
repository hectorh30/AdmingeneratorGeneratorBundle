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
        return 'Form/Base'.$this->getBaseGeneratorName().'Type/FiltersType.php';
    }

    public function getTemplateName()
    {
        return 'EditBuilderType' . self::TWIG_EXTENSION;
    }
}
