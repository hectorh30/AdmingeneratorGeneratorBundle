<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates php for lists actions
 * @author cedric Lombardot
 */
class ListTemplateBuilder extends BaseListBuilder
{
    /**
     * (non-PHPdoc)
     * @see \Admingenerator\GeneratorBundle\Builder\BaseBuilder::getTemplatesToGenerate()
     */
    public function getTemplatesToGenerate()
    {
        return parent::getTemplatesToGenerate() + array(

            'ListTemplateBuilder'.self::TWIG_EXTENSION
                => 'Resources/views/'.$this->getBaseGeneratorName().'/list/index.html.twig',

            'List/FiltersTemplateBuilder'.self::TWIG_EXTENSION
                => 'Resources/views/'.$this->getBaseGeneratorName().'/list/filters.html.twig',

            'List/ResultsTemplateBuilder'.self::TWIG_EXTENSION
                => 'Resources/views/'.$this->getBaseGeneratorName().'/list/results.html.twig',

            'List/RowTemplateBuilder'.self::TWIG_EXTENSION
                => 'Resources/views/'.$this->getBaseGeneratorName().'/list/row.html.twig',
        );
    }
}
