<?php

namespace Admingenerator\GeneratorBundle\Builder\Admin;

/**
 * This builder generates php for edit actions
 * @author cedric Lombardot
 */
class EditTemplateBuilder extends BaseEditBuilder
{
    /**
     * (non-PHPdoc)
     * @see \Admingenerator\GeneratorBundle\Builder\BaseBuilder::getTemplatesToGenerate()
     */
    public function getTemplatesToGenerate()
    {
        return parent::getTemplatesToGenerate() + array(
            'EditTemplateBuilder'.self::TWIG_EXTENSION
                => 'Resources/views/'.$this->getBaseGeneratorName().'/edit/index.html.twig',
            'Edit/FormTemplateBuilder'.self::TWIG_EXTENSION
                => 'Resources/views/'.$this->getBaseGeneratorName().'/edit/form.html.twig',
        );
    }
}
